<?php
function e($text)
{
  return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
}

function role_label($role_number)
{
  $role_number = (int) $role_number;
  if ($role_number === 2) {
    return 'Admin';
  }
  if ($role_number === 1) {
    return 'Staff';
  }
  return 'Customer';
}

function query_status_label($status)
{
  if ($status === 'resolved') {
    return 'Resolved';
  }
  if ($status === 'in_progress') {
    return 'In Progress';
  }
  return 'New';
}

function product_images($row)
{
  $images = array();
  if (!empty($row['image_url'])) {
    $images[] = $row['image_url'];
  }
  if (!empty($row['image_url_2'])) {
    $images[] = $row['image_url_2'];
  }
  if (!empty($row['image_url_3'])) {
    $images[] = $row['image_url_3'];
  }
  return $images;
}

function order_status_label($status)
{
  $labels = array(
    'pending' => 'Pending',
    'processing' => 'Processing',
    'ready_to_ship' => 'Ready to Ship',
    'shipped' => 'Shipped',
    'delivered' => 'Delivered',
    'cancelled' => 'Cancelled'
  );
  if (isset($labels[$status])) {
    return $labels[$status];
  }
  return $status;
}
