<?php
require_once("pdo-connect.php");
$member_id=$_GET["member_id"];

$sqlMember="UPDATE member SET member_valid=0 WHERE member_id=?";
$stmtMember = $db_host->prepare($sqlMember);


try {
    $stmtMember->execute([$member_id]);
    $rowMember = $stmtMember->fetch();

    header("location: ../member-list.php");
} catch (PDOException $e) {
    echo $e->getMessage();
    
}

$now=date("Y-m-d H:i:s");
$sqlMember="INSERT INTO member(member_deleted_at) VALUES('$now') WHERE member_id=?";
$stmtMember = $db_host->prepare($sqlMember);

try {
    $stmtMember->execute([$member_id]);
    $rowMember = $stmtMember->fetch();
    // header("location: ../member-list.php");
} catch (PDOException $e) {
    echo $e->getMessage();
    
}

?>