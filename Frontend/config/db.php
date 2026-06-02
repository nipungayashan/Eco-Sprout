<?php
/**
 * EcoSprout Nursery - Database connection (PDO)
 */
$db_host = 'localhost';
$db_name = 'ecosprout';
$db_user = 'root';
$db_pass = '';
$db_charset = 'utf8mb4';

$dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=' . $db_charset;

$pdo_options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
);

try {
  /** @var PDO $pdo */
  $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
} catch (PDOException $e) {
  die('Database connection failed. Check WAMP MySQL is running and config/db.php settings.');
}

if (!($pdo instanceof PDO)) {
  die('Database connection failed.');
}

/**
 * Tables: users, plants, tools, services, workshops, shop_orders, shop_order_items,
 * bookings, customer_queries, blog_articles, newsletter_subscribers
 * See config/schema.sql and config/DATABASE_SETUP.md
 */
