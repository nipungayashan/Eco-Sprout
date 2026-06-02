<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/helpers.php';

$tools_stmt = $pdo->query('SELECT * FROM tools WHERE is_active = 1 ORDER BY name ASC');
$tools = $tools_stmt->fetchAll();

$pageTitle = 'Tools & Accessories - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
?>
<main>
    <section class="hero" style="padding: var(--spacing-xl) var(--spacing-lg);">
        <div class="hero-content">
            <h1>Tools & Accessories</h1>
            <p class="hero-subtitle">Everything you need for successful gardening and plant care.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <?php if (count($tools) === 0) { ?>
                <div class="col-12"><p class="text-muted">No tools available at the moment.</p></div>
                <?php } ?>
                <?php foreach ($tools as $tool) {
                  $price = number_format((float)$tool['price'], 2, '.', '');
                  $cart_id = 't' . (int)$tool['id'];
                ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <a href="tool.php?id=<?php echo (int)$tool['id']; ?>"><img src="<?php echo e($tool['image_url']); ?>" alt="<?php echo e($tool['name']); ?>" class="card-image"></a>
                        <h3 class="card-title"><a href="tool.php?id=<?php echo (int)$tool['id']; ?>" style="color:inherit;text-decoration:none;"><?php echo e($tool['name']); ?></a></h3>
                        <p class="card-text"><?php echo e($tool['description']); ?></p>
                        <p class="card-price">$<?php echo e(number_format((float)$tool['price'], 2)); ?></p>
                        <div class="card-footer" style="display:flex;gap:8px;flex-wrap:wrap;">
                            <a href="tool.php?id=<?php echo (int)$tool['id']; ?>" class="btn-outline btn-small">View</a>
                            <?php if ((int)$tool['stock'] > 0) { ?>
                            <button type="button" class="btn-primary btn-small" onclick="addToCart('tool', <?php echo (int)$tool['id']; ?>, '<?php echo e($tool['name']); ?>', <?php echo $price; ?>, 1, '<?php echo e($tool['image_url']); ?>', <?php echo (int)$tool['stock']; ?>)">Add to Cart</button>
                            <?php } else { ?>
                            <span class="badge" style="background-color:#FF9500;color:white;">Out of Stock</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<?php include 'includes/footer.php'; ?>

