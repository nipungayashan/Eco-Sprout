<?php
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$row = array('name'=>'','description'=>'','price'=>'','stock'=>'','image_url'=>'assets/images/tool-1.jpg','is_active'=>1);
if ($id > 0) {
  $stmt = $pdo->prepare('SELECT * FROM tools WHERE id = :id');
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $found = $stmt->fetch();
  if ($found) { $row = $found; }
}
$pageTitle = ($id ? 'Edit Tool' : 'Add Tool') . ' - EcoSprout';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
include '../includes/header.php';
?>
<main><section class="section"><div class="container">
<h1><?php echo $id ? 'Edit Tool' : 'Add Tool'; ?></h1>
<div class="card" style="max-width:600px;">
<form method="post" action="tool-handler.php">
<input type="hidden" name="action" value="save">
<input type="hidden" name="tool_id" value="<?php echo (int)$id; ?>">
<div class="form-group"><label>Name *</label><input type="text" name="name" required value="<?php echo e($row['name']); ?>"></div>
<div class="form-group"><label>Description</label><textarea name="description" rows="3"><?php echo e($row['description']); ?></textarea></div>
<div class="form-group"><label>Price *</label><input type="text" name="price" required value="<?php echo e($row['price']); ?>"></div>
<div class="form-group"><label>Stock *</label><input type="number" name="stock" required value="<?php echo e($row['stock']); ?>"></div>
<div class="form-group"><label>Image URL</label><input type="text" name="image_url" value="<?php echo e($row['image_url']); ?>"></div>
<label><input type="checkbox" name="is_active" value="1" <?php echo ((int)$row['is_active']===1)?'checked':''; ?>> Active</label><br><br>
<button type="submit" class="btn-primary">Save</button> <a href="tools.php" class="btn-outline">Cancel</a>
</form></div></div></section></main>
<?php include '../includes/footer.php'; ?>
