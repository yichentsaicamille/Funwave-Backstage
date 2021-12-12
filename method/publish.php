<?php 
require_once ("pdo-connect.php");
$sql = "INSERT INTO `coach`(`coach_name`, `coach_account`, `coach_password`, `genre_id`, `coach_phone`, `coach_email`, `coach_address`, `coach_expertise`, `coach_photo`, `coach_publish`, `coach_valid`) VALUES ('{$_POST['coach_name']}', '{$_POST['coach_account']}', '$crPassword', '{$_POST['genre_id']}', '{$_POST['coach_phone']}', '{$_POST['coach_email']}', '{$_POST['coach_address']}', '{$_POST['coach_expertise']}', '{$_POST['coach_photo']}','{$_POST['coach_publish']}' 1)";

$stmt = $db_host->prepare($sql);

$stmt->execute();

header("location: ../coach.php");

?>