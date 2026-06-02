<?php
/**
 * Must be logged in to view the page
 */
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: ../auth/login.php');
  exit;
}

function check_user_role($required_role)
{
  if ((int) $_SESSION['role'] !== (int) $required_role) {
    header('Location: ../auth/login.php');
    exit;
  }
}

/**
 * Allow either the required role OR admin role (2).
 * This lets admin access staff/customer modules as super user.
 */
function check_user_role_or_admin($required_role)
{
  $current_role = (int) $_SESSION['role'];
  $required_role = (int) $required_role;

  if ($current_role !== $required_role && $current_role !== 2) {
    header('Location: ../auth/login.php');
    exit;
  }
}
