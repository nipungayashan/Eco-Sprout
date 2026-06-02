<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';
$q = isset($_GET['search']) ? trim($_GET['search']) : '';
$sql = 'SELECT * FROM workshops WHERE 1=1';
$p = array();
if ($q !== '') { $sql .= ' AND title LIKE :q'; $p[':q'] = '%' . $q . '%'; }
$sql .= ' ORDER BY event_date ASC';
$s = $pdo->prepare($sql); foreach ($p as $k => $v) { $s->bindValue($k, $v); } $s->execute(); $rows = $s->fetchAll();
$pageTitle = 'Admin - Manage Workshops'; $cssPath = '../assets/css/style.css'; $jsPath = '../assets/js/main.js'; $admin_active_page='workshops'; include '../includes/header.php';
?>
<main><section class="section"><div class="container"><h1 style="margin-bottom:var(--spacing-lg);">Manage Workshops (Admin)</h1><div class="row"><div class="col-md-3 mb-4"><?php include '../includes/admin_sidebar.php'; ?></div><div class="col-md-9 mb-4"><?php include '../includes/flash_messages.php'; ?>
<div style="display:flex;justify-content:space-between;gap:var(--spacing-md);margin-bottom:var(--spacing-lg);"><form method="get" style="display:flex;gap:var(--spacing-md);flex:1;"><input type="text" name="search" value="<?php echo e($q); ?>" placeholder="Search workshops..." style="flex:1;padding:var(--spacing-sm);"><button class="btn-outline" type="submit">Search</button></form><a href="workshop-form.php" class="btn-primary">+ Add Workshop</a></div>
<div class="card"><div style="overflow-x:auto;"><table style="width:100%;font-size:.95rem;"><thead><tr style="border-bottom:2px solid var(--light-gray);"><th style="padding:var(--spacing-md);">ID</th><th style="padding:var(--spacing-md);text-align:left;">Title</th><th style="padding:var(--spacing-md);text-align:left;">Date</th><th style="padding:var(--spacing-md);text-align:center;">Spots</th><th style="padding:var(--spacing-md);text-align:center;">Actions</th></tr></thead><tbody>
<?php if (count($rows) === 0) { ?><tr><td colspan="5" style="padding:var(--spacing-md);text-align:center;">No workshops found.</td></tr><?php } ?>
<?php foreach ($rows as $r) { ?><tr style="border-bottom:1px solid var(--light-gray);"><td style="padding:var(--spacing-md);"><?php echo (int)$r['id']; ?></td><td style="padding:var(--spacing-md);text-align:left;"><?php echo e($r['title']); ?></td><td style="padding:var(--spacing-md);text-align:left;"><?php echo e($r['event_date'] . ' ' . substr($r['event_time'],0,5)); ?></td><td style="padding:var(--spacing-md);text-align:center;"><?php echo (int)$r['spots_available']; ?>/<?php echo (int)$r['capacity']; ?></td><td style="padding:var(--spacing-md);text-align:center;"><a href="workshop-form.php?id=<?php echo (int)$r['id']; ?>" class="btn-outline btn-small" style="margin-right:4px;">Edit</a><form method="post" action="workshop-handler.php" style="display:inline;" onsubmit="return confirm('Delete this workshop?');"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo (int)$r['id']; ?>"><button type="submit" class="btn-outline btn-small" style="color:#d32f2f;">Delete</button></form></td></tr><?php } ?>
</tbody></table></div></div>
</div></div></div></section></main>
<?php include '../includes/footer.php'; ?>
