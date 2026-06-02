<?php
if (!isset($staff_active_page)) {
  $staff_active_page = '';
}
function staff_nav_style($page_key, $active)
{
  if ($page_key === $active) {
    return 'color: var(--primary-color); font-weight: 600; display: block; padding: var(--spacing-sm) 0;';
  }
  return 'display: block; padding: var(--spacing-sm) 0;';
}
?>
<div class="sidebar">
    <h3 class="filter-title">Staff Menu</h3>
    <ul class="footer-links" style="padding: 0; margin: 0;">
        <li><a href="index.php" style="<?php echo staff_nav_style('index', $staff_active_page); ?>">Dashboard</a></li>
        <li><a href="plants.php" style="<?php echo staff_nav_style('plants', $staff_active_page); ?>">Manage Plants</a></li>
        <li><a href="tools.php" style="<?php echo staff_nav_style('tools', $staff_active_page); ?>">Manage Tools</a></li>
        <li><a href="services.php" style="<?php echo staff_nav_style('services', $staff_active_page); ?>">Manage Services</a></li>
        <li><a href="workshops.php" style="<?php echo staff_nav_style('workshops', $staff_active_page); ?>">Manage Workshops</a></li>
        <li><a href="orders.php" style="<?php echo staff_nav_style('orders', $staff_active_page); ?>">Process Orders</a></li>
        <li><a href="queries.php" style="<?php echo staff_nav_style('queries', $staff_active_page); ?>">Handle Queries</a></li>
        <li style="margin-top: var(--spacing-lg); padding-top: var(--spacing-lg); border-top: 1px solid var(--light-gray);"><a href="../index.php">Back to Site</a></li>
        <li><a href="../auth/logout.php" style="color: #d32f2f;">Logout</a></li>
    </ul>
</div>
