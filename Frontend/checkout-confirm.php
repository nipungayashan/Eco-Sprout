<?php
session_start();
require_once __DIR__ . '/includes/helpers.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: auth/login.php?redirect=checkout.php');
  exit;
}

$pageTitle = 'Confirm Order - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
$siteRoot = '';
include 'includes/header.php';
?>

<main>
<section class="section">
<div class="container" style="max-width: 800px;">
<h1 style="margin-bottom: var(--spacing-lg);">Review Your Order</h1>
<?php include 'includes/flash_messages.php'; ?>

<div class="card" style="margin-bottom: var(--spacing-lg);">
<h3 style="color: var(--primary-color);">Order items</h3>
<div id="confirmItemsList"></div>
<div class="cart-total-row" style="margin-top: var(--spacing-lg); padding-top: var(--spacing-md); border-top: 2px solid var(--light-gray);">
<span><strong>Total</strong></span>
<strong id="confirmTotal" style="color: var(--primary-color); font-size: 1.2rem;">$0.00</strong>
</div>
</div>

<div id="confirmShippingBox" class="card" style="margin-bottom: var(--spacing-lg); display:none;">
<h3 style="color: var(--primary-color);">Shipping / contact</h3>
<p id="confirmShippingText"></p>
</div>

<div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap;">
<a href="index.php" class="btn-outline">Return to Menu</a>
<form method="post" action="checkout-handler.php" id="placeOrderForm" style="display:inline;">
<input type="hidden" name="cart_json" id="confirmCartJson" value="">
<input type="hidden" name="shipping_address" id="confirmShippingAddress" value="">
<button type="submit" class="btn-primary" id="proceedPayBtn">Proceed to Pay</button>
</form>
</div>
</div>
</section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var cart = getCart();
  if (cart.length === 0) {
    window.location.href = 'catalogue.php';
    return;
  }

  var shipping = sessionStorage.getItem('ecosprout_checkout_address') || '';
  if (shipping) {
    document.getElementById('confirmShippingBox').style.display = 'block';
    document.getElementById('confirmShippingText').textContent = shipping;
    document.getElementById('confirmShippingAddress').value = shipping;
  }

  document.getElementById('confirmCartJson').value = JSON.stringify(cart);

  var list = document.getElementById('confirmItemsList');
  var html = '';
  for (var i = 0; i < cart.length; i++) {
    var item = cart[i];
    var line = item.price * item.quantity;
    html += '<div style="display:flex;justify-content:space-between;padding:var(--spacing-sm) 0;border-bottom:1px solid var(--light-gray);">';
    html += '<span>' + item.name + ' (' + item.type + ') x' + item.quantity + '</span>';
    html += '<span>' + formatMoney(line) + '</span></div>';
  }
  list.innerHTML = html;
  document.getElementById('confirmTotal').textContent = formatMoney(getCartTotal());
});
</script>

<?php include 'includes/footer.php'; ?>
