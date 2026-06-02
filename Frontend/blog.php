<?php
$pageTitle = 'Blog & Resources - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="hero" style="padding: var(--spacing-xl) var(--spacing-lg);">
        <div class="hero-content">
            <h1>Blog & Resources</h1>
            <p class="hero-subtitle">Tips, guides, and inspiration for your gardening journey.</p>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- Blog Post 1 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <img src="assets/images/blog-1.jpg" alt="Blog Post" class="card-image">
                        <div style="background-color: var(--primary-color); color: white; padding: 4px 8px; border-radius: 20px; display: inline-block; margin-bottom: var(--spacing-md); font-size: 0.75rem; font-weight: 600;">Plant Care</div>
                        <h3 class="card-title">How to Revive a Dying Plant</h3>
                        <p class="text-muted">June 1, 2024</p>
                        <p class="card-text">Discover step-by-step tips to rescue and revive your struggling houseplants. Learn the common mistakes and how to avoid them.</p>
                        <a href="article.php?id=1" class="btn-outline btn-small">Read More</a>
                    </div>
                </div>

                <!-- Blog Post 2 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <img src="assets/images/blog-2.jpg" alt="Blog Post" class="card-image">
                        <div style="background-color: var(--light-green); color: white; padding: 4px 8px; border-radius: 20px; display: inline-block; margin-bottom: var(--spacing-md); font-size: 0.75rem; font-weight: 600;">Seasonal Tips</div>
                        <h3 class="card-title">Summer Garden Maintenance Guide</h3>
                        <p class="text-muted">May 28, 2024</p>
                        <p class="card-text">Keep your garden thriving during hot summer months. Learn watering schedules, heat protection, and seasonal plant care.</p>
                        <a href="article.php?id=2" class="btn-outline btn-small">Read More</a>
                    </div>
                </div>

                <!-- Blog Post 3 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <img src="assets/images/blog-3.jpg" alt="Blog Post" class="card-image">
                        <div style="background-color: var(--accent-color); color: var(--text-color); padding: 4px 8px; border-radius: 20px; display: inline-block; margin-bottom: var(--spacing-md); font-size: 0.75rem; font-weight: 600;">DIY Projects</div>
                        <h3 class="card-title">DIY Vertical Garden Setup</h3>
                        <p class="text-muted">May 25, 2024</p>
                        <p class="card-text">Transform your space with a beautiful vertical garden. Complete step-by-step tutorial and material list included.</p>
                        <a href="article.php?id=3" class="btn-outline btn-small">Read More</a>
                    </div>
                </div>

                <!-- Blog Post 4 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <img src="assets/images/blog-4.jpg" alt="Blog Post" class="card-image">
                        <div style="background-color: var(--primary-color); color: white; padding: 4px 8px; border-radius: 20px; display: inline-block; margin-bottom: var(--spacing-md); font-size: 0.75rem; font-weight: 600;">Beginner Tips</div>
                        <h3 class="card-title">Best Plants for Beginners</h3>
                        <p class="text-muted">May 20, 2024</p>
                        <p class="card-text">Starting your plant journey? Here are the top 10 easiest plants for beginners with minimal care requirements.</p>
                        <a href="article.php?id=4" class="btn-outline btn-small">Read More</a>
                    </div>
                </div>

                <!-- Blog Post 5 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <img src="assets/images/blog-5.jpg" alt="Blog Post" class="card-image">
                        <div style="background-color: var(--light-green); color: white; padding: 4px 8px; border-radius: 20px; display: inline-block; margin-bottom: var(--spacing-md); font-size: 0.75rem; font-weight: 600;">Sustainability</div>
                        <h3 class="card-title">Eco-Friendly Gardening Practices</h3>
                        <p class="text-muted">May 15, 2024</p>
                        <p class="card-text">Learn how to garden sustainably with composting, organic fertilizers, and water conservation techniques.</p>
                        <a href="article.php?id=5" class="btn-outline btn-small">Read More</a>
                    </div>
                </div>

                <!-- Blog Post 6 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <img src="assets/images/blog-6.jpg" alt="Blog Post" class="card-image">
                        <div style="background-color: var(--accent-color); color: var(--text-color); padding: 4px 8px; border-radius: 20px; display: inline-block; margin-bottom: var(--spacing-md); font-size: 0.75rem; font-weight: 600;">Plant Profiles</div>
                        <h3 class="card-title">Rare Houseplants You Must Grow</h3>
                        <p class="text-muted">May 10, 2024</p>
                        <p class="card-text">Explore unique and exotic houseplants that will add character and intrigue to your collection.</p>
                        <a href="article.php?id=6" class="btn-outline btn-small">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
