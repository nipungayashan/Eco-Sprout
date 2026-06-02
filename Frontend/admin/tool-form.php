<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$row = array('name' => '', 'description' => '', 'price' => '', 'stock' => '', 'image_url' => 'assets/images/tool-1.jpg', 'is_active' => 1);
if ($id > 0) { $s = $pdo->prepare('SELECT * FROM tools WHERE id=:id'); $s->bindParam(':id', $id, PDO::PARAM_INT); $s->execute(); $f = $s->fetch(); if ($f) { $row = $f; } }
$pageTitle = ($id ? 'Edit Tool' : 'Add Tool') . ' - Admin';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$admin_active_page = 'tools';
include '../includes/header.php';
?>
<main><section class="section"><div class="container"><h1><?php echo $id ? 'Edit Tool' : 'Add Tool'; ?></h1>
<div class="row"><div class="col-md-3 mb-4"><?php include '../includes/admin_sidebar.php'; ?></div><div class="col-md-9 mb-4"><?php include '../includes/flash_messages.php'; ?>
<div class="card" style="max-width:700px;"><form method="post" action="tool-handler.php"><input type="hidden" name="action" value="save"><input type="hidden" name="tool_id" value="<?php echo (int)$id; ?>">
<div class="form-group"><label>Name *</label><input type="text" name="name" required value="<?php echo e($row['name']); ?>"></div>
<div class="form-group"><label>Description</label><textarea name="description" rows="3"><?php echo e($row['description']); ?></textarea></div>
<div class="form-group"><label>Price *</label><input type="text" name="price" required value="<?php echo e($row['price']); ?>"></div>
<div class="form-group"><label>Stock *</label><input type="number" name="stock" required value="<?php echo e($row['stock']); ?>"></div>
<div class="form-group"><label>Image URL</label><input type="text" name="image_url" value="<?php echo e($row['image_url']); ?>"></div>
<label><input type="checkbox" name="is_active" value="1" <?php echo ((int)$row['is_active']===1)?'checked':''; ?>> Active</label><br><br>
<button class="btn-primary" type="submit">Save</button> <a class="btn-outline" href="tools.php">Cancel</a>
</form></div></div></div></div></section></main>
<?php include '../includes/footer.php'; ?>
