<?php
$pageTitle = 'Contact Us - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="hero" style="padding: var(--spacing-xl) var(--spacing-lg);">
        <div class="hero-content">
            <h1>Get In Touch</h1>
            <p class="hero-subtitle">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- Contact Information -->
                <div class="col-md-6 mb-4">
                    <h2 style="margin-bottom: var(--spacing-lg);">Contact Information</h2>
                    
                    <div class="card" style="margin-bottom: var(--spacing-lg);">
                        <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">📍 Address</h4>
                        <p>123 Green Lane<br>Eco City, EC 12345<br>United States</p>
                    </div>

                    <div class="card" style="margin-bottom: var(--spacing-lg);">
                        <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">📞 Phone</h4>
                        <p><a href="tel:+15551234567">+1 (555) 123-4567</a></p>
                    </div>

                    <div class="card" style="margin-bottom: var(--spacing-lg);">
                        <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">📧 Email</h4>
                        <p><a href="mailto:info@ecosprout.com">info@ecosprout.com</a></p>
                    </div>

                    <div class="card">
                        <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">🕐 Business Hours</h4>
                        <p>
                            Monday - Friday: 9:00 AM - 6:00 PM<br>
                            Saturday: 10:00 AM - 4:00 PM<br>
                            Sunday: Closed
                        </p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-md-6 mb-4">
                    <h2 style="margin-bottom: var(--spacing-lg);">Send us a Message</h2>
                    
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" required>
                            <div id="nameError" class="error-message" style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;"></div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required>
                            <div id="emailError" class="error-message" style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;"></div>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" required></textarea>
                            <div id="messageError" class="error-message" style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;"></div>
                        </div>

                        <button type="submit" class="btn-primary" style="width: 100%; padding: var(--spacing-md);">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section" style="background-color: #f0f0f0;">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: var(--spacing-xl);">Frequently Asked Questions</h2>
            
            <div style="max-width: 700px; margin: 0 auto;">
                <div class="card" style="margin-bottom: var(--spacing-lg);">
                    <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-sm);">What is your return policy?</h4>
                    <p>We offer a 30-day money-back guarantee on all plant purchases. Plants must be returned in good condition.</p>
                </div>

                <div class="card" style="margin-bottom: var(--spacing-lg);">
                    <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-sm);">Do you offer shipping?</h4>
                    <p>Yes, we ship nationwide! Shipping is free on orders over $50. Most orders arrive within 5-7 business days.</p>
                </div>

                <div class="card" style="margin-bottom: var(--spacing-lg);">
                    <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-sm);">Are your plants guaranteed to survive?</h4>
                    <p>While we take great care with our plants, their survival depends on proper care. We provide detailed care instructions with every order.</p>
                </div>

                <div class="card" style="margin-bottom: var(--spacing-lg);">
                    <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-sm);">Can I schedule a consultation?</h4>
                    <p>Absolutely! Contact us via phone or email to schedule a personalized gardening consultation with our experts.</p>
                </div>

                <div class="card">
                    <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-sm);">Do you offer wholesale prices?</h4>
                    <p>Yes, we offer wholesale pricing for bulk orders. Please contact our sales team for more information.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
