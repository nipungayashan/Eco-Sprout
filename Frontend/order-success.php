<?php
session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/helpers.php';

$order_number = isset($_GET['order']) ? trim($_GET['order']) : '';
$order = null;
$items = array();

if ($order_number !== '') {
  $stmt = $pdo->prepare('SELECT * FROM shop_orders WHERE order_number = :num LIMIT 1');
  $stmt->bindParam(':num', $order_number);
  $stmt->execute();
  $order = $stmt->fetch();
  if ($order) {
    $item_stmt = $pdo->prepare('SELECT * FROM shop_order_items WHERE order_id = :oid');
    $item_stmt->bindParam(':oid', $order['id'], PDO::PARAM_INT);
    $item_stmt->execute();
    $items = $item_stmt->fetchAll();
  }
}

$pageTitle = 'Order Placed - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
$siteRoot = '';
include 'includes/header.php';
?>

<main>
<section class="section" style="min-height: 60vh;">
<div class="container" style="max-width: 700px; text-align: center;">
<div class="card" style="border: 2px solid var(--light-green);">
<h1 style="color: var(--light-green);">Order placed successfully!</h1>
<p style="font-size: 1.1rem;">Thank you. No payment gateway is required for this demo — your order is saved in the system.</p>

<?php if ($order) { ?>
<p style="margin-top: var(--spacing-lg);"><strong>Order number:</strong> <?php echo e($order['order_number']); ?></p>
<p><strong>Total:</strong> $<?php echo e(number_format((float)$order['total_amount'], 2)); ?></p>
<p><strong>Status:</strong> <?php echo e(order_status_label($order['status'])); ?></p>
<div style="text-align:left; background:#f9f6f0; padding:var(--spacing-lg); border-radius:var(--border-radius); margin:var(--spacing-lg) 0;">
<h4 style="color:var(--primary-color);">Items</h4>
<?php foreach ($items as $it) { ?>
<p style="margin:0 0 8px 0;"><?php echo e($it['product_name']); ?> (<?php echo e($it['product_type']); ?>) x<?php echo (int)$it['quantity']; ?> — $<?php echo e(number_format((float)$it['line_total'], 2)); ?></p>
<?php } ?>
</div>
<?php } ?>

<div style="display:flex; gap:var(--spacing-md); justify-content:center; flex-wrap:wrap; margin-top:var(--spacing-lg);">
<?php if (isset($_SESSION['user_id']) && (int)$_SESSION['role'] === 0) { ?>
<a href="customer/orders.php" class="btn-primary">View My Orders</a>
<a href="customer/bookings.php" class="btn-outline">View My Bookings</a>
<?php } ?>
<a href="index.php" class="btn-outline">Return to Menu</a>
</div>
</div>
</div>
</section>
</main>

<!-- Success dialog (Bootstrap modal) -->
<div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-header" style="border:none;">
<h5 class="modal-title" style="color:var(--light-green);">✓ Order placed successfully</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<p>Your order has been recorded. Staff and admin dashboards will show it immediately. Plants and tools appear under <strong>Orders</strong>; services and workshops also appear under <strong>Bookings</strong> on your account.</p>
</div>
<div class="modal-footer" style="border:none;">
<button type="button" class="btn-primary" data-bs-dismiss="modal">OK</button>
</div>
</div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  clearCart();
  var modalEl = document.getElementById('orderSuccessModal');
  if (modalEl && typeof bootstrap !== 'undefined') {
    var modal = new bootstrap.Modal(modalEl);
    modal.show();
  }
});
</script>

<?php include 'includes/footer.php'; ?>
