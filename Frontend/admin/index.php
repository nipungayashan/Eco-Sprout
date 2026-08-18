<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$total_users = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$total_orders = (int) $pdo->query('SELECT COUNT(*) FROM shop_orders')->fetchColumn();
$total_revenue = (float) $pdo->query('SELECT COALESCE(SUM(total_amount), 0) FROM shop_orders')->fetchColumn();
$avg_order = ($total_orders > 0) ? ($total_revenue / $total_orders) : 0;

$customers = (int) $pdo->query('SELECT COUNT(*) FROM users WHERE role = 0 AND is_active = 1')->fetchColumn();
$staff_count = (int) $pdo->query('SELECT COUNT(*) FROM users WHERE role = 1')->fetchColumn();
$admin_count = (int) $pdo->query('SELECT COUNT(*) FROM users WHERE role = 2')->fetchColumn();
$inactive = (int) $pdo->query('SELECT COUNT(*) FROM users WHERE is_active = 0')->fetchColumn();

$pageTitle = 'Admin Dashboard - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$admin_active_page = 'index';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<h1 style="margin-bottom: var(--spacing-lg);">Admin Dashboard</h1>
<div class="row">
<div class="col-md-3 mb-4">
<?php include '../includes/admin_sidebar.php'; ?>
</div>
<div class="col-md-9 mb-4">
<?php include '../includes/flash_messages.php'; ?>
<div class="row" style="margin-bottom:var(--spacing-xl);">
<div class="col-lg-3 mb-4"><div class="card"><p class="text-muted" style="margin-bottom:var(--spacing-sm);">Total Users</p><h2 style="color:var(--primary-color);margin:0;"><?php echo $total_users; ?></h2></div></div>
<div class="col-lg-3 mb-4"><div class="card"><p class="text-muted" style="margin-bottom:var(--spacing-sm);">Total Revenue</p><h2 style="color:var(--secondary-color);margin:0;">LKR<?php echo number_format($total_revenue, 2); ?></h2></div></div>
<div class="col-lg-3 mb-4"><div class="card"><p class="text-muted" style="margin-bottom:var(--spacing-sm);">Total Orders</p><h2 style="color:var(--accent-color);margin:0;"><?php echo $total_orders; ?></h2></div></div>
<div class="col-lg-3 mb-4"><div class="card"><p class="text-muted" style="margin-bottom:var(--spacing-sm);">Avg Order Value</p><h2 style="color:#FF9500;margin:0;">LKR<?php echo number_format($avg_order, 2); ?></h2></div></div>
</div>
<div class="row" style="margin-bottom:var(--spacing-xl);">
<div class="col-md-6 mb-4">
<div class="card">
<h3 style="color:var(--primary-color);margin-top:0;margin-bottom:var(--spacing-lg);">System Status</h3>
<div style="display:flex;justify-content:space-between;margin-bottom:4px;"><span>Database</span><span style="color:#4CAF50;font-weight:600;">✓ Connected</span></div>
</div>
</div>
<div class="col-md-6 mb-4">
<div class="card">
<h3 style="color:var(--primary-color);margin-top:0;margin-bottom:var(--spacing-lg);">User Breakdown</h3>
<div style="display:flex;justify-content:space-between;margin-bottom:var(--spacing-sm);"><span>Active Customers</span><strong><?php echo $customers; ?></strong></div>
<div style="display:flex;justify-content:space-between;margin-bottom:var(--spacing-sm);"><span>Staff Members</span><strong><?php echo $staff_count; ?></strong></div>
<div style="display:flex;justify-content:space-between;margin-bottom:var(--spacing-sm);"><span>Admins</span><strong><?php echo $admin_count; ?></strong></div>
<div style="display:flex;justify-content:space-between;"><span>Inactive Users</span><strong><?php echo $inactive; ?></strong></div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</main>
<?php include '../includes/footer.php'; ?>
