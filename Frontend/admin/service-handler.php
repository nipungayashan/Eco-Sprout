<?php
session_start();
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';
$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
if ($action === 'delete' && $id > 0) {
  try { $s = $pdo->prepare('DELETE FROM services WHERE id=:id'); $s->bindParam(':id',$id,PDO::PARAM_INT); $s->execute(); $_SESSION['flash_ok']='Service deleted.'; } catch (PDOException $e) { $_SESSION['flash_err']='Could not delete service.'; }
  header('Location: services.php'); exit;
}
if ($action === 'save') {
  $service_id = isset($_POST['service_id']) ? (int) $_POST['service_id'] : 0;
  $name = trim($_POST['name']); $description = trim($_POST['description']); $price = trim($_POST['price']); $price_note = trim($_POST['price_note']); $icon_emoji = trim($_POST['icon_emoji']); $is_active = isset($_POST['is_active']) ? 1 : 0;
  if ($name === '' || $price === '') { $_SESSION['flash_err'] = 'Name and price are required.'; header('Location: service-form.php' . ($service_id ? '?id=' . $service_id : '')); exit; }
  try {
    if ($service_id > 0) { $s = $pdo->prepare('UPDATE services SET name=:name, description=:description, price=:price, price_note=:price_note, icon_emoji=:icon_emoji, is_active=:is_active WHERE id=:id'); $s->bindParam(':id',$service_id,PDO::PARAM_INT); }
    else { $s = $pdo->prepare('INSERT INTO services (name,description,price,price_note,icon_emoji,is_active) VALUES (:name,:description,:price,:price_note,:icon_emoji,:is_active)'); }
    $s->bindParam(':name',$name); $s->bindParam(':description',$description); $s->bindParam(':price',$price); $s->bindParam(':price_note',$price_note); $s->bindParam(':icon_emoji',$icon_emoji); $s->bindParam(':is_active',$is_active,PDO::PARAM_INT); $s->execute();
    $_SESSION['flash_ok'] = ($service_id > 0) ? 'Service updated.' : 'Service added.';
  } catch (PDOException $e) { $_SESSION['flash_err'] = 'Database error saving service.'; }
  header('Location: services.php'); exit;
}
header('Location: services.php'); exit;
