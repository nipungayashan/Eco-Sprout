<?php
require_once __DIR__ . '/../includes/customer_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$user_id = (int) $_SESSION['user_id'];

$stmt = $pdo->prepare('SELECT * FROM bookings WHERE user_id = :uid ORDER BY booking_date DESC');
$stmt->bindParam(':uid', $user_id, PDO::PARAM_INT);
$stmt->execute();
$bookings = $stmt->fetchAll();

$pageTitle = 'My Bookings - EcoSprout Nursery';
$siteRoot = '../';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$customer_active_page = 'bookings';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<div class="row">
<div class="col-md-3 mb-4"><?php include '../includes/customer_sidebar.php'; ?></div>
<div class="col-md-9">
<h1 style="margin-bottom: var(--spacing-lg);">My Bookings</h1>
<p class="text-muted">Services and workshops you book at checkout appear here.</p>
<?php if (count($bookings) === 0) { ?>
<div class="card text-center" style="padding:var(--spacing-xl);">
<p>No bookings yet.</p>
<a href="../services.php" class="btn-primary">Browse Services</a>
</div>
<?php } ?>
<?php foreach ($bookings as $b) {
  $title = $b['booking_type'] . ' #' . (int)$b['reference_id'];
  if ($b['booking_type'] === 'service') {
    $ref = $pdo->prepare('SELECT name FROM services WHERE id = :id');
    $ref->bindParam(':id', $b['reference_id'], PDO::PARAM_INT);
    $ref->execute();
    $row = $ref->fetch();
    if ($row) { $title = $row['name']; }
  }
  if ($b['booking_type'] === 'workshop') {
    $ref = $pdo->prepare('SELECT title FROM workshops WHERE id = :id');
    $ref->bindParam(':id', $b['reference_id'], PDO::PARAM_INT);
    $ref->execute();
    $row = $ref->fetch();
    if ($row) { $title = $row['title']; }
  }
?>
<div class="card mb-4">
<h4 style="color:var(--primary-color);"><?php echo e($title); ?></h4>
<p class="text-muted"><?php echo e($b['booking_number']); ?> • <?php echo e(ucfirst($b['booking_type'])); ?></p>
<p><strong>Date:</strong> <?php echo e($b['booking_date']); ?> <?php echo e(substr($b['booking_time'], 0, 5)); ?></p>
<p><strong>Status:</strong> <?php echo e($b['status']); ?></p>
<?php if (!empty($b['notes'])) { ?><p class="text-muted"><?php echo e($b['notes']); ?></p><?php } ?>
</div>
<?php } ?>
</div>
</div>
</div>
</section>
</main>
<?php include '../includes/footer.php'; ?>
