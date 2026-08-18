<?php
session_start();

echo '<pre>';
print_r($_POST);
echo '</pre>';

require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($action === 'delete' && $id > 0) {
  try {
    $stmt = $pdo->prepare('DELETE FROM plants WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = 'Plant deleted.';
  } catch (PDOException $ex) {
    $_SESSION['flash_err'] = 'Could not delete plant.';
  }
  header('Location: plants.php');
  exit;
}

if ($action === 'save') {
  $plant_id = isset($_POST['plant_id']) ? (int) $_POST['plant_id'] : 0;
  $name = trim($_POST['name']);
  $category = trim($_POST['category']);
  $description = trim($_POST['description']);
  $price = trim($_POST['price']);
  $stock = trim($_POST['stock']);
  $image_url = trim($_POST['image_url']);
  $is_active = isset($_POST['is_active']) ? 1 : 0;
  if ($name === '' || $category === '' || $price === '' || $stock === '') {
    $_SESSION['flash_err'] = 'Please fill in required fields.';
    header('Location: plant-form.php' . ($plant_id ? '?id=' . $plant_id : ''));
    exit;
  }
  try {
    if ($plant_id > 0) {
      $stmt = $pdo->prepare(
        'UPDATE plants
         SET name=:name,
         category=:category,
         description=:description,
         price=:price,
         stock=:stock,
         image_url=:image_url,
         is_active=:is_active
         WHERE id=:id'
        );
      $stmt->bindParam(':id', $plant_id, PDO::PARAM_INT);
    } else {
      $stmt = $pdo->prepare(
        'INSERT INTO plants
        (name, category, description, price, stock, image_url, is_active)
        VALUES
        (:name,:category,:description,:price,:stock,:image_url,:is_active)'
        ); 
    }
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
    $stmt->bindParam(':image_url', $image_url);
    $stmt->bindParam(':is_active', $is_active, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = ($plant_id > 0) ? 'Plant updated.' : 'Plant added.';
  } catch (PDOException $ex) {
    die('PDO Error: ' . $ex->getMessage());
}
  header('Location: plants.php');
  exit;
}

header('Location: plants.php');
exit;
