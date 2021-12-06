<?php
require_once ("pdo-connect.php");

$sql = "INSERT INTO `coach`(`coach_name`, `coach_account`, `coach_password`, `genre_id`, `coach_phone`, `coach_email`, `coach_address`, `coach_expertise`, `coach_photo`, `coach_valid`) VALUES ('{$_POST['coach_name']}', '{$_POST['coach_account']}', '{$_POST['coach_password']}', '{$_POST['genre_id']}', '{$_POST['coach_phone']}', '{$_POST['coach_email']}', '{$_POST['coach_address']}', '{$_POST['coach_expertise']}', '{$_POST['coach_photo']}', 1)";


//$crPassword=md5('$coach_password'); //存至資料庫時密碼顯示變亂碼
//echo "$crPassword<br>";
$sqlCheck="SELECT * FROM coach WHERE coach_account='{$_POST['coach_account']}'";
$stmt2 = $db_host->prepare($sqlCheck);
$num_rows = $stmt2->fetchColumn();
//echo $userExist;
if($num_rows>0){
    echo "帳號已存在";
    exit();
}


$stmt = $db_host->prepare($sql);

$stmt->execute();

header("location: ../coach.php");

