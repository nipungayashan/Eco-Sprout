<?php
/**
 * Register new customer with email (used for login later)
 */
session_start();

require_once __DIR__ . '/../config/db.php';

if (!($pdo instanceof PDO)) {
  die('Database connection failed.');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: register.php');
  exit;
}

$fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirm_password = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';
$terms_accepted = isset($_POST['terms']);

$errors = array();

if ($fullname === '') {
  $errors[] = 'Full name is required.';
}

if ($email === '') {
  $errors[] = 'Email address is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = 'Please enter a valid email address.';
}

if ($password === '') {
  $errors[] = 'Password is required.';
} else {
  $has_length = strlen($password) >= 8;
  $has_upper = preg_match('/[A-Z]/', $password);
  $has_lower = preg_match('/[a-z]/', $password);
  $has_number = preg_match('/[0-9]/', $password);

  if (!$has_length || !$has_upper || !$has_lower || !$has_number) {
    $errors[] = 'Password must be 8+ chars with uppercase, lowercase, and a number.';
  }
}

if ($password !== $confirm_password) {
  $errors[] = 'Passwords do not match.';
}

if (!$terms_accepted) {
  $errors[] = 'You must agree to the terms.';
}

if (count($errors) > 0) {
  $_SESSION['register_errors'] = $errors;
  $_SESSION['register_old'] = array(
    'fullname' => $fullname,
    'email' => $email,
    'phone' => $phone
  );
  header('Location: register.php');
  exit;
}

try {
  $sql_check = 'SELECT id FROM users WHERE email = :email LIMIT 1';
  $stmt_check = $pdo->prepare($sql_check);
  $stmt_check->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt_check->execute();

  if ($stmt_check->fetch()) {
    $_SESSION['register_errors'] = array('This email is already registered.');
    $_SESSION['register_old'] = array(
      'fullname' => $fullname,
      'email' => $email,
      'phone' => $phone
    );
    header('Location: register.php');
    exit;
  }

  $default_role = 0;
  $sql_insert = 'INSERT INTO users (email, password, full_name, phone, role)
                 VALUES (:email, :password, :full_name, :phone, :role)';

  $stmt_insert = $pdo->prepare($sql_insert);
  $stmt_insert->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt_insert->bindParam(':password', $password, PDO::PARAM_STR);
  $stmt_insert->bindParam(':full_name', $fullname, PDO::PARAM_STR);
  $stmt_insert->bindParam(':phone', $phone, PDO::PARAM_STR);
  $stmt_insert->bindParam(':role', $default_role, PDO::PARAM_INT);
  $stmt_insert->execute();

  $_SESSION['register_success'] = 'Account created! Sign in with your email and password.';
  header('Location: login.php');
  exit;
} catch (PDOException $e) {
  $_SESSION['register_errors'] = array('Could not create account. Check the database is set up.');
  header('Location: register.php');
  exit;
}
