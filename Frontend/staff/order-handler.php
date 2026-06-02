<?php
session_start();
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

$allowed_statuses = array('pending', 'processing', 'ready_to_ship', 'shipped', 'delivered', 'cancelled');

if ($action === 'update_status' && $id > 0) {
  $status = isset($_POST['status']) ? trim($_POST['status']) : '';
  if (!in_array($status, $allowed_statuses, true)) {
    $_SESSION['flash_err'] = 'Invalid order status.';
    header('Location: orders.php');
    exit;
  }
  try {
    $stmt = $pdo->prepare('UPDATE shop_orders SET status = :status WHERE id = :id');
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = 'Order status updated to ' . order_status_label($status) . '.';
  } catch (PDOException $ex) {
    $_SESSION['flash_err'] = 'Could not update order.';
  }
  header('Location: orders.php');
  exit;
}
header('Location: orders.php');
exit;
