<?php

require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$row = array(
  'name' => '',
  'category' => 'Indoor',
  'description' => '',
  'price' => '',
  'stock' => '',
  'image_url' => 'assets/images/plant-1.jpg',
  'is_active' => 1
);
if ($id > 0) {
  $stmt = $pdo->prepare('SELECT * FROM plants WHERE id = :id');
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $found = $stmt->fetch();
  if ($found) {
    $row = $found;
  }
}

$pageTitle = ($id ? 'Edit Plant' : 'Add Plant') . ' - Admin';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$admin_active_page = 'plants';
include '../includes/header.php';
?>
<main><section class="section"><div class="container">
<h1><?php echo $id ? 'Edit Plant' : 'Add Plant'; ?></h1>
<div class="row"><div class="col-md-3 mb-4"><?php include '../includes/admin_sidebar.php'; ?></div>
<div class="col-md-9 mb-4"><?php include '../includes/flash_messages.php'; ?>
<div class="card" style="max-width:700px;">
<form method="post" action="plant-handler.php">
<input type="hidden" name="action" value="save"><input type="hidden" name="plant_id" value="<?php echo (int) $id; ?>">
<div class="form-group"><label>Name *</label><input type="text" name="name" required value="<?php echo e($row['name']); ?>"></div>
<div class="form-group"><label>Category *</label><input type="text" name="category" required value="<?php echo e($row['category']); ?>"></div>
<div class="form-group"><label>Description</label><textarea name="description" rows="3"><?php echo e($row['description']); ?></textarea></div>
<div class="form-group"><label>Price *</label><input type="text" name="price" required value="<?php echo e($row['price']); ?>"></div>
<div class="form-group"><label>Stock *</label><input type="number" name="stock" required value="<?php echo e($row['stock']); ?>"></div>
<div class="form-group"><label>Image URL</label><input type="text" name="image_url" value="<?php echo e($row['image_url']); ?>"></div>
<label><input type="checkbox" name="is_active" value="1" <?php echo ((int) $row['is_active'] === 1) ? 'checked' : ''; ?>> Active</label><br><br>
<button type="submit" class="btn-primary">Save</button> <a href="plants.php" class="btn-outline">Cancel</a>
</form>
</div></div></div></div></section></main>
<?php include '../includes/footer.php'; ?>
