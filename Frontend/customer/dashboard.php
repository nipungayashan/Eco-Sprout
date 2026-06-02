<?php
require_once __DIR__ . '/../includes/customer_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$user_id = (int) $_SESSION['user_id'];

$oc_stmt = $pdo->prepare('SELECT COUNT(*) FROM shop_orders WHERE user_id = :uid');
$oc_stmt->bindParam(':uid', $user_id, PDO::PARAM_INT);
$oc_stmt->execute();
$order_count = (int) $oc_stmt->fetchColumn();

$spent_stmt = $pdo->prepare('SELECT COALESCE(SUM(total_amount), 0) FROM shop_orders WHERE user_id = :uid');
$spent_stmt->bindParam(':uid', $user_id, PDO::PARAM_INT);
$spent_stmt->execute();
$total_spent = (float) $spent_stmt->fetchColumn();

$book_stmt = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE user_id = :uid AND status = 'upcoming'");
$book_stmt->bindParam(':uid', $user_id, PDO::PARAM_INT);
$book_stmt->execute();
$booking_count = (int) $book_stmt->fetchColumn();

$recent_orders_stmt = $pdo->prepare(
  'SELECT o.*, (SELECT GROUP_CONCAT(product_name SEPARATOR ", ") FROM shop_order_items WHERE order_id = o.id) AS items_text
   FROM shop_orders o WHERE user_id = :uid ORDER BY order_date DESC LIMIT 5'
);
$recent_orders_stmt->bindParam(':uid', $user_id, PDO::PARAM_INT);
$recent_orders_stmt->execute();
$recent_orders = $recent_orders_stmt->fetchAll();

$recent_bookings_stmt = $pdo->prepare(
  "SELECT * FROM bookings WHERE user_id = :uid AND status = 'upcoming' ORDER BY booking_date ASC LIMIT 4"
);
$recent_bookings_stmt->bindParam(':uid', $user_id, PDO::PARAM_INT);
$recent_bookings_stmt->execute();
$recent_bookings = $recent_bookings_stmt->fetchAll();

$pageTitle = 'Dashboard - EcoSprout Nursery';
$siteRoot = '../';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$customer_active_page = 'dashboard';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<div class="row">
<div class="col-md-3 mb-4"><?php include '../includes/customer_sidebar.php'; ?></div>
<div class="col-md-9">
<h1 style="margin-bottom: var(--spacing-lg);">Welcome back, <?php echo e($_SESSION['name']); ?>!</h1>
<div class="row mb-4">
<div class="col-md-6 col-lg-4 mb-3"><div class="card text-center"><h3 style="color:var(--primary-color);font-size:2rem;"><?php echo $order_count; ?></h3><p class="text-muted">Total Orders</p></div></div>
<div class="col-md-6 col-lg-4 mb-3"><div class="card text-center"><h3 style="color:var(--primary-color);font-size:2rem;">$<?php echo number_format($total_spent, 2); ?></h3><p class="text-muted">Total Spent</p></div></div>
<div class="col-md-6 col-lg-4 mb-3"><div class="card text-center"><h3 style="color:var(--primary-color);font-size:2rem;"><?php echo $booking_count; ?></h3><p class="text-muted">Active Bookings</p></div></div>
</div>
<div class="card mb-4">
<h3 style="color:var(--primary-color);">Recent Orders (plants &amp; tools)</h3>
<?php if (count($recent_orders) === 0) { ?><p class="text-muted">No orders yet. <a href="../catalogue.php">Start shopping</a></p><?php } ?>
<table style="width:100%;">
<?php foreach ($recent_orders as $o) { ?>
<tr style="border-bottom:1px solid var(--light-gray);">
<td style="padding:var(--spacing-sm);"><?php echo e($o['order_number']); ?></td>
<td style="padding:var(--spacing-sm);"><?php echo e(substr($o['order_date'], 0, 10)); ?></td>
<td style="padding:var(--spacing-sm);"><?php echo e($o['items_text']); ?></td>
<td style="padding:var(--spacing-sm);">$<?php echo e(number_format((float)$o['total_amount'], 2)); ?></td>
<td style="padding:var(--spacing-sm);"><?php echo e(order_status_label($o['status'])); ?></td>
</tr>
<?php } ?>
</table>
<a href="orders.php" class="btn-outline btn-small" style="margin-top:var(--spacing-md);">View all orders</a>
</div>
<div class="card">
<h3 style="color:var(--primary-color);">Upcoming Bookings (services &amp; workshops)</h3>
<?php if (count($recent_bookings) === 0) { ?><p class="text-muted">No upcoming bookings.</p><?php } ?>
<?php foreach ($recent_bookings as $b) { ?>
<p style="margin-bottom:var(--spacing-sm);"><strong><?php echo e($b['booking_number']); ?></strong> — <?php echo e($b['booking_type']); ?> #<?php echo (int)$b['reference_id']; ?> on <?php echo e($b['booking_date']); ?></p>
<?php } ?>
<a href="bookings.php" class="btn-outline btn-small">View all bookings</a>
</div>
</div>
</div>
</div>
</section>
</main>
<?php include '../includes/footer.php'; ?>
