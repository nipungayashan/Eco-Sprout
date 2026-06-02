<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$role_filter = isset($_GET['role']) ? trim($_GET['role']) : '';

$sql = 'SELECT id, full_name, email, role, is_active, created_at FROM users WHERE 1=1';
$params = array();
if ($search !== '') {
  $sql .= ' AND (full_name LIKE :search OR email LIKE :search)';
  $params[':search'] = '%' . $search . '%';
}
if ($role_filter !== '') {
  $sql .= ' AND role = :role';
  $params[':role'] = (int) $role_filter;
}
$sql .= ' ORDER BY id DESC';
$stmt = $pdo->prepare($sql);
foreach ($params as $key => $val) {
  $stmt->bindValue($key, $val);
}
$stmt->execute();
$users = $stmt->fetchAll();

$pageTitle = 'Manage Users - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$admin_active_page = 'users';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<h1 style="margin-bottom: var(--spacing-lg);">Manage Users</h1>
<div class="row">
<div class="col-md-3 mb-4">
<?php include '../includes/admin_sidebar.php'; ?>
</div>
<div class="col-md-9 mb-4">
<?php include '../includes/flash_messages.php'; ?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--spacing-lg);flex-wrap:wrap;gap:var(--spacing-md);">
<form method="get" style="display:flex;gap:var(--spacing-md);flex:1;min-width:250px;">
<input type="text" name="search" placeholder="Search users..." value="<?php echo e($search); ?>" style="flex:1;padding:var(--spacing-sm);">
<select name="role" style="padding:var(--spacing-sm);">
<option value="">All Roles</option>
<option value="0" <?php echo ($role_filter === '0') ? 'selected' : ''; ?>>Customer</option>
<option value="1" <?php echo ($role_filter === '1') ? 'selected' : ''; ?>>Staff</option>
<option value="2" <?php echo ($role_filter === '2') ? 'selected' : ''; ?>>Admin</option>
</select>
<button type="submit" class="btn-outline">Filter</button>
</form>
<a href="user-form.php" class="btn-primary">+ Add User</a>
</div>
<div class="card">
<div style="overflow-x:auto;">
<table style="width:100%;font-size:0.95rem;">
<thead>
<tr style="border-bottom:2px solid var(--light-gray);">
<th style="padding:var(--spacing-md);text-align:left;">ID</th>
<th style="padding:var(--spacing-md);text-align:left;">Name</th>
<th style="padding:var(--spacing-md);text-align:left;">Email</th>
<th style="padding:var(--spacing-md);text-align:left;">Role</th>
<th style="padding:var(--spacing-md);text-align:center;">Status</th>
<th style="padding:var(--spacing-md);text-align:center;">Joined</th>
<th style="padding:var(--spacing-md);text-align:center;">Actions</th>
</tr>
</thead>
<tbody>
<?php if (count($users) === 0) { ?>
<tr><td colspan="7" style="padding:var(--spacing-md);text-align:center;">No users found.</td></tr>
<?php } ?>
<?php foreach ($users as $user) { ?>
<tr style="border-bottom:1px solid var(--light-gray);">
<td style="padding:var(--spacing-md);"><?php echo (int)$user['id']; ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($user['full_name']); ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($user['email']); ?></td>
<td style="padding:var(--spacing-md);"><?php echo e(role_label($user['role'])); ?></td>
<td style="padding:var(--spacing-md);text-align:center;">
<?php if ((int)$user['is_active'] === 1) { ?>
<span class="badge badge-success">Active</span>
<?php } else { ?>
<span class="badge" style="background-color:#FF9500;color:white;">Inactive</span>
<?php } ?>
</td>
<td style="padding:var(--spacing-md);text-align:center;"><?php echo e(substr($user['created_at'], 0, 10)); ?></td>
<td style="padding:var(--spacing-md);text-align:center;">
<a href="user-form.php?id=<?php echo (int)$user['id']; ?>" class="btn-outline btn-small" style="margin-right:4px;">Edit</a>
<?php if ((int)$user['id'] !== (int)$_SESSION['user_id']) { ?>
<form method="post" action="user-handler.php" style="display:inline;" onsubmit="return confirm('Delete this user?');">
<input type="hidden" name="action" value="delete">
<input type="hidden" name="id" value="<?php echo (int)$user['id']; ?>">
<button type="submit" class="btn-outline btn-small" style="color:#d32f2f;">Delete</button>
</form>
<?php } ?>
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
