<?php
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$pending_orders = (int) $pdo->query("SELECT COUNT(*) FROM shop_orders WHERE status IN ('pending','processing')")->fetchColumn();
$new_queries = (int) $pdo->query("SELECT COUNT(*) FROM customer_queries WHERE status = 'new'")->fetchColumn();
$products_count = (int) $pdo->query('SELECT (SELECT COUNT(*) FROM plants) + (SELECT COUNT(*) FROM tools)')->fetchColumn();
$services_count = (int) $pdo->query('SELECT COUNT(*) FROM services WHERE is_active = 1')->fetchColumn();

$recent_orders_stmt = $pdo->query(
  "SELECT o.id, o.order_number, o.total_amount, o.status, u.full_name AS customer_name
   FROM shop_orders o JOIN users u ON u.id = o.user_id
   ORDER BY o.order_date DESC LIMIT 5"
);
$recent_orders = $recent_orders_stmt->fetchAll();

$recent_queries_stmt = $pdo->query(
  "SELECT id, subject, full_name, status, created_at FROM customer_queries ORDER BY created_at DESC LIMIT 3"
);
$recent_queries = $recent_queries_stmt->fetchAll();

$pageTitle = 'Staff Dashboard - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$staff_active_page = 'index';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<h1 style="margin-bottom: var(--spacing-lg);">Staff Dashboard</h1>
<div class="row">
<div class="col-md-3 mb-4"><?php include '../includes/staff_sidebar.php'; ?></div>
<div class="col-md-9 mb-4">
<?php include '../includes/flash_messages.php'; ?>
<div class="row" style="margin-bottom:var(--spacing-xl);">
<div class="col-lg-3 mb-4"><div class="card"><p class="text-muted" style="margin-bottom:var(--spacing-sm);">Orders to Process</p><h2 style="color:var(--primary-color);margin:0;"><?php echo $pending_orders; ?></h2></div></div>
<div class="col-lg-3 mb-4"><div class="card"><p class="text-muted" style="margin-bottom:var(--spacing-sm);">New Queries</p><h2 style="color:var(--secondary-color);margin:0;"><?php echo $new_queries; ?></h2></div></div>
<div class="col-lg-3 mb-4"><div class="card"><p class="text-muted" style="margin-bottom:var(--spacing-sm);">Products Listed</p><h2 style="color:var(--accent-color);margin:0;"><?php echo $products_count; ?></h2></div></div>
<div class="col-lg-3 mb-4"><div class="card"><p class="text-muted" style="margin-bottom:var(--spacing-sm);">Services Active</p><h2 style="color:#FF9500;margin:0;"><?php echo $services_count; ?></h2></div></div>
</div>
<div class="card" style="margin-bottom:var(--spacing-lg);">
<h3 style="color:var(--primary-color);margin-bottom:var(--spacing-lg);">Recent Orders to Process</h3>
<div style="overflow-x:auto;">
<table style="width:100%;font-size:0.95rem;">
<thead>
<tr style="border-bottom:2px solid var(--light-gray);">
<th style="padding:var(--spacing-md);text-align:left;">Order #</th>
<th style="padding:var(--spacing-md);text-align:left;">Customer</th>
<th style="padding:var(--spacing-md);text-align:left;">Total</th>
<th style="padding:var(--spacing-md);text-align:left;">Status</th>
<th style="padding:var(--spacing-md);text-align:center;">Actions</th>
</tr>
</thead>
<tbody>
<?php if (count($recent_orders) === 0) { ?>
<tr><td colspan="5" style="padding:var(--spacing-md);text-align:center;">No orders yet.</td></tr>
<?php } ?>
<?php foreach ($recent_orders as $order) { ?>
<tr style="border-bottom:1px solid var(--light-gray);">
<td style="padding:var(--spacing-md);"><?php echo e($order['order_number']); ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($order['customer_name']); ?></td>
<td style="padding:var(--spacing-md);">$<?php echo e(number_format((float)$order['total_amount'], 2)); ?></td>
<td style="padding:var(--spacing-md);"><span class="badge badge-success"><?php echo e(order_status_label($order['status'])); ?></span></td>
<td style="padding:var(--spacing-md);text-align:center;"><a href="orders.php" class="btn-outline btn-small">Manage</a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<div class="card">
<h3 style="color:var(--primary-color);margin-bottom:var(--spacing-lg);">Recent Customer Queries</h3>
<?php if (count($recent_queries) === 0) { ?>
<p class="text-muted">No queries yet.</p>
<?php } ?>
<?php foreach ($recent_queries as $q) { ?>
<div style="margin-bottom:var(--spacing-lg);padding-bottom:var(--spacing-lg);border-bottom:1px solid var(--light-gray);">
<div style="display:flex;justify-content:space-between;align-items:start;gap:var(--spacing-md);">
<div style="flex:1;">
<p style="font-weight:600;margin:0 0 4px 0;"><?php echo e($q['subject']); ?></p>
<p class="text-muted" style="font-size:0.9rem;margin:0;">From: <?php echo e($q['full_name']); ?> • <?php echo e($q['created_at']); ?></p>
</div>
<span class="badge badge-success"><?php echo e(query_status_label($q['status'])); ?></span>
</div>
</div>
<?php } ?>
<p><a href="queries.php" class="btn-outline btn-small">View all queries</a></p>
</div>
</div>
</div>
</div>
</section>
</main>
<?php include '../includes/footer.php'; ?>
