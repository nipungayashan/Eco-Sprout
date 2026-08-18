<?php
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sql = 'SELECT * FROM services WHERE 1=1';
$params = array();
if ($search !== '') {
  $sql .= ' AND name LIKE :search';
  $params[':search'] = '%' . $search . '%';
}
$sql .= ' ORDER BY id DESC';
$stmt = $pdo->prepare($sql);
foreach ($params as $key => $val) {
  $stmt->bindValue($key, $val);
}
$stmt->execute();
$services = $stmt->fetchAll();

$pageTitle = 'Manage Services - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$staff_active_page = 'services';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<h1 style="margin-bottom: var(--spacing-lg);">Manage Services</h1>
<div class="row">
<div class="col-md-3 mb-4"><?php include '../includes/staff_sidebar.php'; ?></div>
<div class="col-md-9 mb-4">
<?php include '../includes/flash_messages.php'; ?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--spacing-lg);flex-wrap:wrap;gap:var(--spacing-md);">
<form method="get" style="display:flex;gap:var(--spacing-md);flex:1;min-width:250px;">
<input type="text" name="search" placeholder="Search services..." value="<?php echo e($search); ?>" style="flex:1;padding:var(--spacing-sm);">
<button type="submit" class="btn-outline">Search</button>
</form>
<a href="service-form.php" class="btn-primary">+ Add Service</a>
</div>
<div class="card">
<div style="overflow-x:auto;">
<table style="width:100%;font-size:0.95rem;">
<thead>
<tr style="border-bottom:2px solid var(--light-gray);">
<th style="padding:var(--spacing-md);text-align:left;">ID</th>
<th style="padding:var(--spacing-md);text-align:left;">Name</th>
<th style="padding:var(--spacing-md);text-align:center;">Price</th>
<th style="padding:var(--spacing-md);text-align:left;">Note</th>
<th style="padding:var(--spacing-md);text-align:center;">Active</th>
<th style="padding:var(--spacing-md);text-align:center;">Actions</th>
</tr>
</thead>
<tbody>
<?php if (count($services) === 0) { ?>
<tr><td colspan="6" style="padding:var(--spacing-md);text-align:center;">No services found.</td></tr>
<?php } ?>
<?php foreach ($services as $service) { ?>
<tr style="border-bottom:1px solid var(--light-gray);">
<td style="padding:var(--spacing-md);"><?php echo (int)$service['id']; ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($service['icon_emoji'] . ' ' . $service['name']); ?></td>
<td style="padding:var(--spacing-md);text-align:center;">LKR<?php echo e(number_format((float)$service['price'], 2)); ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($service['price_note']); ?></td>
<td style="padding:var(--spacing-md);text-align:center;"><?php echo ((int)$service['is_active']===1)?'Yes':'No'; ?></td>
<td style="padding:var(--spacing-md);text-align:center;">
<a href="service-form.php?id=<?php echo (int)$service['id']; ?>" class="btn-outline btn-small" style="margin-right:4px;">Edit</a>
<form method="post" action="service-handler.php" style="display:inline;" onsubmit="return confirm('Delete this service?');">
<input type="hidden" name="action" value="delete">
<input type="hidden" name="id" value="<?php echo (int)$service['id']; ?>">
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
