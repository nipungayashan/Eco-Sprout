<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/helpers.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
  header('Location: workshops.php');
  exit;
}

$stmt = $pdo->prepare('SELECT * FROM workshops WHERE id = :id AND is_active = 1');
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch();
if (!$product) {
  header('Location: workshops.php');
  exit;
}

$productType = 'workshop';
$productName = $product['title'];
$productSubtitle = date('M j, Y', strtotime($product['event_date'])) . ' at ' . date('g:i A', strtotime($product['event_time'])) . ' • ' . $product['difficulty'];
$listUrl = 'workshops.php';
$maxQty = (int) $product['spots_available'];
$price = $product['price'];
$siteRoot = '';

$pageTitle = $productName . ' - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
include 'includes/product_detail_template.php';
include 'includes/footer.php';
