<?php
require_once("db-connect.php");  //連接資料庫
// exit();  //讓程式結束不要往下跑
$product_name=$_POST["product_name"];
$product_item=$_POST["product_item"];
$big_cat_id=$_POST["big_cat_id"];
$small_cat_id=$_POST["small_cat_id"];
$product_image=$_POST["product_image"];
$color_id=$_POST["color_id"];
$product_size=$_POST["product_size"];
$product_describe=$_POST["product_describe"];
$product_price=$_POST["product_price"];
$product_stock=$_POST["product_stock"];
// $product_create_time=$_POST["product_create_time"];
$product_valid=1; //正式專案都要記得加程式碼做 ”後台檢查驗證“！！！


$now=date("Y-m-d H:i:s");   //取得現在日期時間
echo $now."<br>";
// exit();  //讓程式結束不要往下跑

//新增資料
$sql="INSERT INTO products(product_name, product_item, big_cat_id, small_cat_id, product_image, color_id, product_size, product_describe, product_price, product_stock, product_create_time, product_valid) VALUES('$product_name', '$product_item', '$big_cat_id', '$small_cat_id', '$product_image', '$color_id', '$product_size', '$product_describe', '$product_price', '$product_stock', '$now', '$product_valid')";            
 //就算填入變數$now也要加' '

//VALUES('嗨', '123x', '1', '2', 'lll.jpg', '5', 'xl', '我快發瘋', '1000', '20', '$now', '1')"; 

//執行
if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;  //取得最新一筆資料的 id
		echo "新資料輸入成功<br>";
		// header("location: ../product-edit.php?id=".$last_id);    //讓頁面馬上跳到商品更新頁面
		header("location: ../product-list.php?");    //讓頁面馬上跳到商品清單頁面
}
else {
    	echo "新增資料錯誤: " . $conn->error;
}


?>