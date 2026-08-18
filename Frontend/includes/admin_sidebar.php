
<?php
/**
 * Admin sidebar menu (full access to all modules)
 * Before including, set: $admin_active_page key
 */
if (!isset($admin_active_page)) {
  $admin_active_page = '';
}

function admin_nav_style($page_key, $admin_active_page)
{
  if ($page_key === $admin_active_page) {
    return 'color: var(--primary-color); font-weight: 600; display: block; padding: var(--spacing-sm) 0;';
  }
  return 'display: block; padding: var(--spacing-sm) 0;';
}
?>
<div class="sidebar">
    <h3 class="filter-title">Admin Menu</h3>
    <ul class="footer-links" style="padding: 0; margin: 0;">
        <li><a href="index.php" style="<?php echo admin_nav_style('index', $admin_active_page); ?>">Dashboard</a></li>
        <li><a href="users.php" style="<?php echo admin_nav_style('users', $admin_active_page); ?>">Manage Users</a></li>
        <li><a href="reports.php" style="<?php echo admin_nav_style('reports', $admin_active_page); ?>">Sales Reports</a></li>
        <li><a href="plants.php" style="<?php echo admin_nav_style('plants', $admin_active_page); ?>">Manage Plants</a></li>
        <li><a href="tools.php" style="<?php echo admin_nav_style('tools', $admin_active_page); ?>">Manage Tools</a></li>
        <li><a href="services.php" style="<?php echo admin_nav_style('services', $admin_active_page); ?>">Manage Services</a></li>
        <li><a href="workshops.php" style="<?php echo admin_nav_style('workshops', $admin_active_page); ?>">Manage Workshops</a></li>
        <li><a href="orders.php" style="<?php echo admin_nav_style('orders', $admin_active_page); ?>">Process Orders</a></li>
        <li><a href="queries.php" style="<?php echo admin_nav_style('queries', $admin_active_page); ?>">Handle Queries</a></li>
        <li><a href="../customer/dashboard.php" style="<?php echo admin_nav_style('customer_dashboard', $admin_active_page); ?>">Customer Dashboard</a></li>
        <li><a href="../customer/orders.php" style="<?php echo admin_nav_style('customer_orders', $admin_active_page); ?>">Customer Orders</a></li>
        <li><a href="../customer/bookings.php" style="<?php echo admin_nav_style('customer_bookings', $admin_active_page); ?>">Customer Bookings</a></li>
        <li><a href="../customer/profile.php" style="<?php echo admin_nav_style('customer_profile', $admin_active_page); ?>">Customer Profile</a></li>
        <li style="margin-top: var(--spacing-lg); padding-top: var(--spacing-lg); border-top: 1px solid var(--light-gray);">
            <a href="index.php" style="display: block; padding: var(--spacing-sm) 0;">Admin Dashboard Home</a>
        </li>
        <li><a href="../index.php" style="display: block; padding: var(--spacing-sm) 0;">Back to Site</a></li>
        <li><a href="../auth/logout.php" style="display: block; padding: var(--spacing-sm) 0; color: #d32f2f;">Logout</a></li>
    </ul>
</div>
