<?php
$info_id=$_GET["info_id"];
require_once ("pdo-connect.php");
$sql="UPDATE information SET info_valid = 0 WHERE info_id=?";
$stmt = $db_host->prepare($sql);
try {
    $stmt->execute([$info_id]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header("location:../info-list.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() ;
    exit;
}

?>
