<?php
$pageTitle = 'About Us - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="hero" style="padding: var(--spacing-xl) var(--spacing-lg);">
        <div class="hero-content">
            <h1>About EcoSprout Nursery</h1>
            <p class="hero-subtitle">Growing nature, nurturing sustainability for over 15 years.</p>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-6 mb-4">
                    <img src="assets/images/about-1.jpg" alt="Our Nursery" style="width: 100%; border-radius: var(--border-radius-lg);">
                </div>
                <div class="col-md-6">
                    <h2>Our Story</h2>
                    <p>EcoSprout Nursery was founded in 2009 with a simple mission: to make quality plants and gardening knowledge accessible to everyone. What started as a small local nursery has grown into a thriving community of plant enthusiasts and gardeners.</p>
                    <p>We believe that connecting with nature through plants improves not only our physical spaces but also our mental and emotional well-being. Every plant we nurture is a step towards a greener, more sustainable world.</p>
                    <p>Today, EcoSprout serves thousands of satisfied customers through our physical nursery, online store, and educational workshops.</p>
                </div>
            </div>

            <!-- Mission, Vision, Values -->
            <div class="row mb-5">
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <h3 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">Our Mission</h3>
                        <p>To provide premium quality plants and expert gardening services that inspire and empower people to connect with nature.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <h3 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">Our Vision</h3>
                        <p>To be the leading eco-conscious nursery, fostering a community of sustainable gardeners and nature lovers.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <h3 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">Our Values</h3>
                        <p>Sustainability, quality, community, expertise, and a deep commitment to environmental responsibility.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="section" style="background-color: #f0f0f0;">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: var(--spacing-xl);">Why Choose EcoSprout?</h2>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card">
                        <h4 style="color: var(--primary-color); font-size: 2rem; text-align: center;">15+</h4>
                        <p style="text-align: center; font-weight: 600;">Years of Experience</p>
                        <p style="text-align: center; font-size: 0.9rem;">Serving the gardening community since 2009.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card">
                        <h4 style="color: var(--primary-color); font-size: 2rem; text-align: center;">5000+</h4>
                        <p style="text-align: center; font-weight: 600;">Happy Customers</p>
                        <p style="text-align: center; font-size: 0.9rem;">Trusted by thousands nationwide.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card">
                        <h4 style="color: var(--primary-color); font-size: 2rem; text-align: center;">100%</h4>
                        <p style="text-align: center; font-weight: 600;">Eco-Friendly</p>
                        <p style="text-align: center; font-size: 0.9rem;">Committed to sustainable practices.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card">
                        <h4 style="color: var(--primary-color); font-size: 2rem; text-align: center;">50+</h4>
                        <p style="text-align: center; font-weight: 600;">Plant Species</p>
                        <p style="text-align: center; font-size: 0.9rem;">Curated selection of quality plants.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: var(--spacing-xl);">Meet Our Team</h2>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card text-center">
                        <div style="width: 100px; height: 100px; background-color: var(--light-gray); border-radius: 50%; margin: 0 auto var(--spacing-md); display: flex; align-items: center; justify-content: center; font-size: 2rem;">🌿</div>
                        <h4>Sarah Johnson</h4>
                        <p class="text-muted">Founder & Head Botanist</p>
                        <p>15+ years of horticultural expertise and passion for sustainable gardening.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card text-center">
                        <div style="width: 100px; height: 100px; background-color: var(--light-gray); border-radius: 50%; margin: 0 auto var(--spacing-md); display: flex; align-items: center; justify-content: center; font-size: 2rem;">🌱</div>
                        <h4>Michael Chen</h4>
                        <p class="text-muted">Plant Specialist</p>
                        <p>Expert in indoor plant care with a focus on rare and exotic species.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card text-center">
                        <div style="width: 100px; height: 100px; background-color: var(--light-gray); border-radius: 50%; margin: 0 auto var(--spacing-md); display: flex; align-items: center; justify-content: center; font-size: 2rem;">🌸</div>
                        <h4>Emma Williams</h4>
                        <p class="text-muted">Garden Designer</p>
                        <p>Creates stunning landscape designs with sustainability in mind.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card text-center">
                        <div style="width: 100px; height: 100px; background-color: var(--light-gray); border-radius: 50%; margin: 0 auto var(--spacing-md); display: flex; align-items: center; justify-content: center; font-size: 2rem;">🌻</div>
                        <h4>David Martinez</h4>
                        <p class="text-muted">Workshop Coordinator</p>
                        <p>Leads engaging workshops and community events for all skill levels.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Commitment Section -->
    <section class="section" style="background: linear-gradient(135deg, #2D6A4F 0%, #52B788 100%); color: white;">
        <div class="container text-center">
            <h2 style="color: white; margin-bottom: var(--spacing-lg);">Our Commitment to Sustainability</h2>
            <p style="font-size: 1.05rem; margin-bottom: var(--spacing-lg);">We are dedicated to minimizing our environmental impact through responsible sourcing, organic practices, and eco-friendly packaging.</p>
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <h4 style="color: white;">Organic Growing</h4>
                    <p>All our plants are grown using organic, chemical-free methods.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h4 style="color: white;">Eco-Friendly Packaging</h4>
                    <p>We use biodegradable and recyclable materials for all shipments.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h4 style="color: white;">Community Programs</h4>
                    <p>We support local environmental initiatives and tree-planting projects.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
