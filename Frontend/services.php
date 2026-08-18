<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/helpers.php';

$services_stmt = $pdo->query('SELECT * FROM services WHERE is_active = 1 ORDER BY name ASC');
$services = $services_stmt->fetchAll();

$pageTitle = 'Services - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
?>
<main>
    <section class="hero" style="padding: var(--spacing-xl) var(--spacing-lg);">
        <div class="hero-content">
            <h1>Our Services</h1>
            <p class="hero-subtitle">Professional gardening services to enhance your green space.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <?php if (count($services) === 0) { ?>
                <div class="col-12"><p class="text-muted">No services available at the moment.</p></div>
                <?php } ?>
                <?php foreach ($services as $service) {
                  $price = number_format((float)$service['price'], 2, '.', '');
                  $price_display = 'LKR' . number_format((float)$service['price'], 2);
                  if (!empty($service['price_note'])) {
                    $price_display .= ' / ' . $service['price_note'];
                  }
                  $svc_img = !empty($service['image_url']) ? $service['image_url'] : '';
                ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <a href="service.php?id=<?php echo (int)$service['id']; ?>">
                        <?php if ($svc_img !== '') { ?>
                        <img src="<?php echo e($svc_img); ?>" alt="<?php echo e($service['name']); ?>" class="card-image">
                        <?php } else { ?>
                        <div style="font-size: 3rem; margin-bottom: var(--spacing-md);"><?php echo e($service['icon_emoji']); ?></div>
                        <?php } ?>
                        </a>
                        <h3 class="card-title"><a href="service.php?id=<?php echo (int)$service['id']; ?>" style="color:inherit;text-decoration:none;"><?php echo e($service['name']); ?></a></h3>
                        <p class="card-text"><?php echo e($service['description']); ?></p>
                        <p class="card-price"><?php echo e($price_display); ?></p>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;">
                        <a href="service.php?id=<?php echo (int)$service['id']; ?>" class="btn-outline btn-small">View</a>
                        <button type="button" class="btn-primary btn-small" onclick="addToCart('service', <?php echo (int)$service['id']; ?>, '<?php echo e($service['name']); ?>', <?php echo $price; ?>, 1, '<?php echo e($svc_img); ?>', 99)">Book Service</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="section" style="background-color: #f0f0f0;">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: var(--spacing-xl);">Why Choose Our Services?</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div style="background-color: white; padding: var(--spacing-lg); border-radius: var(--border-radius);">
                        <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">✓ Expert Team</h4>
                        <p>Our team consists of certified horticulturists with years of experience.</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div style="background-color: white; padding: var(--spacing-lg); border-radius: var(--border-radius);">
                        <h4 style="color: var(--primary-color); margin-bottom: var(--spacing-md);">✓ Eco-Friendly</h4>
                        <p>We use sustainable and environmentally responsible practices.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include 'includes/footer.php'; ?>
