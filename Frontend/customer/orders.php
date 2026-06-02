<?php
require_once __DIR__ . '/../includes/customer_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$user_id = (int) $_SESSION['user_id'];

$stmt = $pdo->prepare(
  'SELECT o.* FROM shop_orders o WHERE o.user_id = :uid ORDER BY o.order_date DESC'
);
$stmt->bindParam(':uid', $user_id, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll();

$pageTitle = 'My Orders - EcoSprout Nursery';
$siteRoot = '../';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$customer_active_page = 'orders';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<div class="row">
<div class="col-md-3 mb-4"><?php include '../includes/customer_sidebar.php'; ?></div>
<div class="col-md-9">
<h1 style="margin-bottom: var(--spacing-lg);">My Orders</h1>
<p class="text-muted">Plants and tools purchased through checkout appear here.</p>
<?php if (count($orders) === 0) { ?>
<div class="card text-center" style="padding:var(--spacing-xl);">
<p>No orders yet.</p>
<a href="../catalogue.php" class="btn-primary">Browse Plants</a>
</div>
<?php } ?>
<?php foreach ($orders as $order) {
  $item_stmt = $pdo->prepare('SELECT * FROM shop_order_items WHERE order_id = :oid');
  $item_stmt->bindParam(':oid', $order['id'], PDO::PARAM_INT);
  $item_stmt->execute();
  $items = $item_stmt->fetchAll();
  $item_lines = array();
  foreach ($items as $it) {
    if ($it['product_type'] === 'plant' || $it['product_type'] === 'tool') {
      $item_lines[] = $it['product_name'] . ' x' . (int)$it['quantity'];
    }
  }
  if (count($item_lines) === 0) {
    foreach ($items as $it) {
      $item_lines[] = $it['product_name'] . ' (' . $it['product_type'] . ') x' . (int)$it['quantity'];
    }
  }
?>
<div class="card mb-4">
<h4 style="color:var(--primary-color);"><?php echo e($order['order_number']); ?></h4>
<p class="text-muted">Placed: <?php echo e($order['order_date']); ?></p>
<p><strong>Status:</strong> <?php echo e(order_status_label($order['status'])); ?></p>
<p><strong>Total:</strong> $<?php echo e(number_format((float)$order['total_amount'], 2)); ?></p>
<p><strong>Items:</strong> <?php echo e(implode(', ', $item_lines)); ?></p>
</div>
<?php } ?>
</div>
</div>
</div>
</section>
</main>
<?php include '../includes/footer.php'; ?>
