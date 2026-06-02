<?php
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sql = 'SELECT * FROM workshops WHERE 1=1';
$params = array();
if ($search !== '') {
  $sql .= ' AND title LIKE :search';
  $params[':search'] = '%' . $search . '%';
}
$sql .= ' ORDER BY event_date ASC';
$stmt = $pdo->prepare($sql);
foreach ($params as $key => $val) {
  $stmt->bindValue($key, $val);
}
$stmt->execute();
$workshops = $stmt->fetchAll();

$pageTitle = 'Manage Workshops - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$staff_active_page = 'workshops';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<h1 style="margin-bottom: var(--spacing-lg);">Manage Workshops</h1>
<div class="row">
<div class="col-md-3 mb-4"><?php include '../includes/staff_sidebar.php'; ?></div>
<div class="col-md-9 mb-4">
<?php include '../includes/flash_messages.php'; ?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--spacing-lg);flex-wrap:wrap;gap:var(--spacing-md);">
<form method="get" style="display:flex;gap:var(--spacing-md);flex:1;min-width:250px;">
<input type="text" name="search" placeholder="Search workshops..." value="<?php echo e($search); ?>" style="flex:1;padding:var(--spacing-sm);">
<button type="submit" class="btn-outline">Search</button>
</form>
<a href="workshop-form.php" class="btn-primary">+ Add Workshop</a>
</div>
<div class="card">
<div style="overflow-x:auto;">
<table style="width:100%;font-size:0.95rem;">
<thead>
<tr style="border-bottom:2px solid var(--light-gray);">
<th style="padding:var(--spacing-md);text-align:left;">ID</th>
<th style="padding:var(--spacing-md);text-align:left;">Title</th>
<th style="padding:var(--spacing-md);text-align:left;">Date</th>
<th style="padding:var(--spacing-md);text-align:center;">Spots</th>
<th style="padding:var(--spacing-md);text-align:center;">Price</th>
<th style="padding:var(--spacing-md);text-align:center;">Actions</th>
</tr>
</thead>
<tbody>
<?php if (count($workshops) === 0) { ?>
<tr><td colspan="6" style="padding:var(--spacing-md);text-align:center;">No workshops found.</td></tr>
<?php } ?>
<?php foreach ($workshops as $ws) { ?>
<tr style="border-bottom:1px solid var(--light-gray);">
<td style="padding:var(--spacing-md);"><?php echo (int)$ws['id']; ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($ws['title']); ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($ws['event_date'] . ' ' . substr($ws['event_time'], 0, 5)); ?></td>
<td style="padding:var(--spacing-md);text-align:center;"><?php echo (int)$ws['spots_available']; ?> / <?php echo (int)$ws['capacity']; ?></td>
<td style="padding:var(--spacing-md);text-align:center;">$<?php echo e(number_format((float)$ws['price'], 2)); ?></td>
<td style="padding:var(--spacing-md);text-align:center;">
<a href="workshop-form.php?id=<?php echo (int)$ws['id']; ?>" class="btn-outline btn-small" style="margin-right:4px;">Edit</a>
<form method="post" action="workshop-handler.php" style="display:inline;" onsubmit="return confirm('Delete this workshop?');">
<input type="hidden" name="action" value="delete">
<input type="hidden" name="id" value="<?php echo (int)$ws['id']; ?>">
<button type="submit" class="btn-outline btn-small" style="color:#d32f2f;">Delete</button>
</form>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</section>
</main>
<?php include '../includes/footer.php'; ?>
