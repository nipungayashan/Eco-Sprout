<?php
session_start();
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';
$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
if ($action === 'delete' && $id > 0) {
  try { $s = $pdo->prepare('DELETE FROM tools WHERE id=:id'); $s->bindParam(':id', $id, PDO::PARAM_INT); $s->execute(); $_SESSION['flash_ok'] = 'Tool deleted.'; } catch (PDOException $e) { $_SESSION['flash_err'] = 'Could not delete tool.'; }
  header('Location: tools.php'); exit;
}
if ($action === 'save') {
  $tool_id = isset($_POST['tool_id']) ? (int) $_POST['tool_id'] : 0;
  $name = trim($_POST['name']); $description = trim($_POST['description']); $price = trim($_POST['price']); $stock = trim($_POST['stock']); $image_url = trim($_POST['image_url']); $is_active = isset($_POST['is_active']) ? 1 : 0;
  if ($name === '' || $price === '' || $stock === '') { $_SESSION['flash_err'] = 'Name, price and stock required.'; header('Location: tool-form.php' . ($tool_id ? '?id=' . $tool_id : '')); exit; }
  try {
    if ($tool_id > 0) { $s = $pdo->prepare('UPDATE tools SET name=:name, description=:description, price=:price, stock=:stock, image_url=:image_url, is_active=:is_active WHERE id=:id'); $s->bindParam(':id', $tool_id, PDO::PARAM_INT); }
    else { $s = $pdo->prepare('INSERT INTO tools (name,description,price,stock,image_url,is_active) VALUES (:name,:description,:price,:stock,:image_url,:is_active)'); }
    $s->bindParam(':name', $name); $s->bindParam(':description', $description); $s->bindParam(':price', $price); $s->bindParam(':stock', $stock, PDO::PARAM_INT); $s->bindParam(':image_url', $image_url); $s->bindParam(':is_active', $is_active, PDO::PARAM_INT); $s->execute();
    $_SESSION['flash_ok'] = ($tool_id > 0) ? 'Tool updated.' : 'Tool added.';
  } catch (PDOException $e) { $_SESSION['flash_err'] = 'Database error saving tool.'; }
  header('Location: tools.php'); exit;
}
header('Location: tools.php'); exit;
