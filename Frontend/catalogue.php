<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/helpers.php';

$plants_stmt = $pdo->query('SELECT * FROM plants WHERE is_active = 1 ORDER BY name ASC');
$plants = $plants_stmt->fetchAll();

$cat_stmt = $pdo->query('SELECT DISTINCT category FROM plants WHERE is_active = 1 ORDER BY category');
$categories = $cat_stmt->fetchAll(PDO::FETCH_COLUMN);

$pageTitle = 'Plant Catalogue - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
?>
<main>
    <section class="hero" style="padding: var(--spacing-xl) var(--spacing-lg);">
        <div class="hero-content">
            <h1>Plant Catalogue</h1>
            <p class="hero-subtitle">Browse our extensive collection of indoor and outdoor plants.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <div class="sidebar">
                        <h3 class="filter-title">Filter Plants</h3>
                        <div class="form-group">
                            <input type="text" id="searchInput" placeholder="Search plants..." onkeyup="searchProducts()">
                        </div>
                        <div class="filter-group">
                            <h4 class="filter-title" style="font-size: 1rem;">Category</h4>
                            <label class="filter-label">
                                <input type="checkbox" onchange="filterByCategory('all')" checked> All Plants
                            </label>
                            <?php foreach ($categories as $cat) {
                              $cat_key = strtolower($cat);
                            ?>
                            <label class="filter-label">
                                <input type="checkbox" onchange="filterByCategory('<?php echo e($cat_key); ?>')"> <?php echo e($cat); ?>
                            </label>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="row">
                        <?php if (count($plants) === 0) { ?>
                        <div class="col-12"><p class="text-muted">No plants available at the moment.</p></div>
                        <?php } ?>
                        <?php foreach ($plants as $plant) {
                          $cat_key = strtolower($plant['category']);
                          $price = number_format((float)$plant['price'], 2, '.', '');
                        ?>
                        <div class="col-md-6 col-lg-4 mb-4 product-item" data-category="<?php echo e($cat_key); ?>">
                            <div class="card">
                                <a href="plant.php?id=<?php echo (int)$plant['id']; ?>">
                                    <img src="<?php echo e($plant['image_url']); ?>" alt="<?php echo e($plant['name']); ?>" class="card-image">
                                </a>
                                <h3 class="card-title"><a href="plant.php?id=<?php echo (int)$plant['id']; ?>" style="color:inherit;text-decoration:none;"><?php echo e($plant['name']); ?></a></h3>
                                <p class="text-muted"><?php echo e($plant['category']); ?> • <?php echo e($plant['difficulty']); ?></p>
                                <p class="card-text"><?php echo e($plant['description']); ?></p>
                                <p class="card-price">$<?php echo e(number_format((float)$plant['price'], 2)); ?></p>
                                <div class="card-footer" style="display:flex;gap:8px;flex-wrap:wrap;">
                                    <a href="plant.php?id=<?php echo (int)$plant['id']; ?>" class="btn-outline btn-small">View</a>
                                    <?php if ((int)$plant['stock'] > 0) { ?>
                                    <button type="button" class="btn-primary btn-small" onclick="addToCart('plant', <?php echo (int)$plant['id']; ?>, '<?php echo e($plant['name']); ?>', <?php echo $price; ?>, 1, '<?php echo e($plant['image_url']); ?>', <?php echo (int)$plant['stock']; ?>)">Add to Cart</button>
                                    <?php } else { ?>
                                    <span class="badge" style="background-color:#FF9500;color:white;">Out of Stock</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include 'includes/footer.php'; ?>
