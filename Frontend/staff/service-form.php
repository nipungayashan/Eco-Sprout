<?php
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$row = array('name'=>'','description'=>'','price'=>'','price_note'=>'','icon_emoji'=>'🌿','is_active'=>1);
if ($id > 0) {
  $stmt = $pdo->prepare('SELECT * FROM services WHERE id = :id');
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $found = $stmt->fetch();
  if ($found) { $row = $found; }
}
$pageTitle = ($id ? 'Edit Service' : 'Add Service') . ' - EcoSprout';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
include '../includes/header.php';
?>
<main><section class="section"><div class="container">
<h1><?php echo $id ? 'Edit Service' : 'Add Service'; ?></h1>
<div class="card" style="max-width:600px;">
<form method="post" action="service-handler.php">
<input type="hidden" name="action" value="save">
<input type="hidden" name="service_id" value="<?php echo (int)$id; ?>">
<div class="form-group"><label>Name *</label><input type="text" name="name" required value="<?php echo e($row['name']); ?>"></div>
<div class="form-group"><label>Description</label><textarea name="description" rows="3"><?php echo e($row['description']); ?></textarea></div>
<div class="form-group"><label>Price *</label><input type="text" name="price" required value="<?php echo e($row['price']); ?>"></div>
<div class="form-group"><label>Price note (e.g. "per month")</label><input type="text" name="price_note" value="<?php echo e($row['price_note']); ?>"></div>
<div class="form-group"><label>Icon emoji</label><input type="text" name="icon_emoji" value="<?php echo e($row['icon_emoji']); ?>"></div>
<label><input type="checkbox" name="is_active" value="1" <?php echo ((int)$row['is_active']===1)?'checked':''; ?>> Active</label><br><br>
<button type="submit" class="btn-primary">Save</button> <a href="services.php" class="btn-outline">Cancel</a>
</form></div></div></section></main>
<?php include '../includes/footer.php'; ?>
