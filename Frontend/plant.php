<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/helpers.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
  header('Location: catalogue.php');
  exit;
}

$stmt = $pdo->prepare('SELECT * FROM plants WHERE id = :id AND is_active = 1');
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch();
if (!$product) {
  header('Location: catalogue.php');
  exit;
}

$productType = 'plant';
$productName = $product['name'];
$productSubtitle = $product['category'];
$listUrl = 'catalogue.php';
$maxQty = (int) $product['stock'];
$price = $product['price'];
$siteRoot = '';

$pageTitle = $productName . ' - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';
$jsPath = 'assets/js/main.js';
include 'includes/header.php';
include 'includes/product_detail_template.php';
include 'includes/footer.php';
