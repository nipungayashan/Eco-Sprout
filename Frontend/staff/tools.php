<?php
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sql = 'SELECT * FROM tools WHERE 1=1';
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
$tools = $stmt->fetchAll();

$pageTitle = 'Manage Tools - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$staff_active_page = 'tools';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<h1 style="margin-bottom: var(--spacing-lg);">Manage Tools</h1>
<div class="row">
<div class="col-md-3 mb-4"><?php include '../includes/staff_sidebar.php'; ?></div>
<div class="col-md-9 mb-4">
<?php include '../includes/flash_messages.php'; ?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--spacing-lg);flex-wrap:wrap;gap:var(--spacing-md);">
<form method="get" style="display:flex;gap:var(--spacing-md);flex:1;min-width:250px;">
<input type="text" name="search" placeholder="Search tools..." value="<?php echo e($search); ?>" style="flex:1;padding:var(--spacing-sm);">
<button type="submit" class="btn-outline">Search</button>
</form>
<a href="tool-form.php" class="btn-primary">+ Add Tool</a>
</div>
<div class="card">
<div style="overflow-x:auto;">
<table style="width:100%;font-size:0.95rem;">
<thead>
<tr style="border-bottom:2px solid var(--light-gray);">
<th style="padding:var(--spacing-md);text-align:left;">ID</th>
<th style="padding:var(--spacing-md);text-align:left;">Name</th>
<th style="padding:var(--spacing-md);text-align:center;">Price</th>
<th style="padding:var(--spacing-md);text-align:center;">Stock</th>
<th style="padding:var(--spacing-md);text-align:center;">Active</th>
<th style="padding:var(--spacing-md);text-align:center;">Actions</th>
</tr>
</thead>
<tbody>
<?php if (count($tools) === 0) { ?>
<tr><td colspan="6" style="padding:var(--spacing-md);text-align:center;">No tools found.</td></tr>
<?php } ?>
<?php foreach ($tools as $tool) { ?>
<tr style="border-bottom:1px solid var(--light-gray);">
<td style="padding:var(--spacing-md);"><?php echo (int)$tool['id']; ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($tool['name']); ?></td>
<td style="padding:var(--spacing-md);text-align:center;">$<?php echo e(number_format((float)$tool['price'], 2)); ?></td>
<td style="padding:var(--spacing-md);text-align:center;"><?php echo (int)$tool['stock']; ?></td>
<td style="padding:var(--spacing-md);text-align:center;"><?php echo ((int)$tool['is_active']===1)?'Yes':'No'; ?></td>
<td style="padding:var(--spacing-md);text-align:center;">
<a href="tool-form.php?id=<?php echo (int)$tool['id']; ?>" class="btn-outline btn-small" style="margin-right:4px;">Edit</a>
<form method="post" action="tool-handler.php" style="display:inline;" onsubmit="return confirm('Delete this tool?');">
<input type="hidden" name="action" value="delete">
<input type="hidden" name="id" value="<?php echo (int)$tool['id']; ?>">
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
