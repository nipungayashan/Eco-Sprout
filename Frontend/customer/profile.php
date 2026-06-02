<?php
require_once __DIR__ . '/../includes/customer_auth.php';

$pageTitle = 'Edit Profile - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
include '../includes/header.php';
?>

<main>
    <!-- Profile Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- Sidebar Navigation -->
                <div class="col-md-3 mb-4">
                    <div class="sidebar">
                        <h3 class="filter-title">My Account</h3>
                        <ul class="footer-links" style="padding: 0;">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="profile.php" style="color: var(--primary-color); font-weight: 600;">Edit Profile</a></li>
                            <li><a href="orders.php">My Orders</a></li>
                            <li><a href="bookings.php">My Bookings</a></li>
                            <li><a href="wishlist.php">Wishlist</a></li>
                            <li><a href="settings.php">Settings</a></li>
                            <li><a href="../auth/logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-9">
                    <h1 style="margin-bottom: var(--spacing-lg);">Edit Profile</h1>

                    <!-- Tabs -->
                    <div class="card" style="margin-bottom: var(--spacing-lg);">
                        <div style="display: flex; gap: var(--spacing-md); border-bottom: 1px solid var(--light-gray); margin-bottom: var(--spacing-lg);">
                            <button style="padding: var(--spacing-md); border: none; background: none; color: var(--primary-color); border-bottom: 3px solid var(--primary-color); cursor: pointer; font-weight: 600;">Personal Info</button>
                            <button style="padding: var(--spacing-md); border: none; background: none; color: #999; cursor: pointer; font-weight: 600;">Addresses</button>
                            <button style="padding: var(--spacing-md); border: none; background: none; color: #999; cursor: pointer; font-weight: 600;">Change Password</button>
                        </div>

                        <!-- Personal Information Form -->
                        <form id="profileForm">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="firstName">First Name *</label>
                                        <input type="text" id="firstName" value="John" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="lastName">Last Name *</label>
                                        <input type="text" id="lastName" value="Doe" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" value="john.doe@example.com" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" value="+1 (555) 123-4567">
                            </div>

                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" value="1990-05-15">
                            </div>

                            <div class="form-group">
                                <label for="bio">About Me</label>
                                <textarea id="bio" placeholder="Tell us about yourself...">Plant enthusiast and gardening lover</textarea>
                            </div>

                            <div class="form-group">
                                <label for="preferences">Email Preferences</label>
                                <label style="display: flex; align-items: center; gap: var(--spacing-sm); font-weight: 400; margin: var(--spacing-md) 0; cursor: pointer;">
                                    <input type="checkbox" checked>
                                    <span>Receive promotional emails</span>
                                </label>
                                <label style="display: flex; align-items: center; gap: var(--spacing-sm); font-weight: 400; margin: var(--spacing-md) 0; cursor: pointer;">
                                    <input type="checkbox" checked>
                                    <span>Receive order updates</span>
                                </label>
                                <label style="display: flex; align-items: center; gap: var(--spacing-sm); font-weight: 400; margin: var(--spacing-md) 0; cursor: pointer;">
                                    <input type="checkbox" checked>
                                    <span>Receive newsletter</span>
                                </label>
                            </div>

                            <button type="submit" class="btn-primary">Save Changes</button>
                            <button type="button" class="btn-outline" style="margin-left: var(--spacing-md);">Cancel</button>
                        </form>
                    </div>

                    <!-- Danger Zone -->
                    <div class="card" style="border: 1px solid #d32f2f; background-color: rgba(211, 47, 47, 0.05);">
                        <h3 style="color: #d32f2f; margin-bottom: var(--spacing-md);">Danger Zone</h3>
                        <p class="text-muted" style="margin-bottom: var(--spacing-lg);">These actions cannot be undone. Please proceed with caution.</p>
                        <button class="btn-outline" style="border-color: #d32f2f; color: #d32f2f;">Deactivate Account</button>
                        <button class="btn-outline" style="border-color: #d32f2f; color: #d32f2f; margin-left: var(--spacing-md);">Delete Account Permanently</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>
