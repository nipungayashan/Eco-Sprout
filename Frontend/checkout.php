<?php
session_start();
require_once __DIR__ . '/includes/helpers.php';

$pageTitle = 'Checkout - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
$siteRoot = '';
$isLoggedIn = isset($_SESSION['user_id']);
include 'includes/header.php';
?>

<main>
<section class="section">
<div class="container">
<h1 style="margin-bottom: var(--spacing-lg);">Checkout</h1>

<?php if (!$isLoggedIn) { ?>
<div class="card" style="margin-bottom: var(--spacing-lg); background:#fff8e1;">
<p><strong>Please log in</strong> to complete your order. Your cart will be saved in the browser.</p>
<a href="auth/login.php?redirect=checkout.php" class="btn-primary" style="margin-top:var(--spacing-md);">Login to Continue</a>
</div>
<?php } ?>

<?php include 'includes/flash_messages.php'; ?>

<div class="row">
<div class="col-md-7 mb-4">
<div class="card" id="checkoutCartCard">
<h3 style="color: var(--primary-color);">Your items</h3>
<div id="checkoutItemsList"><p class="text-muted">Loading cart...</p></div>
</div>

<?php if ($isLoggedIn) { ?>
<div class="card" style="margin-top: var(--spacing-lg);">
<h3 style="color: var(--primary-color);">Delivery details</h3>
<div class="form-group">
<label for="shipName">Full name *</label>
<input type="text" id="shipName" value="<?php echo isset($_SESSION['name']) ? e($_SESSION['name']) : ''; ?>" required>
</div>
<div class="form-group">
<label for="shipEmail">Email *</label>
<input type="email" id="shipEmail" value="<?php echo isset($_SESSION['email']) ? e($_SESSION['email']) : ''; ?>" required>
</div>
<div class="form-group">
<label for="shipAddress">Address *</label>
<textarea id="shipAddress" rows="3" required placeholder="Street, city, postcode"></textarea>
</div>
</div>
<?php } ?>
</div>

<div class="col-md-5 mb-4">
<div class="card" style="position: sticky; top: 100px;">
<h3 style="color: var(--primary-color);">Summary</h3>
<div class="cart-total-row" style="margin: var(--spacing-lg) 0;">
<span>Total</span>
<strong id="checkoutPageTotal" style="color: var(--primary-color);">LKR0.00</strong>
</div>
<?php if ($isLoggedIn) { ?>
<button type="button" class="btn-primary" id="goConfirmBtn" style="width:100%; padding:var(--spacing-md);">Continue to Confirm</button>
<?php } ?>
<a href="index.php" class="btn-outline" style="width:100%; padding:var(--spacing-md); text-align:center; display:block; margin-top:var(--spacing-md);">Return to Menu</a>
</div>
</div>
</div>
</div>
</section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var cart = getCart();
  var list = document.getElementById('checkoutItemsList');
  if (cart.length === 0) {
    list.innerHTML = '<p class="text-muted">Your cart is empty. <a href="catalogue.php">Browse plants</a></p>';
    document.getElementById('checkoutPageTotal').textContent = formatMoney(0);
    return;
  }
  var html = '';
  for (var i = 0; i < cart.length; i++) {
    var item = cart[i];
    html += '<div style="display:flex;justify-content:space-between;margin-bottom:var(--spacing-sm);">';
    html += '<span>' + item.name + ' x' + item.quantity + '</span>';
    html += '<span>' + formatMoney(item.price * item.quantity) + '</span></div>';
  }
  list.innerHTML = html;
  document.getElementById('checkoutPageTotal').textContent = formatMoney(getCartTotal());

  var btn = document.getElementById('goConfirmBtn');
  if (btn) {
    btn.addEventListener('click', function () {
      var name = document.getElementById('shipName').value.trim();
      var email = document.getElementById('shipEmail').value.trim();
      var address = document.getElementById('shipAddress').value.trim();
      if (!name || !email || !address) {
        alert('Please fill in all delivery fields.');
        return;
      }
      var full = name + ' | ' + email + ' | ' + address;
      sessionStorage.setItem('ecosprout_checkout_address', full);
      window.location.href = 'checkout-confirm.php';
    });
  }
});
</script>

<?php include 'includes/footer.php'; ?>
