<?php
session_start();
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($action === 'delete' && $id > 0) {
  if ($id === (int) $_SESSION['user_id']) {
    $_SESSION['flash_err'] = 'You cannot delete your own account.';
    header('Location: users.php');
    exit;
  }
  try {
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = 'User deleted.';
  } catch (PDOException $ex) {
    $_SESSION['flash_err'] = 'Could not delete user.';
  }
  header('Location: users.php');
  exit;
}

if ($action === 'save') {
  $user_id = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;
  $full_name = trim($_POST['full_name']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $role = isset($_POST['role']) ? (int) $_POST['role'] : 0;
  $password = trim($_POST['password']);
  $is_active = isset($_POST['is_active']) ? 1 : 0;

  if ($full_name === '' || $email === '') {
    $_SESSION['flash_err'] = 'Name and email are required.';
    header('Location: user-form.php' . ($user_id ? '?id=' . $user_id : ''));
    exit;
  }

  if ($user_id === 0 && $password === '') {
    $_SESSION['flash_err'] = 'Password is required for new users.';
    header('Location: user-form.php');
    exit;
  }

  try {
    if ($user_id > 0) {
      if ($password !== '') {
        $sql = 'UPDATE users SET full_name=:full_name, email=:email, phone=:phone, role=:role, password=:password, is_active=:is_active WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':password', $password);
      } else {
        $sql = 'UPDATE users SET full_name=:full_name, email=:email, phone=:phone, role=:role, is_active=:is_active WHERE id=:id';
        $stmt = $pdo->prepare($sql);
      }
      $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    } else {
      $sql = 'INSERT INTO users (full_name, email, phone, role, password, is_active) VALUES (:full_name,:email,:phone,:role,:password,:is_active)';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':password', $password);
    }
    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':role', $role, PDO::PARAM_INT);
    $stmt->bindParam(':is_active', $is_active, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['flash_ok'] = ($user_id > 0) ? 'User updated.' : 'User added.';
  } catch (PDOException $ex) {
    $_SESSION['flash_err'] = 'Database error. Email may already exist.';
  }
  header('Location: users.php');
  exit;
}

header('Location: users.php');
exit;
