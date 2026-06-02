<?php
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';
$date_filter = isset($_GET['date']) ? trim($_GET['date']) : '';

$sql = 'SELECT o.*, u.full_name AS customer_name
        FROM shop_orders o
        JOIN users u ON u.id = o.user_id
        WHERE 1=1';
$params = array();
if ($status_filter !== '') {
  $sql .= ' AND o.status = :status';
  $params[':status'] = $status_filter;
}
if ($date_filter !== '') {
  $sql .= ' AND DATE(o.order_date) = :order_date';
  $params[':order_date'] = $date_filter;
}
$sql .= ' ORDER BY o.order_date DESC';
$stmt = $pdo->prepare($sql);
foreach ($params as $key => $val) {
  $stmt->bindValue($key, $val);
}
$stmt->execute();
$orders = $stmt->fetchAll();

$order_statuses = array('pending', 'processing', 'ready_to_ship', 'shipped', 'delivered', 'cancelled');

$pageTitle = 'Process Orders - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$staff_active_page = 'orders';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<h1 style="margin-bottom: var(--spacing-lg);">Process Orders</h1>
<div class="row">
<div class="col-md-3 mb-4"><?php include '../includes/staff_sidebar.php'; ?></div>
<div class="col-md-9 mb-4">
<?php include '../includes/flash_messages.php'; ?>
<form method="get" style="display:flex;gap:var(--spacing-md);margin-bottom:var(--spacing-lg);flex-wrap:wrap;">
<select name="status" style="flex:1;min-width:200px;padding:var(--spacing-sm);">
<option value="">All Orders</option>
<?php foreach ($order_statuses as $st) { ?>
<option value="<?php echo e($st); ?>" <?php echo ($status_filter === $st) ? 'selected' : ''; ?>><?php echo e(order_status_label($st)); ?></option>
<?php } ?>
</select>
<input type="date" name="date" value="<?php echo e($date_filter); ?>" style="padding:var(--spacing-sm);">
<button type="submit" class="btn-outline">Filter</button>
</form>
<div class="card">
<div style="overflow-x:auto;">
<table style="width:100%;font-size:0.95rem;">
<thead>
<tr style="border-bottom:2px solid var(--light-gray);">
<th style="padding:var(--spacing-md);text-align:left;">Order #</th>
<th style="padding:var(--spacing-md);text-align:left;">Customer</th>
<th style="padding:var(--spacing-md);text-align:left;">Items</th>
<th style="padding:var(--spacing-md);text-align:center;">Total</th>
<th style="padding:var(--spacing-md);text-align:center;">Status</th>
<th style="padding:var(--spacing-md);text-align:center;">Update</th>
</tr>
</thead>
<tbody>
<?php if (count($orders) === 0) { ?>
<tr><td colspan="6" style="padding:var(--spacing-md);text-align:center;">No orders found.</td></tr>
<?php } ?>
<?php foreach ($orders as $order) {
  $item_stmt = $pdo->prepare('SELECT product_name FROM shop_order_items WHERE order_id = :oid');
  $item_stmt->bindParam(':oid', $order['id'], PDO::PARAM_INT);
  $item_stmt->execute();
  $item_names = $item_stmt->fetchAll(PDO::FETCH_COLUMN);
  $items_text = implode(', ', $item_names);
?>
<tr style="border-bottom:1px solid var(--light-gray);">
<td style="padding:var(--spacing-md);"><?php echo e($order['order_number']); ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($order['customer_name']); ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($items_text); ?></td>
<td style="padding:var(--spacing-md);text-align:center;">$<?php echo e(number_format((float)$order['total_amount'], 2)); ?></td>
<td style="padding:var(--spacing-md);text-align:center;"><span class="badge badge-success"><?php echo e(order_status_label($order['status'])); ?></span></td>
<td style="padding:var(--spacing-md);text-align:center;">
<form method="post" action="order-handler.php" style="display:flex;gap:4px;justify-content:center;flex-wrap:wrap;">
<input type="hidden" name="action" value="update_status">
<input type="hidden" name="id" value="<?php echo (int)$order['id']; ?>">
<select name="status" style="padding:4px;font-size:0.85rem;">
<?php foreach ($order_statuses as $st) { ?>
<option value="<?php echo e($st); ?>" <?php echo ($order['status'] === $st) ? 'selected' : ''; ?>><?php echo e(order_status_label($st)); ?></option>
<?php } ?>
</select>
<button type="submit" class="btn-outline btn-small">Save</button>
</form>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</section>
</main>
<?php include '../includes/footer.php'; ?>
