<?php
if (!function_exists('e')) {
  require_once __DIR__ . '/helpers.php';
}
if (isset($_SESSION['flash_ok'])) {
  echo '<div style="background:#e8f5e9;color:#2e7d32;padding:var(--spacing-md);margin-bottom:var(--spacing-lg);border-radius:4px;">' . e($_SESSION['flash_ok']) . '</div>';
  unset($_SESSION['flash_ok']);
}
if (isset($_SESSION['flash_err'])) {
  echo '<div style="background:#ffebee;color:#c62828;padding:var(--spacing-md);margin-bottom:var(--spacing-lg);border-radius:4px;">' . e($_SESSION['flash_err']) . '</div>';
  unset($_SESSION['flash_err']);
}
