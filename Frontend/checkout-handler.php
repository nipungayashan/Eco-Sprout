<?php
/**
 * Places order in database: shop_orders, shop_order_items, bookings for services/workshops
 */
session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/helpers.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: auth/login.php?redirect=checkout-confirm.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: checkout.php');
  exit;
}

$cart_json = isset($_POST['cart_json']) ? $_POST['cart_json'] : '';
$shipping_address = isset($_POST['shipping_address']) ? trim($_POST['shipping_address']) : '';

$cart = json_decode($cart_json, true);
if (!is_array($cart) || count($cart) === 0) {
  $_SESSION['flash_err'] = 'Your cart is empty.';
  header('Location: checkout.php');
  exit;
}

if ($shipping_address === '') {
  $_SESSION['flash_err'] = 'Please enter a shipping address.';
  header('Location: checkout.php');
  exit;
}

$user_id = (int) $_SESSION['user_id'];
$total_amount = 0;

foreach ($cart as $item) {
  $qty = isset($item['quantity']) ? (int) $item['quantity'] : 1;
  $price = isset($item['price']) ? (float) $item['price'] : 0;
  $total_amount += $qty * $price;
}

$order_number = 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);

/**
 * booking_number is UNIQUE and max length is 20.
 * Use a short high-entropy value to avoid duplicate key errors.
 */
function generate_booking_number()
{
  return 'BK' . date('ymdHis') . rand(10, 99); // length 16
}

