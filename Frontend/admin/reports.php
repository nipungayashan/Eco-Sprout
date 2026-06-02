<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$from_date = isset($_GET['from_date']) ? trim($_GET['from_date']) : '';
$to_date = isset($_GET['to_date']) ? trim($_GET['to_date']) : '';

$where = 'WHERE 1=1';
$params = array();
if ($from_date !== '') {
  $where .= ' AND DATE(order_date) >= :from_date';
  $params[':from_date'] = $from_date;
}
if ($to_date !== '') {
  $where .= ' AND DATE(order_date) <= :to_date';
  $params[':to_date'] = $to_date;
}

$summary_sql = "SELECT COUNT(*) AS order_count, COALESCE(SUM(total_amount), 0) AS total_sales FROM shop_orders $where";
$summary_stmt = $pdo->prepare($summary_sql);
foreach ($params as $key => $val) {
  $summary_stmt->bindValue($key, $val);
}
$summary_stmt->execute();
$summary = $summary_stmt->fetch();
$total_sales = (float) $summary['total_sales'];
$order_count = (int) $summary['order_count'];
$avg_order = ($order_count > 0) ? ($total_sales / $order_count) : 0;
$customer_count = (int) $pdo->query('SELECT COUNT(*) FROM users WHERE role = 0')->fetchColumn();

$top_sql = "SELECT i.product_name, SUM(i.quantity) AS units_sold, SUM(i.line_total) AS revenue,
            AVG(i.unit_price) AS avg_price
            FROM shop_order_items i
            JOIN shop_orders o ON o.id = i.order_id
            $where
            GROUP BY i.product_name
            ORDER BY revenue DESC
            LIMIT 5";
$top_stmt = $pdo->prepare($top_sql);
foreach ($params as $key => $val) {
  $top_stmt->bindValue($key, $val);
}
$top_stmt->execute();
$top_products = $top_stmt->fetchAll();

$type_sql = "SELECT i.product_type, SUM(i.line_total) AS revenue
             FROM shop_order_items i
             JOIN shop_orders o ON o.id = i.order_id
             $where
             GROUP BY i.product_type";
$type_stmt = $pdo->prepare($type_sql);
foreach ($params as $key => $val) {
  $type_stmt->bindValue($key, $val);
}
$type_stmt->execute();
$type_rows = $type_stmt->fetchAll();
$type_totals = array('plant' => 0, 'tool' => 0);
foreach ($type_rows as $tr) {
  $type_totals[$tr['product_type']] = (float) $tr['revenue'];
}
$type_grand = $type_totals['plant'] + $type_totals['tool'];
if ($type_grand <= 0) { $type_grand = 1; }

if (isset($_GET['export']) && $_GET['export'] === 'csv') {
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="ecosprout-sales-report.csv"');
  $out = fopen('php://output', 'w');
  fputcsv($out, array('Order Number', 'Customer ID', 'Date', 'Total', 'Status'));
  $orders_sql = "SELECT order_number, user_id, order_date, total_amount, status FROM shop_orders $where ORDER BY order_date DESC";
  $orders_stmt = $pdo->prepare($orders_sql);
  foreach ($params as $key => $val) {
    $orders_stmt->bindValue($key, $val);
  }
  $orders_stmt->execute();
  while ($row = $orders_stmt->fetch()) {
    fputcsv($out, array($row['order_number'], $row['user_id'], $row['order_date'], $row['total_amount'], $row['status']));
  }
  fclose($out);
  exit;
}

