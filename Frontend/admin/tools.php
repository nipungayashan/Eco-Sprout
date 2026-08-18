<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sql = 'SELECT * FROM tools WHERE 1=1';
$params = array();
if ($search !== '') { $sql .= ' AND name LIKE :search'; $params[':search'] = '%' . $search . '%'; }
$sql .= ' ORDER BY id DESC';
$stmt = $pdo->prepare($sql);
foreach ($params as $k => $v) { $stmt->bindValue($k, $v); }
$stmt->execute();
$rows = $stmt->fetchAll();
$pageTitle = 'Admin - Manage Tools';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$admin_active_page = 'tools';
include '../includes/header.php';
?>
<main><section class="section"><div class="container"><h1 style="margin-bottom:var(--spacing-lg);">Manage Tools (Admin)</h1>
<div class="row"><div class="col-md-3 mb-4"><?php include '../includes/admin_sidebar.php'; ?></div><div class="col-md-9 mb-4">
<?php include '../includes/flash_messages.php'; ?>
<div style="display:flex;justify-content:space-between;gap:var(--spacing-md);margin-bottom:var(--spacing-lg);"><form method="get" style="flex:1;display:flex;gap:var(--spacing-md);"><input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Search tools..." style="flex:1;padding:var(--spacing-sm);"><button class="btn-outline" type="submit">Search</button></form><a href="tool-form.php" class="btn-primary">+ Add Tool</a></div>
<div class="card"><div style="overflow-x:auto;"><table style="width:100%;font-size:.95rem;"><thead><tr style="border-bottom:2px solid var(--light-gray);"><th style="padding:var(--spacing-md);">ID</th><th style="padding:var(--spacing-md);text-align:left;">Name</th><th style="padding:var(--spacing-md);text-align:center;">Price</th><th style="padding:var(--spacing-md);text-align:center;">Stock</th><th style="padding:var(--spacing-md);text-align:center;">Actions</th></tr></thead><tbody>
<?php if (count($rows) === 0) { ?><tr><td colspan="5" style="padding:var(--spacing-md);text-align:center;">No tools found.</td></tr><?php } ?>
<?php foreach ($rows as $r) { ?><tr style="border-bottom:1px solid var(--light-gray);"><td style="padding:var(--spacing-md);"><?php echo (int)$r['id']; ?></td><td style="padding:var(--spacing-md);text-align:left;"><?php echo e($r['name']); ?></td><td style="padding:var(--spacing-md);text-align:center;">LKR<?php echo e(number_format((float)$r['price'],2)); ?></td><td style="padding:var(--spacing-md);text-align:center;"><?php echo (int)$r['stock']; ?></td><td style="padding:var(--spacing-md);text-align:center;"><a href="tool-form.php?id=<?php echo (int)$r['id']; ?>" class="btn-outline btn-small" style="margin-right:4px;">Edit</a>
<form method="post" action="tool-handler.php" style="display:inline;" onsubmit="return confirm('Delete this tool?');"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo (int)$r['id']; ?>"><button class="btn-outline btn-small" style="color:#d32f2f;" type="submit">Delete</button></form></td></tr><?php } ?>
</tbody></table></div></div>
</div></div></div></section></main>
<?php include '../includes/footer.php'; ?>
