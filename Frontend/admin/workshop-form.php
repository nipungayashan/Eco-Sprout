<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$row = array('title'=>'','description'=>'','event_date'=>'','event_time'=>'10:00:00','duration_hours'=>'2.0','difficulty'=>'Beginner','capacity'=>'20','spots_available'=>'20','price'=>'','is_active'=>1);
if ($id > 0) { $s = $pdo->prepare('SELECT * FROM workshops WHERE id=:id'); $s->bindParam(':id',$id,PDO::PARAM_INT); $s->execute(); $f = $s->fetch(); if ($f) { $row = $f; } }
$pageTitle = ($id ? 'Edit Workshop' : 'Add Workshop') . ' - Admin'; $cssPath='../assets/css/style.css'; $jsPath='../assets/js/main.js'; $admin_active_page='workshops'; include '../includes/header.php';
?>
<main><section class="section"><div class="container"><h1><?php echo $id ? 'Edit Workshop' : 'Add Workshop'; ?></h1><div class="row"><div class="col-md-3 mb-4"><?php include '../includes/admin_sidebar.php'; ?></div><div class="col-md-9 mb-4"><?php include '../includes/flash_messages.php'; ?>
<div class="card" style="max-width:700px;"><form method="post" action="workshop-handler.php"><input type="hidden" name="action" value="save"><input type="hidden" name="workshop_id" value="<?php echo (int)$id; ?>">
<div class="form-group"><label>Title *</label><input type="text" name="title" required value="<?php echo e($row['title']); ?>"></div>
<div class="form-group"><label>Description</label><textarea name="description" rows="3"><?php echo e($row['description']); ?></textarea></div>
<div class="form-group"><label>Date *</label><input type="date" name="event_date" required value="<?php echo e($row['event_date']); ?>"></div>
<div class="form-group"><label>Time</label><input type="time" name="event_time" value="<?php echo e(substr($row['event_time'],0,5)); ?>"></div>
<div class="form-group"><label>Duration (hours)</label><input type="text" name="duration_hours" value="<?php echo e($row['duration_hours']); ?>"></div>
<div class="form-group"><label>Difficulty</label><input type="text" name="difficulty" value="<?php echo e($row['difficulty']); ?>"></div>
<div class="form-group"><label>Capacity</label><input type="number" name="capacity" value="<?php echo e($row['capacity']); ?>"></div>
<div class="form-group"><label>Spots Available</label><input type="number" name="spots_available" value="<?php echo e($row['spots_available']); ?>"></div>
<div class="form-group"><label>Price *</label><input type="text" name="price" required value="<?php echo e($row['price']); ?>"></div>
<label><input type="checkbox" name="is_active" value="1" <?php echo ((int)$row['is_active']===1)?'checked':''; ?>> Active</label><br><br>
<button type="submit" class="btn-primary">Save</button> <a href="workshops.php" class="btn-outline">Cancel</a>
</form></div></div></div></div></section></main>
<?php include '../includes/footer.php'; ?>
