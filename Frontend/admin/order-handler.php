<?php
session_start();
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';
$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$allowed = array('pending','processing','ready_to_ship','shipped','delivered','cancelled');
if ($action === 'update_status' && $id > 0) {
  $status = isset($_POST['status']) ? trim($_POST['status']) : '';
  if (!in_array($status, $allowed, true)) { $_SESSION['flash_err'] = 'Invalid order status.'; header('Location: orders.php'); exit; }
  try { $s = $pdo->prepare('UPDATE shop_orders SET status=:status WHERE id=:id'); $s->bindParam(':status',$status); $s->bindParam(':id',$id,PDO::PARAM_INT); $s->execute(); $_SESSION['flash_ok'] = 'Order status updated.'; } catch (PDOException $e) { $_SESSION['flash_err'] = 'Could not update order.'; }
}
header('Location: orders.php'); exit;
