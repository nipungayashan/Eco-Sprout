<?php
$pageTitle = 'Shopping Cart - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
?>

<main>
    <!-- Cart Section -->
    <section class="section">
        <div class="container">
            <h1 style="margin-bottom: var(--spacing-lg);">Shopping Cart</h1>

            <div class="row">
                <!-- Cart Items -->
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <!-- Cart Item 1 -->
                        <div style="display: flex; gap: var(--spacing-lg); padding-bottom: var(--spacing-lg); margin-bottom: var(--spacing-lg); border-bottom: 1px solid var(--light-gray);">
                            <img src="assets/images/plant-1.jpg" alt="Monstera" style="width: 120px; height: 120px; object-fit: cover; border-radius: var(--border-radius);">
                            <div style="flex: 1;">
                                <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-sm);">Monstera Deliciosa</h4>
                                <p class="text-muted">Indoor • Intermediate</p>
                                <p style="margin: var(--spacing-md) 0;"><strong>$29.99</strong></p>
                                <div style="display: flex; gap: var(--spacing-md); align-items: center;">
                                    <div style="display: flex; gap: var(--spacing-sm); align-items: center;">
                                        <button onclick="decreaseQuantity('qty1')" class="btn-outline" style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center;">-</button>
                                        <input type="number" id="qty1" value="1" min="1" style="width: 50px; text-align: center; padding: var(--spacing-sm); border: 1px solid var(--border-color); border-radius: var(--border-radius);">
                                        <button onclick="increaseQuantity('qty1')" class="btn-outline" style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center;">+</button>
                                    </div>
                                    <button class="btn-outline btn-small" onclick="removeFromCart('1')">Remove</button>
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <p style="font-size: 1.2rem; font-weight: 600; color: var(--primary-color);">$29.99</p>
                            </div>
                        </div>

                        <!-- Cart Item 2 -->
                        <div style="display: flex; gap: var(--spacing-lg); padding-bottom: 0;">
                            <img src="assets/images/plant-2.jpg" alt="Snake Plant" style="width: 120px; height: 120px; object-fit: cover; border-radius: var(--border-radius);">
                            <div style="flex: 1;">
                                <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-sm);">Snake Plant</h4>
                                <p class="text-muted">Indoor • Beginner</p>
                                <p style="margin: var(--spacing-md) 0;"><strong>$19.99</strong></p>
                                <div style="display: flex; gap: var(--spacing-md); align-items: center;">
                                    <div style="display: flex; gap: var(--spacing-sm); align-items: center;">
                                        <button onclick="decreaseQuantity('qty2')" class="btn-outline" style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center;">-</button>
                                        <input type="number" id="qty2" value="1" min="1" style="width: 50px; text-align: center; padding: var(--spacing-sm); border: 1px solid var(--border-color); border-radius: var(--border-radius);">
                                        <button onclick="increaseQuantity('qty2')" class="btn-outline" style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center;">+</button>
                                    </div>
                                    <button class="btn-outline btn-small" onclick="removeFromCart('2')">Remove</button>
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <p style="font-size: 1.2rem; font-weight: 600; color: var(--primary-color);">$19.99</p>
                            </div>
                        </div>
                    </div>

                    <!-- Continue Shopping -->
                    <a href="catalogue.php" class="btn-outline" style="margin-top: var(--spacing-lg);">← Continue Shopping</a>
                </div>

                <!-- Cart Summary -->
                <div class="col-md-4 mb-4">
                    <div class="card" style="position: sticky; top: 100px;">
                        <h3 style="color: var(--primary-color); margin-bottom: var(--spacing-lg);">Order Summary</h3>

                        <div style="margin-bottom: var(--spacing-md);">
                            <div style="display: flex; justify-content: space-between; margin-bottom: var(--spacing-sm);">
                                <span>Subtotal</span>
                                <span>$49.98</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: var(--spacing-sm);">
                                <span>Shipping</span>
                                <span>$10.00</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: var(--spacing-sm);">
                                <span>Tax</span>
                                <span>$4.80</span>
                            </div>
                        </div>

                        <div style="border-top: 2px solid var(--light-gray); padding-top: var(--spacing-md); margin-bottom: var(--spacing-lg);">
                            <div style="display: flex; justify-content: space-between; font-weight: 600; font-size: 1.1rem;">
                                <span>Total</span>
                                <span style="color: var(--primary-color);">$64.78</span>
                            </div>
                        </div>

                        <!-- Promo Code -->
                        <div class="form-group" style="margin-bottom: var(--spacing-lg);">
                            <label for="promoCode">Promo Code</label>
                            <div style="display: flex; gap: var(--spacing-sm);">
                                <input type="text" id="promoCode" placeholder="Enter code" style="flex: 1;">
                                <button class="btn-outline">Apply</button>
                            </div>
                        </div>

                        <a href="checkout.php" class="btn-primary" style="width: 100%; padding: var(--spacing-md); text-align: center; display: block; margin-bottom: var(--spacing-md);">Proceed to Checkout</a>
                        
                        <button class="btn-secondary" style="width: 100%; padding: var(--spacing-md);">Continue Shopping</button>

                        <!-- Features -->
                        <div style="margin-top: var(--spacing-xl); padding-top: var(--spacing-xl); border-top: 1px solid var(--light-gray);">
                            <div style="display: flex; align-items: center; gap: var(--spacing-md); margin-bottom: var(--spacing-md);">
                                <span style="font-size: 1.5rem;">🚚</span>
                                <span style="font-size: 0.9rem;">Free shipping on orders over $50</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: var(--spacing-md); margin-bottom: var(--spacing-md);">
                                <span style="font-size: 1.5rem;">🔄</span>
                                <span style="font-size: 0.9rem;">30-day money-back guarantee</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: var(--spacing-md);">
                                <span style="font-size: 1.5rem;">🛡️</span>
                                <span style="font-size: 0.9rem;">Secure checkout</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
