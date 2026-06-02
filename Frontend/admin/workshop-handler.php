<?php
session_start();
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../config/db.php';
$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($action === 'delete' && $id > 0) {
  try { $s=$pdo->prepare('DELETE FROM workshops WHERE id=:id'); $s->bindParam(':id',$id,PDO::PARAM_INT); $s->execute(); $_SESSION['flash_ok']='Workshop deleted.'; } catch (PDOException $e) { $_SESSION['flash_err']='Could not delete workshop.'; }
  header('Location: workshops.php'); exit;
}
if ($action === 'save') {
  $workshop_id = isset($_POST['workshop_id']) ? (int)$_POST['workshop_id'] : 0;
  $title=trim($_POST['title']); $description=trim($_POST['description']); $event_date=trim($_POST['event_date']); $event_time=trim($_POST['event_time']); $duration_hours=trim($_POST['duration_hours']); $difficulty=trim($_POST['difficulty']); $capacity=trim($_POST['capacity']); $spots_available=trim($_POST['spots_available']); $price=trim($_POST['price']); $is_active=isset($_POST['is_active'])?1:0;
  if ($title==='' || $event_date==='' || $price==='') { $_SESSION['flash_err']='Title, date and price are required.'; header('Location: workshop-form.php' . ($workshop_id?'?id='.$workshop_id:'')); exit; }
  if ($duration_hours==='') { $duration_hours='2.0'; } if ($capacity==='') { $capacity='20'; } if ($spots_available==='') { $spots_available=$capacity; } if ($event_time==='') { $event_time='10:00:00'; } if ($difficulty==='') { $difficulty='Beginner'; }
  try {
    if ($workshop_id>0) { $s=$pdo->prepare('UPDATE workshops SET title=:title, description=:description, event_date=:event_date, event_time=:event_time, duration_hours=:duration_hours, difficulty=:difficulty, capacity=:capacity, spots_available=:spots_available, price=:price, is_active=:is_active WHERE id=:id'); $s->bindParam(':id',$workshop_id,PDO::PARAM_INT); }
    else { $s=$pdo->prepare('INSERT INTO workshops (title,description,event_date,event_time,duration_hours,difficulty,capacity,spots_available,price,is_active) VALUES (:title,:description,:event_date,:event_time,:duration_hours,:difficulty,:capacity,:spots_available,:price,:is_active)'); }
    $s->bindParam(':title',$title); $s->bindParam(':description',$description); $s->bindParam(':event_date',$event_date); $s->bindParam(':event_time',$event_time); $s->bindParam(':duration_hours',$duration_hours); $s->bindParam(':difficulty',$difficulty); $s->bindParam(':capacity',$capacity,PDO::PARAM_INT); $s->bindParam(':spots_available',$spots_available,PDO::PARAM_INT); $s->bindParam(':price',$price); $s->bindParam(':is_active',$is_active,PDO::PARAM_INT); $s->execute();
    $_SESSION['flash_ok']=($workshop_id>0)?'Workshop updated.':'Workshop added.';
  } catch (PDOException $e) { $_SESSION['flash_err']='Database error saving workshop.'; }
  header('Location: workshops.php'); exit;
}
header('Location: workshops.php'); exit;
