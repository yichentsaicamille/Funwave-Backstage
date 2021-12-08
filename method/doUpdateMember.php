<?php
require_once("pdo-connect.php");
$member_name=$_POST["member_name"];
$member_password=$_POST["member_password"];
$member_account=$_POST["member_account"];
$member_gender=$_POST["member_gender"];
$member_phone=$_POST["member_phone"];
$member_email=$_POST["member_email"];
$member_address=$_POST["member_address"];
$member_photo=$_POST["member_photo"];
$member_id=$_POST["member_id"];
$member_valid=1;


$member_password=md5($member_password); //密碼加密

$sqlMember="UPDATE member SET member_name='$member_name', member_password='$member_password', member_gender='$member_gender', member_phone='$member_phone', member_email='$member_email', member_address='$member_address', member_photo='$member_photo' WHERE member_id=?";
$stmtMember = $db_host->prepare($sqlMember);

// echo $sqlMember;

try {
    $stmtMember->execute([$member_id]);
    $rowMember = $stmtMember->fetch();
    // $memberExist = $stmtMember->rowCount();
    header("location: ../member-list.php");
} catch (PDOException $e) {
    echo $e->getMessage();
    
}

?>