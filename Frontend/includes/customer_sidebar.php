<?php
if (!isset($customer_active_page)) {
  $customer_active_page = '';
}
function customer_nav_style($page_key, $active)
{
  if ($page_key === $active) {
    return 'color: var(--primary-color); font-weight: 600;';
  }
  return '';
}
?>
<div class="sidebar">
    <h3 class="filter-title">My Account</h3>
    <ul class="footer-links" style="padding: 0;">
        <li><a href="dashboard.php" style="<?php echo customer_nav_style('dashboard', $customer_active_page); ?>">Dashboard</a></li>
        <li><a href="orders.php" style="<?php echo customer_nav_style('orders', $customer_active_page); ?>">My Orders</a></li>
        <li><a href="bookings.php" style="<?php echo customer_nav_style('bookings', $customer_active_page); ?>">My Bookings</a></li>
        <li><a href="../catalogue.php">Shop Plants</a></li>
        <li><a href="../auth/logout.php">Logout</a></li>
    </ul>
</div>
