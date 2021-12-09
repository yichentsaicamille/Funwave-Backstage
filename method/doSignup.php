<?php
require_once ("pdo-connect.php");
$member_name=$_POST["member_name"];
$member_account=$_POST["member_account"];
$member_password=$_POST["member_password"];
$repassword=$_POST["repassword"];
$member_gender=$_POST["member_gender"];
$member_phone=$_POST["member_phone"];
$member_email=$_POST["member_email"];
$member_address=$_POST["member_address"];
$member_valid=1;

$member_password=md5($member_password);
$repassword=md5($repassword);

if($member_password!==$repassword){
    echo "密碼不一致";
    exit();
}

$sqlMember="SELECT * FROM member WHERE member_account='$member_account'"; //判斷帳號是否有重複
$stmtMember = $db_host->prepare($sqlMember);

try {
    $stmtMember->execute=([]);
    $memberExist = $stmtMember->rowCount();
    if($memberExist>0){
        echo "帳號已存在";
        exit();
    }
    header("location: ../sign-up.php");
} catch (PDOException $e) {
    echo $e->getMessage();
    
}


$now=date("Y-m-d H:i:s");
$sqlMember="INSERT INTO member(member_name, member_account, member_password, member_gender, member_phone, member_email, member_address, member_created_at, member_valid) VALUES('$member_name', '$member_account', '$member_password', '$member_gender', '$member_phone', '$member_email', '$member_address', '$now', '$member_valid')";

$stmtMember = $db_host->prepare($sqlMember);
try {
    $stmtMember->execute([]);
    $rowMember = $stmtMember->fetch();
    header("location: ../log-in-admin.php");
} catch (PDOException $e) {
    echo $e->getMessage();
    
}
?>