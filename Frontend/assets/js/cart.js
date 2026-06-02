/**
 * EcoSprout shopping cart (localStorage)
 * Each item: { key, type, productId, name, price, quantity, image, maxQty }
 */

function getCart() {
  try {
    return JSON.parse(localStorage.getItem('ecosprout_cart')) || [];
  } catch (e) {
    return [];
  }
}

function saveCart(cart) {
  localStorage.setItem('ecosprout_cart', JSON.stringify(cart));
  updateCartBadge();
  if (typeof renderCartSidebar === 'function') {
    renderCartSidebar();
  }
}

function makeCartKey(type, productId) {
  return type + '-' + productId;
}

function addToCart(type, productId, name, price, quantity, image, maxQty) {
  quantity = parseInt(quantity, 10) || 1;
  if (quantity < 1) {
    quantity = 1;
  }
  price = parseFloat(price);
  var key = makeCartKey(type, productId);
  var cart = getCart();
  var found = -1;

  for (var i = 0; i < cart.length; i++) {
    if (cart[i].key === key) {
      found = i;
      break;
    }
  }

  if (found >= 0) {
    var newQty = cart[found].quantity + quantity;
    if (maxQty && newQty > maxQty) {
      newQty = maxQty;
      alert('Maximum available quantity is ' + maxQty);
    }
    cart[found].quantity = newQty;
  } else {
    if (maxQty && quantity > maxQty) {
      quantity = maxQty;
      alert('Maximum available quantity is ' + maxQty);
    }
    cart.push({
      key: key,
      type: type,
      productId: productId,
      name: name,
      price: price,
      quantity: quantity,
      image: image || '',
      maxQty: maxQty || 0
    });
  }

  saveCart(cart);
  showCartToast(name + ' added to cart');
  return false;
}

function addToCartFromDetail(type, productId, name, price, qtyInputId, image, maxQty) {
  var qtyEl = document.getElementById(qtyInputId || 'productQty');
  var qty = qtyEl ? parseInt(qtyEl.value, 10) : 1;
  addToCart(type, productId, name, price, qty, image, maxQty);
  return false;
}

function updateCartItemQty(key, quantity) {
  quantity = parseInt(quantity, 10);
  var cart = getCart();
  for (var i = 0; i < cart.length; i++) {
    if (cart[i].key === key) {
      if (quantity < 1) {
        cart.splice(i, 1);
      } else {
        if (cart[i].maxQty && quantity > cart[i].maxQty) {
          quantity = cart[i].maxQty;
        }
        cart[i].quantity = quantity;
      }
      break;
    }
  }
  saveCart(cart);
}

function changeCartQty(key, delta) {
  var cart = getCart();
  for (var i = 0; i < cart.length; i++) {
    if (cart[i].key === key) {
      updateCartItemQty(key, cart[i].quantity + delta);
      return;
    }
  }
}

function removeFromCart(key) {
  var cart = getCart();
  cart = cart.filter(function (item) {
    return item.key !== key;
  });
  saveCart(cart);
}

function clearCart() {
  localStorage.removeItem('ecosprout_cart');
  updateCartBadge();
  if (typeof renderCartSidebar === 'function') {
    renderCartSidebar();
  }
}

function getCartCount() {
  var cart = getCart();
  var total = 0;
  for (var i = 0; i < cart.length; i++) {
    total += cart[i].quantity;
  }
  return total;
}

function getCartTotal() {
  var cart = getCart();
  var total = 0;
  for (var i = 0; i < cart.length; i++) {
    total += cart[i].price * cart[i].quantity;
  }
  return Math.round(total * 100) / 100;
}

function updateCartBadge() {
  var badge = document.getElementById('cartBadge');
  if (!badge) {
    return;
  }
  var count = getCartCount();
  badge.textContent = count;
  badge.style.display = count > 0 ? 'inline-flex' : 'none';
}

function formatMoney(amount) {
  return '$' + parseFloat(amount).toFixed(2);
}

function openCartSidebar() {
  var drawer = document.getElementById('cartDrawer');
  var overlay = document.getElementById('cartOverlay');
  if (drawer) {
    drawer.classList.add('open');
  }
  if (overlay) {
    overlay.classList.add('open');
  }
  document.body.style.overflow = 'hidden';
  renderCartSidebar();
}

function closeCartSidebar() {
  var drawer = document.getElementById('cartDrawer');
  var overlay = document.getElementById('cartOverlay');
  if (drawer) {
    drawer.classList.remove('open');
  }
  if (overlay) {
    overlay.classList.remove('open');
  }
  document.body.style.overflow = '';
}

