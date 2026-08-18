<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/helpers.php';

$pageTitle = 'Blog & Resources - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';

/* Fetch blog posts from database */
$blog_stmt = $pdo->query("
    SELECT *
    FROM blog_articles
    WHERE is_active = 1
    ORDER BY published_at DESC
");

$blogs = $blog_stmt->fetchAll();

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

                <?php if (count($blogs) === 0) { ?>
                    <div class="col-12">
                        <p class="text-muted text-center">No blog posts available at the moment.</p>
                    </div>
                <?php } ?>

                <?php foreach ($blogs as $blog) { ?>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card">

                            <!-- Image -->
                            <?php if (!empty($blog['image_url'])) { ?>
                                <img src="<?php echo e($blog['image_url']); ?>"
                                     alt="<?php echo e($blog['title']); ?>"
                                     class="card-image">
                            <?php } ?>

                            <!-- Category -->
                            <?php if (!empty($blog['category'])) { ?>
                                <div style="background-color: var(--primary-color); color: white; padding: 4px 10px; border-radius: 20px; display: inline-block; margin-bottom: var(--spacing-md); font-size: 0.75rem; font-weight: 600;">
                                    <?php echo e($blog['category']); ?>
                                </div>
                            <?php } ?>

                            <!-- Title -->
                            <h3 class="card-title">
                                <?php echo e($blog['title']); ?>
                            </h3>

                            <!-- Date -->
                            <p class="text-muted">
                                <?php echo date('F j, Y', strtotime($blog['published_at'])); ?>
                            </p>

                            <!-- Content preview -->
                            <p class="card-text">
                                <?php echo e(substr(strip_tags($blog['content']), 0, 120)); ?>...
                            </p>

                            <!-- Button -->
                            <a href="article.php?id=<?php echo (int)$blog['id']; ?>"
                               class="btn-outline btn-small">
                                Read More
                            </a>

                        </div>
                    </div>

                <?php } ?>

            </div>

        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>