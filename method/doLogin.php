<?php
require_once("pdo-connect.php");

if (isset($_POST["member_account"])) { //確保資料可以送到後端
    $member_account = $_POST["member_account"];
    $member_password = $_POST["member_password"];
} else {
    exit();
}

$member_password=md5($member_password);

$sqlMember = "SELECT * FROM member WHERE member_account=? AND member_password=? AND member_valid=1";
$stmtMember = $db_host->prepare($sqlMember);

// // echo $sql;
try {
    $stmtMember->execute([$member_account, $member_password]);
    $memberExist=$stmtMember->rowCount();
    if($memberExist>0){
        $rowMember = $stmtMember->fetch();
        $member=[
            "member_id"=>$rowMember["member_id"],
            "member_account"=>$rowMember["member_account"],
            "member_password"=>$rowMember["member_password"],
            "member_name"=>$rowMember["member_name"]
        ];
        $_SESSION["member"]=$member; 
        header("location: ../member-list.php");
    }else{
        header("location: ../log-in.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}