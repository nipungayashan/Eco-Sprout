<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';
$status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';
$sql = 'SELECT * FROM customer_queries WHERE 1=1';
$p = array();
if ($status_filter !== '') { $sql .= ' AND status=:status'; $p[':status'] = $status_filter; }
$sql .= ' ORDER BY created_at DESC';
$s = $pdo->prepare($sql); foreach($p as $k=>$v){ $s->bindValue($k,$v);} $s->execute(); $queries = $s->fetchAll();
$statuses = array('new','in_progress','resolved');
$pageTitle='Admin - Handle Queries'; $cssPath='../assets/css/style.css'; $jsPath='../assets/js/main.js'; $admin_active_page='queries'; include '../includes/header.php';
?>
<main><section class="section"><div class="container"><h1 style="margin-bottom:var(--spacing-lg);">Handle Customer Queries (Admin)</h1><div class="row"><div class="col-md-3 mb-4"><?php include '../includes/admin_sidebar.php'; ?></div><div class="col-md-9 mb-4"><?php include '../includes/flash_messages.php'; ?>
<form method="get" style="margin-bottom:var(--spacing-lg);"><select name="status" style="padding:var(--spacing-sm);min-width:200px;" onchange="this.form.submit()"><option value="">All Queries</option><?php foreach($statuses as $st){ ?><option value="<?php echo e($st); ?>" <?php echo ($status_filter===$st)?'selected':''; ?>><?php echo e(query_status_label($st)); ?></option><?php } ?></select></form>
<?php if(count($queries)===0){ ?><div class="card"><p style="padding:var(--spacing-md);margin:0;">No queries found.</p></div><?php } ?>
<?php foreach($queries as $q){ ?><div class="card" style="margin-bottom:var(--spacing-lg);"><div style="display:flex;justify-content:space-between;align-items:start;padding-bottom:var(--spacing-md);border-bottom:1px solid var(--light-gray);margin-bottom:var(--spacing-md);"><div><h3 style="color:var(--primary-color);margin:0 0 var(--spacing-sm) 0;"><?php echo e($q['subject']); ?></h3><p class="text-muted" style="margin:0;"><?php echo e($q['full_name']); ?> (<?php echo e($q['email']); ?>)</p><p class="text-muted" style="margin:0;"><?php echo e($q['created_at']); ?></p></div><span class="badge badge-success"><?php echo e(query_status_label($q['status'])); ?></span></div><p><?php echo e($q['message']); ?></p><?php if(!empty($q['staff_reply'])){ ?><div style="background:#f9f6f0;padding:var(--spacing-md);border-radius:var(--border-radius);margin-bottom:var(--spacing-md);"><strong>Reply:</strong> <?php echo e($q['staff_reply']); ?></div><?php } ?>
<form method="post" action="query-handler.php"><input type="hidden" name="action" value="reply"><input type="hidden" name="id" value="<?php echo (int)$q['id']; ?>"><div class="form-group"><label>Reply</label><textarea name="staff_reply" rows="3"><?php echo e($q['staff_reply']); ?></textarea></div><div style="display:flex;gap:var(--spacing-sm);flex-wrap:wrap;"><select name="status" style="padding:var(--spacing-sm);"><?php foreach($statuses as $st){ ?><option value="<?php echo e($st); ?>" <?php echo ($q['status']===$st)?'selected':''; ?>><?php echo e(query_status_label($st)); ?></option><?php } ?></select><button type="submit" class="btn-outline btn-small">Save Reply</button></div></form>
<div style="display:flex;gap:var(--spacing-sm);margin-top:var(--spacing-sm);"><form method="post" action="query-handler.php"><input type="hidden" name="action" value="resolve"><input type="hidden" name="id" value="<?php echo (int)$q['id']; ?>"><button type="submit" class="btn-outline btn-small" style="color:#4CAF50;">Resolve</button></form><form method="post" action="query-handler.php" onsubmit="return confirm('Delete this query?');"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo (int)$q['id']; ?>"><button type="submit" class="btn-outline btn-small" style="color:#d32f2f;">Delete</button></form></div>
</div><?php } ?>
</div></div></div></section></main>
<?php include '../includes/footer.php'; ?>
