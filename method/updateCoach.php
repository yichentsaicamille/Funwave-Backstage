<?php
require_once ("pdo-connect.php");
$crPassword=md5($_POST['coach_password']); //存至資料庫時密碼顯示變亂碼

$sql = "UPDATE `coach` SET `coach_name`='{$_POST['coach_name']}',`coach_account`='{$_POST['coach_account']}',`coach_password`='{$crPassword}',`genre_id`='{$_POST['genre_id']}',`coach_phone`='{$_POST['coach_phone']}',`coach_email`='{$_POST['coach_email']}',`coach_address`='{$_POST['coach_address']}',`coach_expertise`='{$_POST['coach_expertise']}',`coach_photo`='{$_POST['coach_photo']}' where `coach_id`='{$_POST['coach_id']}'";

$stmt = $db_host->query($sql);
//$stmt = $db_host->prepare($sql);

header("location: ../coach.php");