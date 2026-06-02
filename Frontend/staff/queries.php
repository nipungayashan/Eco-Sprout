<?php
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';

$sql = 'SELECT * FROM customer_queries WHERE 1=1';
$params = array();
if ($status_filter !== '') {
  $sql .= ' AND status = :status';
  $params[':status'] = $status_filter;
}
$sql .= ' ORDER BY created_at DESC';
$stmt = $pdo->prepare($sql);
foreach ($params as $key => $val) {
  $stmt->bindValue($key, $val);
}
$stmt->execute();
$queries = $stmt->fetchAll();

$query_statuses = array('new', 'in_progress', 'resolved');

$pageTitle = 'Handle Queries - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$staff_active_page = 'queries';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<h1 style="margin-bottom: var(--spacing-lg);">Handle Customer Queries</h1>
<div class="row">
<div class="col-md-3 mb-4"><?php include '../includes/staff_sidebar.php'; ?></div>
<div class="col-md-9 mb-4">
<?php include '../includes/flash_messages.php'; ?>
<form method="get" style="margin-bottom:var(--spacing-lg);">
<select name="status" style="min-width:200px;padding:var(--spacing-sm);" onchange="this.form.submit()">
<option value="">All Queries</option>
<?php foreach ($query_statuses as $st) { ?>
<option value="<?php echo e($st); ?>" <?php echo ($status_filter === $st) ? 'selected' : ''; ?>><?php echo e(query_status_label($st)); ?></option>
<?php } ?>
</select>
</form>

<?php if (count($queries) === 0) { ?>
<div class="card"><p style="padding:var(--spacing-md);margin:0;">No queries found.</p></div>
<?php } ?>

<?php foreach ($queries as $q) {
  $badge_class = ($q['status'] === 'resolved') ? 'badge' : 'badge badge-success';
  $badge_style = ($q['status'] === 'resolved') ? 'background-color:#4CAF50;color:white;' : (($q['status'] === 'in_progress') ? 'background-color:#FFC107;color:#333;' : '');
?>
<div class="card" style="margin-bottom:var(--spacing-lg);">
<div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:var(--spacing-md);padding-bottom:var(--spacing-md);border-bottom:1px solid var(--light-gray);">
<div style="flex:1;">
<h3 style="color:var(--primary-color);margin-top:0;margin-bottom:var(--spacing-sm);"><?php echo e($q['subject']); ?></h3>
<p class="text-muted" style="margin:var(--spacing-sm) 0;">From: <?php echo e($q['full_name']); ?> (<?php echo e($q['email']); ?>)</p>
<p class="text-muted" style="margin:var(--spacing-sm) 0;">Received: <?php echo e($q['created_at']); ?></p>
<p style="margin:var(--spacing-md) 0;"><?php echo e($q['message']); ?></p>
<?php if (!empty($q['staff_reply'])) { ?>
<div style="background-color:#f9f6f0;padding:var(--spacing-md);border-radius:var(--border-radius);margin-top:var(--spacing-md);">
<p style="font-weight:600;margin-top:0;">Reply:</p>
<p style="margin:0;"><?php echo e($q['staff_reply']); ?></p>
</div>
<?php } ?>
</div>
<span class="<?php echo $badge_class; ?>" style="<?php echo $badge_style; ?>"><?php echo e(query_status_label($q['status'])); ?></span>
</div>
<form method="post" action="query-handler.php" style="margin-bottom:var(--spacing-md);">
<input type="hidden" name="action" value="reply">
<input type="hidden" name="id" value="<?php echo (int)$q['id']; ?>">
<div class="form-group">
<label>Staff reply</label>
<textarea name="staff_reply" rows="3" style="width:100%;"><?php echo e($q['staff_reply']); ?></textarea>
</div>
<div style="display:flex;gap:var(--spacing-sm);flex-wrap:wrap;align-items:center;">
<select name="status" style="padding:var(--spacing-sm);">
<?php foreach ($query_statuses as $st) { ?>
<option value="<?php echo e($st); ?>" <?php echo ($q['status'] === $st) ? 'selected' : ''; ?>><?php echo e(query_status_label($st)); ?></option>
<?php } ?>
</select>
<button type="submit" class="btn-outline btn-small">Save Reply</button>
</div>
</form>
<div style="display:flex;gap:var(--spacing-sm);">
<?php if ($q['status'] !== 'resolved') { ?>
<form method="post" action="query-handler.php">
<input type="hidden" name="action" value="resolve">
<input type="hidden" name="id" value="<?php echo (int)$q['id']; ?>">
<button type="submit" class="btn-outline btn-small" style="color:#4CAF50;">Mark Resolved</button>
</form>
<?php } ?>
<form method="post" action="query-handler.php" onsubmit="return confirm('Delete this query?');">
<input type="hidden" name="action" value="delete">
<input type="hidden" name="id" value="<?php echo (int)$q['id']; ?>">
<button type="submit" class="btn-outline btn-small" style="color:#d32f2f;">Delete</button>
</form>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
</section>
</main>
<?php include '../includes/footer.php'; ?>
