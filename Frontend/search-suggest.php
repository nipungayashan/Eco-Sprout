<?php
require_once __DIR__ . '/config/db.php';
header('Content-Type: application/json; charset=UTF-8');

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if ($q === '') {
  echo json_encode(array('items' => array()));
  exit;
}

$like = '%' . $q . '%';
$items = array();

function add_items(&$items, $rows, $type, $url_prefix)
{
  foreach ($rows as $r) {
    $items[] = array(
      'type' => $type,
      'title' => $r['title'],
      'url' => $url_prefix . (int) $r['id'],
      'image' => isset($r['image']) ? $r['image'] : ''
    );
  }
}

$s = $pdo->prepare("SELECT id, name AS title, COALESCE(NULLIF(image_url,''), 'assets/images/plant-1.jpg') AS image FROM plants WHERE is_active = 1 AND (name LIKE :q1 OR category LIKE :q2 OR description LIKE :q3) ORDER BY name LIMIT 6");
$s->bindValue(':q1', $like);
$s->bindValue(':q2', $like);
$s->bindValue(':q3', $like);
$s->execute();
add_items($items, $s->fetchAll(), 'Plant', 'plant.php?id=');

$s = $pdo->prepare("SELECT id, name AS title, COALESCE(NULLIF(image_url,''), 'assets/images/tool-1.jpg') AS image FROM tools WHERE is_active = 1 AND (name LIKE :q1 OR description LIKE :q2) ORDER BY name LIMIT 6");
$s->bindValue(':q1', $like);
$s->bindValue(':q2', $like);
$s->execute();
add_items($items, $s->fetchAll(), 'Tool', 'tool.php?id=');

$s = $pdo->prepare("SELECT id, name AS title, 'assets/images/service-1.jpg' AS image FROM services WHERE is_active = 1 AND (name LIKE :q1 OR description LIKE :q2 OR price_note LIKE :q3) ORDER BY name LIMIT 6");
$s->bindValue(':q1', $like);
$s->bindValue(':q2', $like);
$s->bindValue(':q3', $like);
$s->execute();
add_items($items, $s->fetchAll(), 'Service', 'service.php?id=');

$s = $pdo->prepare("SELECT id, title, 'assets/images/workshop-1.jpg' AS image FROM workshops WHERE is_active = 1 AND (title LIKE :q1 OR description LIKE :q2 OR difficulty LIKE :q3) ORDER BY title LIMIT 6");
$s->bindValue(':q1', $like);
$s->bindValue(':q2', $like);
$s->bindValue(':q3', $like);
$s->execute();
$rows = $s->fetchAll();
foreach ($rows as $r) {
  $items[] = array(
    'type' => 'Workshop',
    'title' => $r['title'],
    'url' => 'workshop.php?id=' . (int) $r['id'],
    'image' => isset($r['image']) ? $r['image'] : 'assets/images/workshop-1.jpg'
  );
}

if (count($items) > 12) {
  $items = array_slice($items, 0, 12);
}

echo json_encode(array('items' => $items));
exit;

