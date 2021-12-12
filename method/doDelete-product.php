<?php
require_once ("pdo-connect.php");

$product_id=$_GET["id"];   //前台<a>button不能用name="product_id"帶值過來，所以直接GET網址的"id"

echo "<br>-------------------<br>";
var_dump($product_id);    //看一下$product_id有沒有GET到值
// exit();   //提前停止程式

//硬性刪除，資料庫資料刪除
$sql="DELETE FROM products WHERE product_id='$product_id'";


echo "<br>-------------------<br>";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute();
    $dataCount=$stmt->rowCount();
    echo "資料移除完成";
    header("location: ../product-list.php?id=".$product_id);
}catch (PDOException $e){
    echo "資料移除錯誤: ".$e->getMessage();
}
?>
