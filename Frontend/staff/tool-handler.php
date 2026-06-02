<?php
session_start();
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($action === 'delete' && $id > 0) {
  try {
    $stmt = $pdo->prepare('DELETE FROM tools WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = 'Tool deleted.';
  } catch (PDOException $ex) {
    $_SESSION['flash_err'] = 'Could not delete tool.';
  }
  header('Location: tools.php');
  exit;
}

if ($action === 'save') {
  $tool_id = isset($_POST['tool_id']) ? (int) $_POST['tool_id'] : 0;
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  $price = trim($_POST['price']);
  $stock = trim($_POST['stock']);
  $image_url = trim($_POST['image_url']);
  $is_active = isset($_POST['is_active']) ? 1 : 0;

  if ($name === '' || $price === '' || $stock === '') {
    $_SESSION['flash_err'] = 'Name, price and stock are required.';
    header('Location: tool-form.php' . ($tool_id ? '?id=' . $tool_id : ''));
    exit;
  }

  try {
    if ($tool_id > 0) {
      $sql = 'UPDATE tools SET name=:name, description=:description, price=:price, stock=:stock, image_url=:image_url, is_active=:is_active WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':id', $tool_id, PDO::PARAM_INT);
    } else {
      $sql = 'INSERT INTO tools (name, description, price, stock, image_url, is_active) VALUES (:name,:description,:price,:stock,:image_url,:is_active)';
      $stmt = $pdo->prepare($sql);
    }
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
    $stmt->bindParam(':image_url', $image_url);
    $stmt->bindParam(':is_active', $is_active, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = ($tool_id > 0) ? 'Tool updated.' : 'Tool added.';
  } catch (PDOException $ex) {
    $_SESSION['flash_err'] = 'Database error saving tool.';
  }
  header('Location: tools.php');
  exit;
}
header('Location: tools.php');
exit;
