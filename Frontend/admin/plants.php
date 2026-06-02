<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

$sql = 'SELECT * FROM plants WHERE 1=1';
$params = array();
if ($search !== '') {
  $sql .= ' AND name LIKE :search';
  $params[':search'] = '%' . $search . '%';
}
if ($category !== '') {
  $sql .= ' AND category = :category';
  $params[':category'] = $category;
}
$sql .= ' ORDER BY id DESC';
$stmt = $pdo->prepare($sql);
foreach ($params as $k => $v) {
  $stmt->bindValue($k, $v);
}
$stmt->execute();
$plants = $stmt->fetchAll();
$categories = $pdo->query('SELECT DISTINCT category FROM plants ORDER BY category')->fetchAll(PDO::FETCH_COLUMN);

$pageTitle = 'Admin - Manage Plants';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$admin_active_page = 'plants';
include '../includes/header.php';
?>
<main><section class="section"><div class="container">
<h1 style="margin-bottom:var(--spacing-lg);">Manage Plants (Admin)</h1>
<div class="row">
<div class="col-md-3 mb-4"><?php include '../includes/admin_sidebar.php'; ?></div>
<div class="col-md-9 mb-4">
<?php include '../includes/flash_messages.php'; ?>
<div style="display:flex;justify-content:space-between;gap:var(--spacing-md);flex-wrap:wrap;margin-bottom:var(--spacing-lg);">
<form method="get" style="display:flex;gap:var(--spacing-md);flex:1;min-width:250px;">
<input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Search plants..." style="flex:1;padding:var(--spacing-sm);">
<select name="category" style="padding:var(--spacing-sm);">
<option value="">All Categories</option>
<?php foreach ($categories as $cat) { ?><option value="<?php echo e($cat); ?>" <?php echo ($category === $cat) ? 'selected' : ''; ?>><?php echo e($cat); ?></option><?php } ?>
</select>
<button type="submit" class="btn-outline">Filter</button>
</form>
<a href="plant-form.php" class="btn-primary">+ Add Plant</a>
</div>
<div class="card"><div style="overflow-x:auto;"><table style="width:100%;font-size:.95rem;">
<thead><tr style="border-bottom:2px solid var(--light-gray);"><th style="padding:var(--spacing-md);text-align:left;">ID</th><th style="padding:var(--spacing-md);text-align:left;">Name</th><th style="padding:var(--spacing-md);text-align:left;">Category</th><th style="padding:var(--spacing-md);text-align:center;">Price</th><th style="padding:var(--spacing-md);text-align:center;">Stock</th><th style="padding:var(--spacing-md);text-align:center;">Actions</th></tr></thead>
<tbody>
<?php if (count($plants) === 0) { ?><tr><td colspan="6" style="padding:var(--spacing-md);text-align:center;">No plants found.</td></tr><?php } ?>
<?php foreach ($plants as $plant) { ?>
<tr style="border-bottom:1px solid var(--light-gray);">
<td style="padding:var(--spacing-md);"><?php echo (int) $plant['id']; ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($plant['name']); ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($plant['category']); ?></td>
<td style="padding:var(--spacing-md);text-align:center;">$<?php echo e(number_format((float) $plant['price'], 2)); ?></td>
<td style="padding:var(--spacing-md);text-align:center;"><?php echo (int) $plant['stock']; ?></td>
<td style="padding:var(--spacing-md);text-align:center;">
<a href="plant-form.php?id=<?php echo (int) $plant['id']; ?>" class="btn-outline btn-small" style="margin-right:4px;">Edit</a>
<form method="post" action="plant-handler.php" style="display:inline;" onsubmit="return confirm('Delete this plant?');">
<input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo (int) $plant['id']; ?>">
<button type="submit" class="btn-outline btn-small" style="color:#d32f2f;">Delete</button>
</form>
</td></tr>
<?php } ?>
</tbody></table></div></div>
</div></div></div></section></main>
<?php include '../includes/footer.php'; ?>
