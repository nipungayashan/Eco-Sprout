<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/helpers.php';

$featured_stmt = $pdo->query('SELECT * FROM plants WHERE is_active = 1 ORDER BY id ASC LIMIT 4');
$featured_plants = $featured_stmt->fetchAll();

$pageTitle = 'Home - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to EcoSprout Nursery</h1>
            <p class="hero-subtitle">Discover the beauty of nature with our premium selection of plants, gardening tools, and expert services.</p>
            <div class="hero-cta">
                <a href="catalogue.php" class="btn-primary">Shop Plants</a>
                <a href="about.php" class="btn-secondary">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Featured Plants Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Featured Plants</h2>
                <p class="section-subtitle">Handpicked selection of our most popular and beautiful plants.</p>
            </div>
            
            <div class="row mb-4">
                <?php if (count($featured_plants) === 0) { ?>
                <div class="col-12"><p class="text-muted text-center">No plants available yet.</p></div>
                <?php } ?>
                <?php foreach ($featured_plants as $plant) {
                  $price = number_format((float)$plant['price'], 2, '.', '');
                ?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card">
                        <a href="plant.php?id=<?php echo (int)$plant['id']; ?>">
                            <img src="<?php echo e($plant['image_url']); ?>" alt="<?php echo e($plant['name']); ?>" class="card-image">
                        </a>
                        <h3 class="card-title"><?php echo e($plant['name']); ?></h3>
                        <p class="card-text"><?php echo e($plant['description']); ?></p>
                        <p class="card-price">$<?php echo e(number_format((float)$plant['price'], 2)); ?></p>
                        <div class="card-footer">
                            <?php if ((int)$plant['stock'] > 0) { ?>
                            <button type="button" class="btn-primary btn-small" onclick="addToCart('plant', <?php echo (int)$plant['id']; ?>, '<?php echo e($plant['name']); ?>', <?php echo $price; ?>, 1, '<?php echo e($plant['image_url']); ?>', <?php echo (int)$plant['stock']; ?>)">Add to Cart</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="text-center mt-4">
                <a href="catalogue.php" class="btn-outline">View All Plants</a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="section" style="background-color: #f0f0f0;">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose EcoSprout</h2>
                <p class="section-subtitle">We are committed to providing the best plants and services for your gardening journey.</p>
            </div>
            
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card text-center">
                        <h4 style="color: var(--primary-color); font-size: 2rem;">🌱</h4>
                        <h4>Premium Quality</h4>
                        <p>All our plants are carefully selected and maintained for optimal health.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card text-center">
                        <h4 style="color: var(--primary-color); font-size: 2rem;">🚚</h4>
                        <h4>Fast Delivery</h4>
                        <p>We deliver your plants quickly and safely to your doorstep.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card text-center">
                        <h4 style="color: var(--primary-color); font-size: 2rem;">💡</h4>
                        <h4>Expert Guidance</h4>
                        <p>Get advice from our team of experienced gardening professionals.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card text-center">
                        <h4 style="color: var(--primary-color); font-size: 2rem;">🌍</h4>
                        <h4>Eco-Friendly</h4>
                        <p>We are committed to sustainable and environmentally responsible practices.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Showcase Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Our Services</h2>
                <p class="section-subtitle">Beyond plants, we offer comprehensive solutions for your garden.</p>
            </div>
            
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <h4 style="color: var(--primary-color);">🌿 Plant Care</h4>
                        <p>Professional plant maintenance and care consultations for healthy, thriving gardens.</p>
                        <a href="services.php" class="btn-outline btn-small">Learn More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <h4 style="color: var(--primary-color);">📚 Workshops</h4>
                        <p>Join our expert-led workshops and learn essential gardening skills and techniques.</p>
                        <a href="workshops.php" class="btn-outline btn-small">Learn More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <h4 style="color: var(--primary-color);">🎨 Garden Design</h4>
                        <p>Custom garden design services to transform your outdoor space beautifully.</p>
                        <a href="services.php" class="btn-outline btn-small">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Signup Section -->
    <section class="section" style="background: linear-gradient(135deg, #2D6A4F 0%, #52B788 100%);">
        <div class="container text-center">
            <h2 style="color: white; margin-bottom: var(--spacing-lg);">Stay Updated with EcoSprout</h2>
            <p style="color: white; margin-bottom: var(--spacing-xl); font-size: 1.05rem;">Subscribe to our newsletter for plant care tips, new arrivals, and exclusive offers.</p>
            
            <form id="newsletterForm" style="max-width: 500px; margin: 0 auto;">
                <div class="form-group" style="display: flex; gap: var(--spacing-md);">
                    <input type="email" id="newsletterEmail" placeholder="Enter your email" required>
                    <button type="submit" class="btn-primary">Subscribe</button>
                </div>
                <div id="newsletterError" class="error-message" style="color: #FFB800; text-align: left;"></div>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
