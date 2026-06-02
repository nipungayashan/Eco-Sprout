<?php
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$row = array('name'=>'','category'=>'Indoor','description'=>'','price'=>'','stock'=>'','difficulty'=>'Beginner','image_url'=>'assets/images/plant-1.jpg','is_active'=>1);

if ($id > 0) {
  $stmt = $pdo->prepare('SELECT * FROM plants WHERE id = :id');
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $found = $stmt->fetch();
  if ($found) { $row = $found; }
}

$pageTitle = ($id ? 'Edit Plant' : 'Add Plant') . ' - EcoSprout';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
include '../includes/header.php';
?>
<main><section class="section"><div class="container">
<h1><?php echo $id ? 'Edit Plant' : 'Add Plant'; ?></h1>
<?php include '../includes/flash_messages.php'; ?>
<div class="card" style="max-width:600px;">
<form method="post" action="plant-handler.php">
<input type="hidden" name="action" value="save">
<input type="hidden" name="plant_id" value="<?php echo (int)$id; ?>">
<div class="form-group"><label>Name *</label><input type="text" name="name" required value="<?php echo e($row['name']); ?>"></div>
<div class="form-group"><label>Category *</label><input type="text" name="category" required value="<?php echo e($row['category']); ?>"></div>
<div class="form-group"><label>Description</label><textarea name="description" rows="3"><?php echo e($row['description']); ?></textarea></div>
<div class="form-group"><label>Price *</label><input type="text" name="price" required value="<?php echo e($row['price']); ?>"></div>
<div class="form-group"><label>Stock *</label><input type="number" name="stock" required value="<?php echo e($row['stock']); ?>"></div>
<div class="form-group"><label>Difficulty</label><input type="text" name="difficulty" value="<?php echo e($row['difficulty']); ?>"></div>
<div class="form-group"><label>Image URL 1</label><input type="text" name="image_url" value="<?php echo e(isset($row['image_url']) ? $row['image_url'] : ''); ?>"></div>
<div class="form-group"><label>Image URL 2 (optional)</label><input type="text" name="image_url_2" value="<?php echo e(isset($row['image_url_2']) ? $row['image_url_2'] : ''); ?>"></div>
<div class="form-group"><label>Image URL 3 (optional)</label><input type="text" name="image_url_3" value="<?php echo e(isset($row['image_url_3']) ? $row['image_url_3'] : ''); ?>"></div>
<label><input type="checkbox" name="is_active" value="1" <?php echo ((int)$row['is_active']===1)?'checked':''; ?>> Active</label><br><br>
<button type="submit" class="btn-primary">Save</button>
<a href="plants.php" class="btn-outline">Cancel</a>
</form></div></div></section></main>
<?php include '../includes/footer.php'; ?>
