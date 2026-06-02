<?php
session_start();
require_once __DIR__ . '/../includes/staff_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

$allowed_statuses = array('new', 'in_progress', 'resolved');

if ($action === 'delete' && $id > 0) {
  try {
    $stmt = $pdo->prepare('DELETE FROM customer_queries WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = 'Query deleted.';
  } catch (PDOException $ex) {
    $_SESSION['flash_err'] = 'Could not delete query.';
  }
  header('Location: queries.php');
  exit;
}

if ($action === 'reply' && $id > 0) {
  $reply = trim($_POST['staff_reply']);
  $status = isset($_POST['status']) ? trim($_POST['status']) : 'in_progress';
  if (!in_array($status, $allowed_statuses, true)) {
    $status = 'in_progress';
  }
  if ($reply !== '' && $status === 'new') {
    $status = 'in_progress';
  }
  try {
    $stmt = $pdo->prepare('UPDATE customer_queries SET staff_reply = :staff_reply, status = :status WHERE id = :id');
    $stmt->bindParam(':staff_reply', $reply);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = 'Reply saved.';
  } catch (PDOException $ex) {
    $_SESSION['flash_err'] = 'Could not save reply.';
  }
  header('Location: queries.php');
  exit;
}

if ($action === 'resolve' && $id > 0) {
  try {
    $stmt = $pdo->prepare("UPDATE customer_queries SET status = 'resolved' WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = 'Query marked as resolved.';
  } catch (PDOException $ex) {
    $_SESSION['flash_err'] = 'Could not update query.';
  }
  header('Location: queries.php');
  exit;
}

header('Location: queries.php');
exit;
