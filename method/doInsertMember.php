<?php
require_once ("pdo-connect.php");
$member_name=$_POST["member_name"];
$member_account=$_POST["member_account"];
$member_password=$_POST["member_password"];
$member_gender=$_POST["member_gender"];
$member_phone=$_POST["member_phone"];
$member_email=$_POST["member_email"];
$member_address=$_POST["member_address"];
$member_photo=$_POST["member_photo"];
$member_valid=1;


$member_password=md5($member_password); //密碼加密


$now=date("Y-m-d H:i:s");
$sqlMember="INSERT INTO member(member_name, member_account, member_password, member_gender, member_phone, member_email, member_address, member_photo, member_created_at, member_valid) VALUES('$member_name', '$member_account', '$member_password', '$member_gender', '$member_phone', '$member_email', '$member_address', '$member_photo', '$now', '$member_valid')";

$stmtMember = $db_host->prepare($sqlMember);
try {
    $stmtMember->execute([]);
    $rowMember = $stmtMember->fetch();
    header("location: ../member-list.php");
} catch (PDOException $e) {
    echo $e->getMessage();
    
}


?>