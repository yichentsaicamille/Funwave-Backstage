<?php
$info_category=$_POST["info_category"];
$info_title=$_POST["info_title"];
$info_content=$_POST["info_content"];
$info_image=$_POST["info_image"];
$info_valid=1;
$now=date("Y-m-d H:i:s");//時間無法顯示
require_once ("pdo-connect.php");

$sql="INSERT INTO information(info_category,info_title ,info_content, info_time, info_image, info_valid) VALUE(?,?,?,?,?,1)";

$stmt = $db_host->prepare($sql);
try {
    $stmt->execute([$info_category,$info_title,$info_content,$now,$info_image]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header("location:../info-list.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br/>";
    exit;
}




?>