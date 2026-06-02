<?php
$pageTitle = 'Forgot Password - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
include '../includes/header.php';
?>

<main>
    <!-- Forgot Password Section -->
    <section class="section" style="min-height: 70vh; display: flex; align-items: center;">
        <div class="container">
            <div style="max-width: 450px; margin: 0 auto;">
                <!-- Forgot Password Card -->
                <div class="card" style="box-shadow: 0 4px 16px rgba(45, 106, 79, 0.15);">
                    <div style="text-align: center; margin-bottom: var(--spacing-xl);">
                        <h1 style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: var(--spacing-sm);">EcoSprout</h1>
                        <h2 style="font-size: 1.5rem; font-weight: 400;">Reset Password</h2>
                        <p class="text-muted">Enter your email to receive reset instructions</p>
                    </div>

                    <!-- Forgot Password Form -->
                    <form id="forgotForm" style="margin-bottom: var(--spacing-lg);">
                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" required>
                            <div id="emailError" class="error-message" style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;"></div>
                        </div>

                        <p style="font-size: 0.9rem; color: #666; margin-bottom: var(--spacing-lg); line-height: 1.6;">We'll send you an email with instructions to reset your password. Check your email and follow the link to create a new password.</p>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-primary" style="width: 100%; padding: var(--spacing-md); font-size: 1rem; margin-bottom: var(--spacing-lg);">Send Reset Link</button>
                    </form>

                    <!-- Back to Login Link -->
                    <div style="text-align: center; padding-top: var(--spacing-lg); border-top: 1px solid var(--light-gray);">
                        <p class="text-muted">Remember your password? <a href="login.php" style="color: var(--primary-color); font-weight: 600;">Back to login</a></p>
                        <p class="text-muted">Don't have an account? <a href="register.php" style="color: var(--primary-color); font-weight: 600;">Create one</a></p>
                    </div>
                </div>

                <!-- Help Text -->
                <div style="text-align: center; margin-top: var(--spacing-xl); color: #999; font-size: 0.85rem;">
                    <p>Not receiving an email? <a href="../contact.php" style="color: var(--primary-color);">Contact our support team</a></p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>
