<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/helpers.php';

$workshops_stmt = $pdo->query('SELECT * FROM workshops WHERE is_active = 1 ORDER BY event_date ASC');
$workshops = $workshops_stmt->fetchAll();

$pageTitle = 'Workshops & Events - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
?>
<main>
    <section class="hero" style="padding: var(--spacing-xl) var(--spacing-lg);">
        <div class="hero-content">
            <h1>Workshops & Events</h1>
            <p class="hero-subtitle">Learn from experts and connect with fellow plant enthusiasts.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Upcoming Workshops</h2>
                <p class="section-subtitle">Join our interactive workshops and expand your gardening knowledge.</p>
            </div>

            <div class="row">
                <?php if (count($workshops) === 0) { ?>
                <div class="col-12"><p class="text-muted">No workshops scheduled at the moment.</p></div>
                <?php } ?>
                <?php foreach ($workshops as $ws) {
                  $price = number_format((float)$ws['price'], 2, '.', '');
                  $date_label = date('M j, Y', strtotime($ws['event_date']));
                  $time_label = date('g:i A', strtotime($ws['event_time']));
                ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div style="background-color: var(--primary-color); color: white; padding: var(--spacing-md); border-radius: var(--border-radius); margin-bottom: var(--spacing-md); text-align: center;">
                            <p style="font-size: 0.9rem; margin: 0; color: rgba(255,255,255,0.9);"><?php echo e($date_label); ?> • <?php echo e($time_label); ?></p>
                            <h4 style="color: white; margin: 0;"><?php echo e($ws['difficulty']); ?></h4>
                        </div>
                        <h3 class="card-title"><?php echo e($ws['title']); ?></h3>
                        <p class="card-text"><?php echo e($ws['description']); ?></p>
                        <p><span class="badge"><?php echo e($ws['difficulty']); ?></span></p>
                        <p class="text-muted">Duration: <?php echo e($ws['duration_hours']); ?> hours | Spots: <?php echo (int)$ws['spots_available']; ?> / <?php echo (int)$ws['capacity']; ?></p>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:var(--spacing-md);">
                        <a href="workshop.php?id=<?php echo (int)$ws['id']; ?>" class="btn-outline btn-small">View</a>
                        <?php if ((int)$ws['spots_available'] > 0) {
                          $ws_img = !empty($ws['image_url']) ? $ws['image_url'] : '';
                        ?>
                        <button type="button" class="btn-primary btn-small" onclick="addToCart('workshop', <?php echo (int)$ws['id']; ?>, '<?php echo e($ws['title']); ?>', <?php echo $price; ?>, 1, '<?php echo e($ws_img); ?>', <?php echo (int)$ws['spots_available']; ?>)">Register - $<?php echo e(number_format((float)$ws['price'], 2)); ?></button>
                        <?php } else { ?>
                        <span class="badge" style="background-color:#FF9500;color:white;">Fully Booked</span>
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