$pageTitle = 'Sales Reports - EcoSprout Nursery';
$cssPath = '../assets/css/style.css';
$jsPath = '../assets/js/main.js';
$admin_active_page = 'reports';
include '../includes/header.php';
?>
<main>
<section class="section">
<div class="container">
<h1 style="margin-bottom: var(--spacing-lg);">Sales Reports</h1>
<div class="row">
<div class="col-md-3 mb-4">
<?php include '../includes/admin_sidebar.php'; ?>
</div>
<div class="col-md-9 mb-4">
<form method="get" style="display:flex;gap:var(--spacing-md);margin-bottom:var(--spacing-lg);flex-wrap:wrap;align-items:end;">
<div>
<label style="display:block;margin-bottom:4px;font-weight:600;">From Date</label>
<input type="date" name="from_date" value="<?php echo e($from_date); ?>" style="padding:var(--spacing-sm);">
</div>
<div>
<label style="display:block;margin-bottom:4px;font-weight:600;">To Date</label>
<input type="date" name="to_date" value="<?php echo e($to_date); ?>" style="padding:var(--spacing-sm);">
</div>
<button type="submit" class="btn-primary">Generate Report</button>
<a href="reports.php?export=csv&amp;from_date=<?php echo urlencode($from_date); ?>&amp;to_date=<?php echo urlencode($to_date); ?>" class="btn-outline">Export to CSV</a>
</form>
<div class="row" style="margin-bottom:var(--spacing-xl);">
<div class="col-md-6 mb-4">
<div class="card">
<h3 style="color:var(--primary-color);margin-top:0;margin-bottom:var(--spacing-md);">Revenue Summary</h3>
<div style="display:flex;justify-content:space-between;margin-bottom:var(--spacing-sm);"><span>Total Sales</span><strong style="color:var(--primary-color);font-size:1.1rem;">$<?php echo number_format($total_sales, 2); ?></strong></div>
<div style="display:flex;justify-content:space-between;margin-bottom:var(--spacing-sm);"><span>Total Orders</span><strong><?php echo $order_count; ?></strong></div>
<div style="display:flex;justify-content:space-between;margin-bottom:var(--spacing-sm);"><span>Average Order Value</span><strong>$<?php echo number_format($avg_order, 2); ?></strong></div>
<div style="display:flex;justify-content:space-between;"><span>Total Customers</span><strong><?php echo $customer_count; ?></strong></div>
</div>
</div>
<div class="col-md-6 mb-4">
<div class="card">
<h3 style="color:var(--primary-color);margin-top:0;margin-bottom:var(--spacing-md);">Product Performance</h3>
<?php if (count($top_products) > 0) { ?>
<div style="display:flex;justify-content:space-between;margin-bottom:var(--spacing-sm);"><span>Top Product</span><strong><?php echo e($top_products[0]['product_name']); ?> ($<?php echo number_format((float)$top_products[0]['revenue'], 2); ?>)</strong></div>
<?php
  $items_sold = 0;
  foreach ($top_products as $tp) { $items_sold += (int)$tp['units_sold']; }
?>
<div style="display:flex;justify-content:space-between;margin-bottom:var(--spacing-sm);"><span>Total Items Sold (top 5)</span><strong><?php echo $items_sold; ?></strong></div>
<?php } else { ?>
<p class="text-muted">No sales data for this period.</p>
<?php } ?>
</div>
</div>
</div>
<div class="card" style="margin-bottom:var(--spacing-lg);">
<h3 style="color:var(--primary-color);margin-top:0;margin-bottom:var(--spacing-lg);">Top 5 Products</h3>
<div style="overflow-x:auto;">
<table style="width:100%;font-size:0.95rem;">
<thead>
<tr style="border-bottom:2px solid var(--light-gray);">
<th style="padding:var(--spacing-md);text-align:left;">Product</th>
<th style="padding:var(--spacing-md);text-align:center;">Units Sold</th>
<th style="padding:var(--spacing-md);text-align:center;">Revenue</th>
<th style="padding:var(--spacing-md);text-align:center;">Avg Price</th>
</tr>
</thead>
<tbody>
<?php if (count($top_products) === 0) { ?>
<tr><td colspan="4" style="padding:var(--spacing-md);text-align:center;">No products sold in this period.</td></tr>
<?php } ?>
<?php foreach ($top_products as $tp) { ?>
<tr style="border-bottom:1px solid var(--light-gray);">
<td style="padding:var(--spacing-md);"><?php echo e($tp['product_name']); ?></td>
<td style="padding:var(--spacing-md);text-align:center;"><?php echo (int)$tp['units_sold']; ?></td>
<td style="padding:var(--spacing-md);text-align:center;">$<?php echo number_format((float)$tp['revenue'], 2); ?></td>
<td style="padding:var(--spacing-md);text-align:center;">$<?php echo number_format((float)$tp['avg_price'], 2); ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<div class="card">
<h3 style="color:var(--primary-color);margin-top:0;margin-bottom:var(--spacing-lg);">Sales by Product Type</h3>
<?php
$plant_pct = round(($type_totals['plant'] / $type_grand) * 100);
$tool_pct = round(($type_totals['tool'] / $type_grand) * 100);
?>
<div style="display:flex;justify-content:space-between;margin-bottom:var(--spacing-md);align-items:center;">
<span>Plants</span>
<div style="flex:1;margin:0 var(--spacing-md);height:8px;background-color:var(--light-gray);border-radius:var(--border-radius);"><div style="height:100%;background-color:var(--primary-color);border-radius:var(--border-radius);width:<?php echo $plant_pct; ?>%;"></div></div>
<strong>$<?php echo number_format($type_totals['plant'], 2); ?> (<?php echo $plant_pct; ?>%)</strong>
</div>
<div style="display:flex;justify-content:space-between;align-items:center;">
<span>Tools</span>
<div style="flex:1;margin:0 var(--spacing-md);height:8px;background-color:var(--light-gray);border-radius:var(--border-radius);"><div style="height:100%;background-color:var(--secondary-color);border-radius:var(--border-radius);width:<?php echo $tool_pct; ?>%;"></div></div>
<strong>$<?php echo number_format($type_totals['tool'], 2); ?> (<?php echo $tool_pct; ?>%)</strong>
</div>
</div>
</div>
</div>
</div>
</section>
</main>
<?php include '../includes/footer.php'; ?>
