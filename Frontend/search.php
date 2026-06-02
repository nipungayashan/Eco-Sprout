<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/helpers.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = array();

if ($q !== '') {
  $like = '%' . $q . '%';

  $s = $pdo->prepare('SELECT id, name AS title, description, price FROM plants WHERE is_active = 1 AND (name LIKE :q1 OR category LIKE :q2 OR description LIKE :q3) ORDER BY name LIMIT 25');
  $s->bindValue(':q1', $like);
  $s->bindValue(':q2', $like);
  $s->bindValue(':q3', $like);
  $s->execute();
  foreach ($s->fetchAll() as $r) {
    $r['type'] = 'Plant';
    $r['url'] = 'plant.php?id=' . (int) $r['id'];
    $results[] = $r;
  }

  $s = $pdo->prepare('SELECT id, name AS title, description, price FROM tools WHERE is_active = 1 AND (name LIKE :q1 OR description LIKE :q2) ORDER BY name LIMIT 25');
  $s->bindValue(':q1', $like);
  $s->bindValue(':q2', $like);
  $s->execute();
  foreach ($s->fetchAll() as $r) {
    $r['type'] = 'Tool';
    $r['url'] = 'tool.php?id=' . (int) $r['id'];
    $results[] = $r;
  }

  $s = $pdo->prepare('SELECT id, name AS title, description, price FROM services WHERE is_active = 1 AND (name LIKE :q1 OR description LIKE :q2 OR price_note LIKE :q3) ORDER BY name LIMIT 25');
  $s->bindValue(':q1', $like);
  $s->bindValue(':q2', $like);
  $s->bindValue(':q3', $like);
  $s->execute();
  foreach ($s->fetchAll() as $r) {
    $r['type'] = 'Service';
    $r['url'] = 'service.php?id=' . (int) $r['id'];
    $results[] = $r;
  }

  $s = $pdo->prepare('SELECT id, title, description, price FROM workshops WHERE is_active = 1 AND (title LIKE :q1 OR description LIKE :q2 OR difficulty LIKE :q3) ORDER BY event_date LIMIT 25');
  $s->bindValue(':q1', $like);
  $s->bindValue(':q2', $like);
  $s->bindValue(':q3', $like);
  $s->execute();
  foreach ($s->fetchAll() as $r) {
    $r['type'] = 'Workshop';
    $r['url'] = 'workshop.php?id=' . (int) $r['id'];
    $results[] = $r;
  }
}

$pageTitle = 'Search - EcoSprout';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<h1 style="margin-bottom: var(--spacing-lg);">Search Results</h1>
<p class="text-muted" style="margin-bottom: var(--spacing-lg);">Showing results for: <strong><?php echo e($q); ?></strong></p>

<?php if ($q === '') { ?>
<div class="card"><p>Type a keyword in the top search bar to find any plant, tool, service, or workshop.</p></div>
<?php } elseif (count($results) === 0) { ?>
<div class="card"><p>No results found. Try another keyword.</p></div>
<?php } else { ?>
<div class="card"><div style="overflow-x:auto;">
<table style="width:100%;font-size:.95rem;">
<thead><tr style="border-bottom:2px solid var(--light-gray);"><th style="padding:var(--spacing-md);text-align:left;">Type</th><th style="padding:var(--spacing-md);text-align:left;">Item</th><th style="padding:var(--spacing-md);text-align:left;">Description</th><th style="padding:var(--spacing-md);text-align:center;">Price</th><th style="padding:var(--spacing-md);text-align:center;">Open</th></tr></thead>
<tbody>
<?php foreach ($results as $r) { ?>
<tr style="border-bottom:1px solid var(--light-gray);">
<td style="padding:var(--spacing-md);"><?php echo e($r['type']); ?></td>
<td style="padding:var(--spacing-md);"><?php echo e($r['title']); ?></td>
<td style="padding:var(--spacing-md);"><?php echo e(substr((string) $r['description'], 0, 120)); ?></td>
<td style="padding:var(--spacing-md);text-align:center;">$<?php echo e(number_format((float) $r['price'], 2)); ?></td>
<td style="padding:var(--spacing-md);text-align:center;"><a href="<?php echo e($r['url']); ?>" class="btn-outline btn-small">View</a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div></div>
<?php } ?>

</div>
</section>
</main>
<?php include 'includes/footer.php'; ?>
