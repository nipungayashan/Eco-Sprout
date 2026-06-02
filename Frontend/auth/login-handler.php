<?php
/**
 * Login with email + password
 */
session_start();

require_once __DIR__ . '/../config/db.php';

if (!($pdo instanceof PDO)) {
  die('Database connection failed.');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: login.php');
  exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$errors = array();

if ($email === '') {
  $errors[] = 'Email address is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = 'Please enter a valid email address.';
}

if ($password === '') {
  $errors[] = 'Password is required.';
}

if (count($errors) > 0) {
  $_SESSION['login_errors'] = $errors;
  header('Location: login.php');
  exit;
}

try {
  $sql = 'SELECT id, email, password, full_name, role
          FROM users
          WHERE email = :email
          LIMIT 1';

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $user = $stmt->fetch();
} catch (PDOException $e) {
  $_SESSION['login_errors'] = array('Database error. Please try again.');
  header('Location: login.php');
  exit;
}

if (!$user || $password !== $user['password']) {
  $_SESSION['login_errors'] = array('Invalid email or password. Please try again.');
  header('Location: login.php');
  exit;
}

$_SESSION['user_id'] = (int) $user['id'];
$_SESSION['name'] = $user['full_name'];
$_SESSION['role'] = (int) $user['role'];
$_SESSION['email'] = $user['email'];

unset($_SESSION['login_errors']);

$user_role = (int) $user['role'];
$redirect = isset($_POST['redirect']) ? trim($_POST['redirect']) : '';

function safe_redirect_path($path)
{
  if ($path === '' || strpos($path, '..') !== false || strpos($path, '://') !== false) {
    return '';
  }
  return $path;
}

$redirect = safe_redirect_path($redirect);

if ($user_role === 0) {
  if ($redirect !== '') {
    header('Location: ../' . $redirect);
    exit;
  }
  header('Location: ../customer/dashboard.php');
  exit;
}
if ($user_role === 1) {
  header('Location: ../staff/index.php');
  exit;
}
if ($user_role === 2) {
  header('Location: ../admin/index.php');
  exit;
}

$_SESSION['login_errors'] = array('Unknown account role.');
header('Location: login.php');
exit;
