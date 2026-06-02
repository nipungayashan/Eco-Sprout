<?php
session_start();

$pageTitle = 'Login - EcoSprout Nursery';
$siteRoot = '../';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$login_redirect = isset($_GET['redirect']) ? htmlspecialchars($_GET['redirect'], ENT_QUOTES, 'UTF-8') : '';
include '../includes/header.php';

$login_errors = array();
if (isset($_SESSION['login_errors'])) {
  $login_errors = $_SESSION['login_errors'];
  unset($_SESSION['login_errors']);
}

$register_success = '';
if (isset($_SESSION['register_success'])) {
  $register_success = $_SESSION['register_success'];
  unset($_SESSION['register_success']);
}
?>

<main>
    <section class="section" style="min-height: 70vh; display: flex; align-items: center;">
        <div class="container">
            <div style="max-width: 450px; margin: 0 auto;">
                <div class="card" style="box-shadow: 0 4px 16px rgba(45, 106, 79, 0.15);">
                    <div style="text-align: center; margin-bottom: var(--spacing-xl);">
                        <h1 style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: var(--spacing-sm);">EcoSprout</h1>
                        <h2 style="font-size: 1.5rem; font-weight: 400;">Welcome Back</h2>
                        <p class="text-muted">Sign in with your email and password</p>
                    </div>

                    <?php if ($register_success !== '') { ?>
                    <div style="background-color: #e8f5e9; color: #2e7d32; padding: var(--spacing-md); border-radius: 4px; margin-bottom: var(--spacing-lg); font-size: 0.9rem;">
                        <?php echo htmlspecialchars($register_success, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                    <?php } ?>

                    <?php if (count($login_errors) > 0) { ?>
                    <div style="background-color: #ffebee; color: #c62828; padding: var(--spacing-md); border-radius: 4px; margin-bottom: var(--spacing-lg); font-size: 0.9rem;">
                        <ul style="margin: 0; padding-left: 1.2rem;">
                            <?php
                            for ($i = 0; $i < count($login_errors); $i++) {
                              echo '<li>' . htmlspecialchars($login_errors[$i], ENT_QUOTES, 'UTF-8') . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <?php } ?>

                    <form id="loginForm" method="post" action="login-handler.php" style="margin-bottom: var(--spacing-lg);">
                        <?php if ($login_redirect !== '') { ?>
                        <input type="hidden" name="redirect" value="<?php echo $login_redirect; ?>">
                        <?php } ?>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" required autocomplete="email">
                            <div id="emailError" class="error-message" style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;"></div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                            <div id="passwordError" class="error-message" style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;"></div>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-lg); font-size: 0.9rem;">
                            <label style="display: flex; align-items: center; gap: var(--spacing-sm); font-weight: 400; margin: 0;">
                                <input type="checkbox" name="remember">
                                Remember me
                            </label>
                            <a href="forgot.php" style="color: var(--primary-color);">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn-primary" style="width: 100%; padding: var(--spacing-md); font-size: 1rem; margin-bottom: var(--spacing-lg);">Sign In</button>
                    </form>

                    <div style="text-align: center; padding-top: var(--spacing-lg); border-top: 1px solid var(--light-gray);">
                        <p class="text-muted">Don't have an account? <a href="register.php" style="color: var(--primary-color); font-weight: 600;">Sign up here</a></p>
                    </div>
                </div>

                <div style="text-align: center; margin-top: var(--spacing-xl); color: #999; font-size: 0.85rem;">
                    <p>Having trouble logging in? <a href="../contact.php" style="color: var(--primary-color);">Contact support</a></p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>
