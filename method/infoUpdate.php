<?php
$info_id=$_POST["info_id"];
$info_category=$_POST["info_category"];
$info_title=$_POST["info_title"];
$info_content=$_POST["info_content"];
$info_image=$_POST["info_image"];
$info_valid=1;
$now=date("Y-m-d H:i:s");

require_once ("pdo-connect.php");
$sql="UPDATE information SET info_category=? ,info_title=?, info_content=?, info_time=?, info_image=? WHERE info_id=?";

$stmt = $db_host->prepare($sql);
try {
    $stmt->execute([$info_category,$info_title,$info_content,$now,$info_image,$info_id]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    header("location:../info-editor.php?info_id=$info_id");
    header("location:../info-list.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() ;
    exit;
}

?>
