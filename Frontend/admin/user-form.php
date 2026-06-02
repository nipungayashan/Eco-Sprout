<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$row = array('full_name'=>'','email'=>'','phone'=>'','role'=>0,'is_active'=>1);

if ($id > 0) {
  $stmt = $pdo->prepare('SELECT id, full_name, email, phone, role, is_active FROM users WHERE id = :id');
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $found = $stmt->fetch();
  if ($found) { $row = $found; }
}

$pageTitle = ($id ? 'Edit User' : 'Add User') . ' - EcoSprout';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<h1><?php echo $id ? 'Edit User' : 'Add User'; ?></h1>
<div class="card" style="max-width:600px;">
<form method="post" action="user-handler.php">
<input type="hidden" name="action" value="save">
<input type="hidden" name="user_id" value="<?php echo (int)$id; ?>">
<div class="form-group"><label>Full name *</label><input type="text" name="full_name" required value="<?php echo e($row['full_name']); ?>"></div>
<div class="form-group"><label>Email *</label><input type="email" name="email" required value="<?php echo e($row['email']); ?>"></div>
<div class="form-group"><label>Phone</label><input type="text" name="phone" value="<?php echo e($row['phone']); ?>"></div>
<div class="form-group"><label>Role *</label>
<select name="role" required>
<option value="0" <?php echo ((int)$row['role']===0)?'selected':''; ?>>Customer</option>
<option value="1" <?php echo ((int)$row['role']===1)?'selected':''; ?>>Staff</option>
<option value="2" <?php echo ((int)$row['role']===2)?'selected':''; ?>>Admin</option>
</select>
</div>
<div class="form-group"><label>Password <?php echo $id ? '(leave blank to keep current)' : '*'; ?></label><input type="text" name="password" <?php echo $id ? '' : 'required'; ?>></div>
<label><input type="checkbox" name="is_active" value="1" <?php echo ((int)$row['is_active']===1)?'checked':''; ?>> Active</label><br><br>
<button type="submit" class="btn-primary">Save</button>
<a href="users.php" class="btn-outline">Cancel</a>
</form>
</div>
</div>
</section>
</main>
<?php include '../includes/footer.php'; ?>