function renderCartSidebar() {
  var listEl = document.getElementById('cartSidebarItems');
  var totalEl = document.getElementById('cartSidebarTotal');
  var emptyEl = document.getElementById('cartSidebarEmpty');
  var checkoutBtn = document.getElementById('cartSidebarCheckout');
  if (!listEl) {
    return;
  }

  var cart = getCart();
  listEl.innerHTML = '';

  if (cart.length === 0) {
    if (emptyEl) {
      emptyEl.style.display = 'block';
    }
    if (totalEl) {
      totalEl.textContent = formatMoney(0);
    }
    if (checkoutBtn) {
      checkoutBtn.classList.add('disabled');
      checkoutBtn.setAttribute('aria-disabled', 'true');
    }
    return;
  }

  if (emptyEl) {
    emptyEl.style.display = 'none';
  }
  if (checkoutBtn) {
    checkoutBtn.classList.remove('disabled');
    checkoutBtn.removeAttribute('aria-disabled');
  }

  var siteRoot = window.ECOSPROUT_SITE_ROOT || '';

  for (var i = 0; i < cart.length; i++) {
    var item = cart[i];
    var lineTotal = item.price * item.quantity;
  var row = document.createElement('div');
    row.className = 'cart-sidebar-item';
    row.innerHTML =
      '<img src="' + siteRoot + item.image + '" alt="">' +
      '<div class="cart-sidebar-item-info">' +
      '<strong>' + escapeHtml(item.name) + '</strong>' +
      '<span class="text-muted">' + formatMoney(item.price) + ' each</span>' +
      '<div class="cart-qty-row">' +
      '<button type="button" class="btn-outline btn-small cart-qty-btn" data-action="minus" data-key="' + item.key + '">-</button>' +
      '<span class="cart-qty-value">' + item.quantity + '</span>' +
      '<button type="button" class="btn-outline btn-small cart-qty-btn" data-action="plus" data-key="' + item.key + '">+</button>' +
      '<button type="button" class="cart-remove-btn" data-key="' + item.key + '">Remove</button>' +
      '</div>' +
      '</div>' +
      '<div class="cart-sidebar-line-total">' + formatMoney(lineTotal) + '</div>';
    listEl.appendChild(row);
  }

  if (totalEl) {
    totalEl.textContent = formatMoney(getCartTotal());
  }

  var buttons = listEl.querySelectorAll('.cart-qty-btn, .cart-remove-btn');
  for (var b = 0; b < buttons.length; b++) {
    buttons[b].addEventListener('click', function () {
      var key = this.getAttribute('data-key');
      if (this.classList.contains('cart-remove-btn')) {
        removeFromCart(key);
        return;
      }
      var action = this.getAttribute('data-action');
      changeCartQty(key, action === 'plus' ? 1 : -1);
    });
  }
}

function escapeHtml(text) {
  var div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}

function goToCheckout() {
  if (getCart().length === 0) {
    alert('Your cart is empty.');
    return;
  }
  var siteRoot = window.ECOSPROUT_SITE_ROOT || '';
  window.location.href = siteRoot + 'checkout.php';
}

function goToCheckoutFromDetail() {
  if (getCart().length === 0) {
    alert('Add at least one item to cart first.');
    return;
  }
  var siteRoot = window.ECOSPROUT_SITE_ROOT || '';
  window.location.href = siteRoot + 'checkout.php';
}

function showCartToast(message) {
  var toast = document.getElementById('cartToast');
  if (!toast) {
    return;
  }
  toast.textContent = message;
  toast.classList.add('show');
  setTimeout(function () {
    toast.classList.remove('show');
  }, 2200);
}

document.addEventListener('DOMContentLoaded', function () {
  updateCartBadge();

  var cartToggle = document.getElementById('cartToggle');
  if (cartToggle) {
    cartToggle.addEventListener('click', function (e) {
      e.preventDefault();
      openCartSidebar();
    });
  }

  var overlay = document.getElementById('cartOverlay');
  if (overlay) {
    overlay.addEventListener('click', closeCartSidebar);
  }

  var closeBtn = document.getElementById('cartDrawerClose');
  if (closeBtn) {
    closeBtn.addEventListener('click', closeCartSidebar);
  }

  var checkoutBtn = document.getElementById('cartSidebarCheckout');
  if (checkoutBtn) {
    checkoutBtn.addEventListener('click', function (e) {
      e.preventDefault();
      if (getCart().length === 0) {
        return;
      }
      goToCheckout();
    });
  }
});
