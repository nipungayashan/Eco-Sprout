    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="row footer-content">
                <!-- Company Info -->
                <div class="col-md-3 footer-section">
                    <h4 class="footer-title">EcoSprout</h4>
                    <p class="footer-text">Growing nature, nurturing sustainability. Your trusted nursery for quality plants and gardening solutions.</p>
                </div>
                
                <!-- Quick Links -->
                <div class="col-md-3 footer-section">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="catalogue.php">Plants</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="about.php">About Us</a></li>
                    </ul>
                </div>
                
                <!-- Resources -->
                <div class="col-md-3 footer-section">
                    <h4 class="footer-title">Resources</h4>
                    <ul class="footer-links">
                        <li><a href="workshops.php">Workshops</a></li>
                        <li><a href="tools.php">Tools & Accessories</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="col-md-3 footer-section">
                    <h4 class="footer-title">Get In Touch</h4>
                    <p class="footer-text">
                        <strong>Email:</strong> info@ecosprout.com<br>
                        <strong>Phone:</strong> +1 (555) 123-4567<br>
                        <strong>Address:</strong> 123 Green Lane, Eco City, EC 12345
                    </p>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p>&copy; 2026 EcoSprout Nursery. All rights reserved. | Designed with <span class="heart">♥</span> for nature.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS (for modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script src="<?php echo isset($jsPath) ? $jsPath : (isset($siteRoot) ? $siteRoot : '') . 'assets/js/main.js'; ?>"></script>
    <script src="<?php echo isset($siteRoot) ? $siteRoot : ''; ?>assets/js/cart.js"></script>
</body>
</html>
