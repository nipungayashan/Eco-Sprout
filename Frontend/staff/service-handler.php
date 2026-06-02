<?php
session_start();
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($action === 'delete' && $id > 0) {
  try {
    $stmt = $pdo->prepare('DELETE FROM services WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = 'Service deleted.';
  } catch (PDOException $ex) {
    $_SESSION['flash_err'] = 'Could not delete service.';
  }
  header('Location: services.php');
  exit;
}

if ($action === 'save') {
  $service_id = isset($_POST['service_id']) ? (int) $_POST['service_id'] : 0;
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  $price = trim($_POST['price']);
  $price_note = trim($_POST['price_note']);
  $icon_emoji = trim($_POST['icon_emoji']);
  $is_active = isset($_POST['is_active']) ? 1 : 0;

  if ($name === '' || $price === '') {
    $_SESSION['flash_err'] = 'Name and price are required.';
    header('Location: service-form.php' . ($service_id ? '?id=' . $service_id : ''));
    exit;
  }

  try {
    if ($service_id > 0) {
      $sql = 'UPDATE services SET name=:name, description=:description, price=:price, price_note=:price_note, icon_emoji=:icon_emoji, is_active=:is_active WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':id', $service_id, PDO::PARAM_INT);
    } else {
      $sql = 'INSERT INTO services (name, description, price, price_note, icon_emoji, is_active) VALUES (:name,:description,:price,:price_note,:icon_emoji,:is_active)';
      $stmt = $pdo->prepare($sql);
    }
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':price_note', $price_note);
    $stmt->bindParam(':icon_emoji', $icon_emoji);
    $stmt->bindParam(':is_active', $is_active, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = ($service_id > 0) ? 'Service updated.' : 'Service added.';
  } catch (PDOException $ex) {
    $_SESSION['flash_err'] = 'Database error saving service.';
  }
  header('Location: services.php');
  exit;
}
header('Location: services.php');
exit;