try {
  $pdo->beginTransaction();

  $status = 'pending';
  $payment_method = 'demo';
  // Try newest schema first; fallback for older shop_orders structures.
  try {
    $order_sql = 'INSERT INTO shop_orders (user_id, order_number, total_amount, status, shipping_address, payment_method)
                  VALUES (:user_id, :order_number, :total_amount, :status, :shipping_address, :payment_method)';
    $order_stmt = $pdo->prepare($order_sql);
    $order_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $order_stmt->bindParam(':order_number', $order_number);
    $order_stmt->bindParam(':total_amount', $total_amount);
    $order_stmt->bindParam(':status', $status);
    $order_stmt->bindParam(':shipping_address', $shipping_address);
    $order_stmt->bindParam(':payment_method', $payment_method);
    $order_stmt->execute();
  } catch (PDOException $orderEx) {
    $order_sql = 'INSERT INTO shop_orders (user_id, order_number, total_amount, status)
                  VALUES (:user_id, :order_number, :total_amount, :status)';
    $order_stmt = $pdo->prepare($order_sql);
    $order_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $order_stmt->bindParam(':order_number', $order_number);
    $order_stmt->bindParam(':total_amount', $total_amount);
    $order_stmt->bindParam(':status', $status);
    $order_stmt->execute();
  }
  $order_id = (int) $pdo->lastInsertId();

  $item_sql = 'INSERT INTO shop_order_items (order_id, product_type, product_id, product_name, quantity, unit_price, line_total)
               VALUES (:order_id, :product_type, :product_id, :product_name, :quantity, :unit_price, :line_total)';
  $item_stmt = $pdo->prepare($item_sql);

  $booking_stmt = null;

  $booking_counter = 0;

  foreach ($cart as $item) {
    $type = isset($item['type']) ? $item['type'] : '';
    $product_id = isset($item['productId']) ? (int) $item['productId'] : 0;
    $name = isset($item['name']) ? $item['name'] : 'Product';
    $qty = isset($item['quantity']) ? (int) $item['quantity'] : 1;
    $unit_price = isset($item['price']) ? (float) $item['price'] : 0;
    $line_total = $unit_price * $qty;

    $item_stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $item_stmt->bindParam(':product_type', $type);
    $item_stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $item_stmt->bindParam(':product_name', $name);
    $item_stmt->bindParam(':quantity', $qty, PDO::PARAM_INT);
    $item_stmt->bindParam(':unit_price', $unit_price);
    $item_stmt->bindParam(':line_total', $line_total);
    $item_stmt->execute();

    if ($type === 'plant') {
      $stock_stmt = $pdo->prepare('UPDATE plants SET stock = stock - :qty_set WHERE id = :id AND stock >= :qty_check');
      $stock_stmt->bindParam(':qty_set', $qty, PDO::PARAM_INT);
      $stock_stmt->bindParam(':qty_check', $qty, PDO::PARAM_INT);
      $stock_stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
      $stock_stmt->execute();
    }

    if ($type === 'tool') {
      $stock_stmt = $pdo->prepare('UPDATE tools SET stock = stock - :qty_set WHERE id = :id AND stock >= :qty_check');
      $stock_stmt->bindParam(':qty_set', $qty, PDO::PARAM_INT);
      $stock_stmt->bindParam(':qty_check', $qty, PDO::PARAM_INT);
      $stock_stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
      $stock_stmt->execute();
    }

    if ($type === 'service' || $type === 'workshop') {
      $booking_counter++;
      $booking_number = generate_booking_number();
      $booking_date = date('Y-m-d');
      $booking_time = '10:00:00';
      $booking_status = 'upcoming';
      $notes = 'Created from order ' . $order_number;

      if ($type === 'workshop') {
        $ws_stmt = $pdo->prepare('SELECT event_date, event_time, spots_available FROM workshops WHERE id = :id');
        $ws_stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
        $ws_stmt->execute();
        $ws = $ws_stmt->fetch();
        if ($ws) {
          $booking_date = $ws['event_date'];
          $booking_time = $ws['event_time'];
          $ws_upd = $pdo->prepare('UPDATE workshops SET spots_available = spots_available - :qty_set WHERE id = :id AND spots_available >= :qty_check');
          $ws_upd->bindParam(':qty_set', $qty, PDO::PARAM_INT);
          $ws_upd->bindParam(':qty_check', $qty, PDO::PARAM_INT);
          $ws_upd->bindParam(':id', $product_id, PDO::PARAM_INT);
          $ws_upd->execute();
        }
      }

      // Try newest bookings schema first; fallback for older schema without notes.
      try {
        if ($booking_stmt === null) {
          $booking_sql = 'INSERT INTO bookings (user_id, booking_number, booking_type, reference_id, booking_date, booking_time, status, notes)
                          VALUES (:user_id, :booking_number, :booking_type, :reference_id, :booking_date, :booking_time, :status, :notes)';
          $booking_stmt = $pdo->prepare($booking_sql);
        }
        $booking_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $booking_stmt->bindParam(':booking_number', $booking_number);
        $booking_stmt->bindParam(':booking_type', $type);
        $booking_stmt->bindParam(':reference_id', $product_id, PDO::PARAM_INT);
        $booking_stmt->bindParam(':booking_date', $booking_date);
        $booking_stmt->bindParam(':booking_time', $booking_time);
        $booking_stmt->bindParam(':status', $booking_status);
        $booking_stmt->bindParam(':notes', $notes);
        $booking_stmt->execute();
      } catch (PDOException $bookingEx) {
        $booking_sql = 'INSERT INTO bookings (user_id, booking_number, booking_type, reference_id, booking_date, booking_time, status)
                        VALUES (:user_id, :booking_number, :booking_type, :reference_id, :booking_date, :booking_time, :status)';
        $booking_stmt_legacy = $pdo->prepare($booking_sql);
        $booking_stmt_legacy->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $booking_stmt_legacy->bindParam(':booking_number', $booking_number);
        $booking_stmt_legacy->bindParam(':booking_type', $type);
        $booking_stmt_legacy->bindParam(':reference_id', $product_id, PDO::PARAM_INT);
        $booking_stmt_legacy->bindParam(':booking_date', $booking_date);
        $booking_stmt_legacy->bindParam(':booking_time', $booking_time);
        $booking_stmt_legacy->bindParam(':status', $booking_status);
        $booking_stmt_legacy->execute();
      }
    }
  }

  $pdo->commit();

  $_SESSION['last_order_number'] = $order_number;
  $_SESSION['last_order_total'] = $total_amount;
  header('Location: order-success.php?order=' . urlencode($order_number));
  exit;

} catch (PDOException $ex) {
  if ($pdo->inTransaction()) {
    $pdo->rollBack();
  }
  error_log('Checkout error: ' . $ex->getMessage());
  $_SESSION['flash_err'] = 'Could not place order. Please try again. (' . $ex->getMessage() . ')';
  header('Location: checkout.php');
  exit;
}
