<?php
$pageTitle = 'Article - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
include '../includes/header.php';
?>

<main>
    <!-- Article Section -->
    <section class="section">
        <div class="container">
            <a href="../blog.php" class="btn-outline btn-small" style="margin-bottom: var(--spacing-lg);">← Back to Blog</a>
            
            <article>
                <div style="max-width: 800px; margin: 0 auto;">
                    <div style="background-color: var(--primary-color); color: white; display: inline-block; padding: 4px 12px; border-radius: 20px; margin-bottom: var(--spacing-md); font-size: 0.75rem; font-weight: 600;">Plant Care</div>
                    
                    <h1 style="margin-bottom: var(--spacing-md);">How to Revive a Dying Plant</h1>
                    
                    <div style="display: flex; gap: var(--spacing-lg); margin-bottom: var(--spacing-xl); color: #999; font-size: 0.9rem;">
                        <span>Published: June 1, 2024</span>
                        <span>Reading time: 8 minutes</span>
                    </div>

                    <img src="../assets/images/blog-1.jpg" alt="Article" style="width: 100%; border-radius: var(--border-radius-lg); margin-bottom: var(--spacing-xl);">

                    <p>Has one of your beloved houseplants suddenly started to droop? Don't worry! Many plants can be revived with the right care and attention. In this comprehensive guide, we'll explore the common signs of a dying plant and provide you with actionable steps to bring your green friend back to life.</p>

                    <h2 style="margin-top: var(--spacing-xl);">Signs Your Plant is Struggling</h2>
                    <p>Before you can save a plant, you need to understand what's going wrong. Here are the most common signs of plant distress:</p>
                    <ul style="margin-left: var(--spacing-lg); margin-bottom: var(--spacing-lg);">
                        <li>Yellowing or browning leaves</li>
                        <li>Wilting or drooping stems</li>
                        <li>Mushy roots or soil that smells bad</li>
                        <li>Stunted growth</li>
                        <li>Pest infestations</li>
                    </ul>

                    <h2 style="margin-top: var(--spacing-xl);">Step-by-Step Revival Process</h2>
                    <p>Follow these steps to revive your dying plant:</p>

                    <h3 style="color: var(--primary-color); margin-top: var(--spacing-lg);">1. Assess the Situation</h3>
                    <p>First, carefully examine your plant. Check the soil moisture, look for pests, and inspect the roots if possible. Understanding the root cause is crucial for treatment.</p>

                    <h3 style="color: var(--primary-color); margin-top: var(--spacing-lg);">2. Adjust Watering</h3>
                    <p>Overwatering is the leading cause of plant death. Ensure the soil is moist but not waterlogged. Most plants prefer to dry out slightly between waterings.</p>

                    <h3 style="color: var(--primary-color); margin-top: var(--spacing-lg);">3. Optimize Lighting</h3>
                    <p>Move your plant to a location with appropriate light levels for its species. Most houseplants thrive in bright, indirect light.</p>

                    <h3 style="color: var(--primary-color); margin-top: var(--spacing-lg);">4. Prune Dead Growth</h3>
                    <p>Remove dead leaves and stems using clean scissors. This helps the plant focus energy on new, healthy growth.</p>

                    <h3 style="color: var(--primary-color); margin-top: var(--spacing-lg);">5. Repot if Necessary</h3>
                    <p>If the roots are rotting or the soil is depleted, repot your plant into fresh, well-draining soil.</p>

                    <h2 style="margin-top: var(--spacing-xl);">Common Mistakes to Avoid</h2>
                    <ul style="margin-left: var(--spacing-lg); margin-bottom: var(--spacing-lg);">
                        <li>Watering too frequently</li>
                        <li>Ignoring pest problems</li>
                        <li>Placing plants in unsuitable light conditions</li>
                        <li>Using cold water</li>
                        <li>Repotting too frequently</li>
                    </ul>

                    <h2 style="margin-top: var(--spacing-xl);">Patience is Key</h2>
                    <p>Remember that plant recovery takes time. Don't expect dramatic changes overnight. With consistent care and attention, most plants can be revived within a few weeks to a few months.</p>

                    <div style="background-color: #f0f0f0; padding: var(--spacing-lg); border-radius: var(--border-radius); margin-top: var(--spacing-xl);">
                        <p><strong>Pro Tip:</strong> Keep a gardening journal to track your plant care routine. This helps you identify patterns and make informed adjustments.</p>
                    </div>
                </div>

                <!-- Related Articles -->
                <div style="margin-top: var(--spacing-xxl); border-top: 1px solid var(--light-gray); padding-top: var(--spacing-xl);">
                    <h2>Related Articles</h2>
                    <div class="row mt-3">
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <img src="../assets/images/blog-2.jpg" alt="Related" class="card-image">
                                <h3 class="card-title">Summer Garden Maintenance</h3>
                                <p class="card-text">Keep your garden thriving during hot summer months.</p>
                                <a href="article.php?id=2" class="btn-outline btn-small">Read More</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <img src="../assets/images/blog-4.jpg" alt="Related" class="card-image">
                                <h3 class="card-title">Best Plants for Beginners</h3>
                                <p class="card-text">Starting your plant journey? Here are the top easiest plants.</p>
                                <a href="article.php?id=4" class="btn-outline btn-small">Read More</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <img src="../assets/images/blog-5.jpg" alt="Related" class="card-image">
                                <h3 class="card-title">Eco-Friendly Gardening</h3>
                                <p class="card-text">Learn sustainable gardening practices for your garden.</p>
                                <a href="article.php?id=5" class="btn-outline btn-small">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>
