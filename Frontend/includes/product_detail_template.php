<?php
$images = product_images($product);
if (count($images) === 0) {
  $images[] = 'assets/images/plant-1.jpg';
}
$priceJs = number_format((float)$price, 2, '.', '');
$canAdd = ($maxQty === null || (int)$maxQty > 0);
?>
<main>
<section class="section product-detail-section">
<div class="container">
<a href="<?php echo e($listUrl); ?>" class="btn-outline btn-small" style="margin-bottom: var(--spacing-lg);">← Back to list</a>
<div class="row">
<div class="col-md-6 mb-4">
<div class="product-gallery">
<img id="mainProductImage" src="<?php echo e($siteRoot . $images[0]); ?>" alt="<?php echo e($productName); ?>" class="product-main-image">
<?php if (count($images) > 1) { ?>
<div class="product-thumb-row">
<?php foreach ($images as $idx => $img) { ?>
<button type="button" class="product-thumb <?php echo ($idx === 0) ? 'active' : ''; ?>" data-img="<?php echo e($siteRoot . $img); ?>">
<img src="<?php echo e($siteRoot . $img); ?>" alt="">
</button>
<?php } ?>
</div>
<?php } ?>
</div>
</div>
<div class="col-md-6">
<h1><?php echo e($productName); ?></h1>
<?php if (!empty($productSubtitle)) { ?>
<p class="text-muted"><?php echo e($productSubtitle); ?></p>
<?php } ?>
<p class="card-price" style="margin: var(--spacing-lg) 0;">$<?php echo e(number_format((float)$price, 2)); ?></p>
<?php if ($productType === 'plant' || $productType === 'tool') { ?>
<?php if ($canAdd) { ?>
<p><span class="badge badge-success">In stock: <?php echo (int)$maxQty; ?></span></p>
<?php } else { ?>
<p><span class="badge" style="background:#FF9500;color:#fff;">Out of stock</span></p>
<?php } ?>
<?php } elseif ($productType === 'workshop') { ?>
<p class="text-muted">Spots left: <?php echo (int)$maxQty; ?></p>
<?php } ?>

<h3 style="color: var(--primary-color); font-size: 1.35rem; margin-top: var(--spacing-lg);">Description</h3>
<p><?php echo nl2br(e($product['description'])); ?></p>

<?php if ($canAdd) { ?>
<div class="form-group" style="margin-top: var(--spacing-lg);">
<label for="productQty">Quantity</label>
<div class="product-qty-row">
<button type="button" class="btn-outline" onclick="decreaseQuantity('productQty')">-</button>
<input type="number" id="productQty" value="1" min="1" <?php echo ($maxQty !== null) ? 'max="' . (int)$maxQty . '"' : ''; ?>>
<button type="button" class="btn-outline" onclick="increaseQuantity('productQty')">+</button>
</div>
</div>
<div class="product-action-buttons">
<button type="button" class="btn-primary btn-detail-cart"
  data-type="<?php echo e($productType); ?>"
  data-id="<?php echo (int)$product['id']; ?>"
  data-name="<?php echo e($productName); ?>"
  data-price="<?php echo e($priceJs); ?>"
  data-image="<?php echo e($images[0]); ?>"
  data-max="<?php echo ($maxQty !== null) ? (int)$maxQty : 0; ?>"
  data-checkout="0">Add to Cart</button>
<button type="button" class="btn-secondary btn-detail-cart"
  data-type="<?php echo e($productType); ?>"
  data-id="<?php echo (int)$product['id']; ?>"
  data-name="<?php echo e($productName); ?>"
  data-price="<?php echo e($priceJs); ?>"
  data-image="<?php echo e($images[0]); ?>"
  data-max="<?php echo ($maxQty !== null) ? (int)$maxQty : 0; ?>"
  data-checkout="1">Checkout</button>
</div>
<?php } ?>
</div>
</div>
</div>
</section>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var thumbs = document.querySelectorAll('.product-thumb');
  for (var t = 0; t < thumbs.length; t++) {
    thumbs[t].addEventListener('click', function () {
      var src = this.getAttribute('data-img');
      var main = document.getElementById('mainProductImage');
      if (main) { main.src = src; }
      for (var j = 0; j < thumbs.length; j++) { thumbs[j].classList.remove('active'); }
      this.classList.add('active');
    });
  }
  var cartBtns = document.querySelectorAll('.btn-detail-cart');
  for (var i = 0; i < cartBtns.length; i++) {
    cartBtns[i].addEventListener('click', function () {
      var qty = parseInt(document.getElementById('productQty').value, 10) || 1;
      addToCart(
        this.getAttribute('data-type'),
        parseInt(this.getAttribute('data-id'), 10),
        this.getAttribute('data-name'),
        parseFloat(this.getAttribute('data-price')),
        qty,
        this.getAttribute('data-image'),
        parseInt(this.getAttribute('data-max'), 10) || 0
      );
      if (this.getAttribute('data-checkout') === '1') {
        goToCheckoutFromDetail();
      }
    });
  }
});
</script>
