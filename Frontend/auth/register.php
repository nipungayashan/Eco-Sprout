<?php
session_start();

$pageTitle = 'Register - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
include '../includes/header.php';

$register_errors = array();
if (isset($_SESSION['register_errors'])) {
  $register_errors = $_SESSION['register_errors'];
  unset($_SESSION['register_errors']);
}

$old_fullname = '';
$old_email = '';
$old_phone = '';
if (isset($_SESSION['register_old'])) {
  $old_fullname = isset($_SESSION['register_old']['fullname']) ? $_SESSION['register_old']['fullname'] : '';
  $old_email = isset($_SESSION['register_old']['email']) ? $_SESSION['register_old']['email'] : '';
  $old_phone = isset($_SESSION['register_old']['phone']) ? $_SESSION['register_old']['phone'] : '';
  unset($_SESSION['register_old']);
}
?>

<main>
    <section class="section" style="min-height: 70vh; display: flex; align-items: center;">
        <div class="container">
            <div style="max-width: 500px; margin: 0 auto;">
                <div class="card" style="box-shadow: 0 4px 16px rgba(45, 106, 79, 0.15);">
                    <div style="text-align: center; margin-bottom: var(--spacing-xl);">
                        <h1 style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: var(--spacing-sm);">EcoSprout</h1>
                        <h2 style="font-size: 1.5rem; font-weight: 400;">Create Account</h2>
                        <p class="text-muted">Your email will be used to sign in</p>
                    </div>

                    <?php if (count($register_errors) > 0) { ?>
                    <div style="background-color: #ffebee; color: #c62828; padding: var(--spacing-md); border-radius: 4px; margin-bottom: var(--spacing-lg); font-size: 0.9rem;">
                        <ul style="margin: 0; padding-left: 1.2rem;">
                            <?php
                            for ($i = 0; $i < count($register_errors); $i++) {
                              echo '<li>' . htmlspecialchars($register_errors[$i], ENT_QUOTES, 'UTF-8') . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <?php } ?>

                    <form id="registerForm" method="post" action="register-handler.php" style="margin-bottom: var(--spacing-lg);">
                        <div class="form-group">
                            <label for="fullname">Full Name *</label>
                            <input type="text" id="fullname" name="fullname" placeholder="John Doe" value="<?php echo htmlspecialchars($old_fullname, ENT_QUOTES, 'UTF-8'); ?>" required>
                            <div id="fullnameError" class="error-message" style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;"></div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" value="<?php echo htmlspecialchars($old_email, ENT_QUOTES, 'UTF-8'); ?>" required>
                            <div id="emailError" class="error-message" style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;"></div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="+1 (555) 123-4567" value="<?php echo htmlspecialchars($old_phone, ENT_QUOTES, 'UTF-8'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="password" placeholder="Enter a strong password" required>
                            <div id="passwordError" class="error-message" style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;"></div>
                            <p style="font-size: 0.8rem; color: #999; margin-top: 4px;">At least 8 characters with uppercase, lowercase, and numbers</p>
                        </div>

                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password *</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                            <div id="confirmPasswordError" class="error-message" style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;"></div>
                        </div>

                        <div style="margin-bottom: var(--spacing-lg);">
                            <label style="display: flex; align-items: flex-start; gap: var(--spacing-sm); font-weight: 400; margin: 0; cursor: pointer;">
                                <input type="checkbox" id="terms" name="terms" required style="margin-top: 4px;">
                                <span style="font-size: 0.9rem;">I agree to the Terms of Service and Privacy Policy *</span>
                            </label>
                            <div id="termsError" class="error-message" style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;"></div>
                        </div>

                        <button type="submit" class="btn-primary" style="width: 100%; padding: var(--spacing-md); font-size: 1rem; margin-bottom: var(--spacing-lg);">Create Account</button>
                    </form>

                    <div style="text-align: center; padding-top: var(--spacing-lg); border-top: 1px solid var(--light-gray);">
                        <p class="text-muted">Already have an account? <a href="login.php" style="color: var(--primary-color); font-weight: 600;">Sign in here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>
