<?php
session_start();
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$allowed = array('new','in_progress','resolved');
if ($action === 'delete' && $id > 0) {
  try { $s = $pdo->prepare('DELETE FROM customer_queries WHERE id=:id'); $s->bindParam(':id',$id,PDO::PARAM_INT); $s->execute(); $_SESSION['flash_ok'] = 'Query deleted.'; } catch (PDOException $e) { $_SESSION['flash_err'] = 'Could not delete query.'; }
  header('Location: queries.php'); exit;
}
if ($action === 'reply' && $id > 0) {
  $reply = trim($_POST['staff_reply']);
  $status = isset($_POST['status']) ? trim($_POST['status']) : 'in_progress';
  if (!in_array($status, $allowed, true)) { $status = 'in_progress'; }
  try { $s = $pdo->prepare('UPDATE customer_queries SET staff_reply=:reply, status=:status WHERE id=:id'); $s->bindParam(':reply',$reply); $s->bindParam(':status',$status); $s->bindParam(':id',$id,PDO::PARAM_INT); $s->execute(); $_SESSION['flash_ok'] = 'Reply saved.'; } catch (PDOException $e) { $_SESSION['flash_err'] = 'Could not save reply.'; }
  header('Location: queries.php'); exit;
}
if ($action === 'resolve' && $id > 0) {
  try { $s = $pdo->prepare("UPDATE customer_queries SET status='resolved' WHERE id=:id"); $s->bindParam(':id',$id,PDO::PARAM_INT); $s->execute(); $_SESSION['flash_ok'] = 'Query marked resolved.'; } catch (PDOException $e) { $_SESSION['flash_err'] = 'Could not update query.'; }
  header('Location: queries.php'); exit;
}
header('Location: queries.php'); exit;
