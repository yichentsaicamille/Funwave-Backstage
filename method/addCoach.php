<?php
require_once ("pdo-connect.php");
$crPassword=md5($_POST['coach_password']); //存至資料庫時密碼顯示變亂碼

//echo "$crPassword<br>";
//$sqlCheck="SELECT * FROM coach WHERE coach_email='{$_POST['coach_email']}'
//                      AND coach_phone='{$_POST['coach_photo']}' AND coach_account='{$_POST['coach_account']}'";
//$stmt2 = $db_host->prepare($sqlCheck);
//$num_rows = $stmt2->fetchColumn();
////echo $userExist;
//if($num_rows>0){
//    echo "帳號或信箱或手機已存在";
//    exit();
//}



//$sqlCheck="SELECT * FROM coach WHERE coach_account='$coach_account' AND coach_email='$coach_email' AND coach_phone='$coach_phone'";
//$stmtCheck = $db_host->prepare($sqlCheck);
//if($stmtCheck->fetchAll()>0){
//    $data=array(
//        "status"=>0,
//        "message"=>"帳號已有人註冊
//"
//    );
//}else{
//    $data=array(
//        "status"=>1,
//        "message"=>"帳號可以使用
//"
//    );
//}

$sql = "INSERT INTO `coach`(`coach_name`, `coach_account`, `coach_password`, `genre_id`, `coach_phone`, `coach_email`, `coach_address`, `coach_expertise`, `coach_photo`, `coach_valid`) VALUES ('{$_POST['coach_name']}', '{$_POST['coach_account']}', '$crPassword', '{$_POST['genre_id']}', '{$_POST['coach_phone']}', '{$_POST['coach_email']}', '{$_POST['coach_address']}', '{$_POST['coach_expertise']}', '{$_POST['coach_photo']}', 1)";

$stmt = $db_host->prepare($sql);

$stmt->execute();

header("location: ../coach.php");

