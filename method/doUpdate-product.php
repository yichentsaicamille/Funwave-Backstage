<?php
require_once("pdo-connect.php");  //連接資料庫
echo "<br>------------------------------------------<br>";

// f(!get_magic_quotes_gpc()){
//     手動跳脫
// };
// exit();

$product_id=$_POST["product_id"];
$product_name=$_POST["product_name"];
$product_item=$_POST["product_item"];
$big_cat_id=$_POST["big_cat_id"];
// $bigcatChange=$_POST["big_cat_id"];
// $bigcatChange=$_POST["big_cat"];
$small_cat_id=$_POST["small_cat_id"];
// $smallcatChange=$_POST["small_cat_id"];
// $smallcatChange=$_POST["small_cat"];

//處理前台會遇到選單預設不帶入原圖片值(ex:longboard001.jpg)，而傳送到資料庫以空值取代原圖片值的問題的問題<STEP1>
if(!empty($_POST["product_image"])){         
    $product_image=$_POST["product_image"];
};
// else{

// }
$color_id=$_POST["color_id"];
// $colorChange=$_POST["color_id"];
// $colorChange=$_POST["color"];
$product_size_change=$_POST["product_size"];

$product_size = addslashes($product_size_change);

$product_describe_change=$_POST["product_describe"];
$product_describe = addslashes($product_describe_change);

$product_price=$_POST["product_price"];
$product_stock=$_POST["product_stock"];
// $product_create_time=$_POST["product_create_time"];
$product_valid=1; //正式專案都要記得加程式碼做 ”後台檢查驗證“！！！

//處理前台會遇到選單預設帶入值為字串(ex:衝浪板)，而因型別(ex:big_cat_id為INT1,2,3)不同不能傳送到資料庫的問題<STEP2>
// switch ($bigcatChange)                
// {
// case $bigcatChange==="衝浪板":
// 	$big_cat_id=1 ;
// 	break;  
// case $bigcatChange==="衝浪板配件":
// 	$big_cat_id=2 ;
// 	break;
// case $bigcatChange==="海灘配件":
// 	$big_cat_id=3 ;
// 	break;
// 	default: $big_cat_id=$bigcatChange;
// }

// switch ($smallcatChange)                
// {
// case $smallcatChange==="長板":
// 	$small_cat_id=1 ;
// 	break;  
// case $smallcatChange==="短板":
// 	$small_cat_id=2 ;
// 	break;
// case $smallcatChange==="快樂板":
// 	$small_cat_id=3 ;
// 	break;
// case $smallcatChange==="衝浪板舵":
// 	$small_cat_id=4 ;
// 	break;  
// case $smallcatChange==="衝浪腳繩":
// 	$small_cat_id=5;
// 	break;
// case $smallcatChange==="防滑墊":
// 	$small_cat_id=6 ;
// 	break;
// case $smallcatChange==="衝浪板袋":
// 	$small_cat_id=7 ;
// 	break;  
// case $smallcatChange==="衝浪T":
// 	$small_cat_id=8 ;
// 	break;
// case $smallcatChange==="帽子":
// 	$small_cat_id=9 ;
// 	break;
// 	default: $small_cat_id=$smallcatChange;
// }

// switch ($colorChange)                
// {
// case $colorChange==="紅色":
// 	$color_id=1 ;
// 	break;  
// case $colorChange==="橙色":
// 	$color_id=2 ;
// 	break;
// case $colorChange==="黃色":
// 	$color_id=3 ;
// 	break;
// case $colorChange==="綠色":
// 	$color_id=4 ;
// 	break;  
// case $colorChange==="藍色":
// 	$color_id=5 ;
// 	break;
// case $colorChange==="紫色":
// 	$color_id=6 ;
// 	break;
// case $colorChange==="灰色":
// 	$color_id=7 ;
// 	break;  
// case $colorChange==="黑色":
// 	$color_id=8 ;
// 	break;
// case $colorChange==="白色":
// 	$color_id=9 ;
// 	break;
// 	default: $color_id=$colorChange;
// }

// var_dump($bigcatChange);
// var_dump($big_cat_id);
// var_dump($smallcatChange);
// var_dump($small_cat_id);
// var_dump($colorChange);
// var_dump($color_id);


$now=date("Y-m-d H:i:s");   //取得現在日期時間
echo $now."<br>------------------------------------------<br>";
// exit();  //讓程式結束不要往下跑

//處理前台會遇到選單預設不帶入原圖片值(ex:longboard001.jpg)，而傳送到資料庫以空值取代原圖片值的問題的問題<STEP2>
if(!empty($_POST["product_image"])){         
    //撈資料存在$sql
    $sql="UPDATE products SET product_name='$product_name', product_item='$product_item', big_cat_id='$big_cat_id', small_cat_id='$small_cat_id', product_image='$product_image',color_id='$color_id', product_size='$product_size', product_describe='$product_describe', product_price='$product_price', product_stock='$product_stock', product_create_time=`$now` WHERE product_id='$product_id'";   //WHERE id='$id' 看你要修改的是哪一筆資料
}
else{
    $sql="UPDATE products SET product_name='$product_name', product_item='$product_item', big_cat_id='$big_cat_id', small_cat_id='$small_cat_id', color_id='$color_id', product_size='$product_size', product_describe='$product_describe', product_price='$product_price', product_stock='$product_stock', product_create_time='$now' WHERE product_id='$product_id'";   //WHERE id='$id' 看你要修改的是哪一筆資料
}


echo $sql."<br>------------------------------------------<br>";   //看看帶了哪些值過來，確定有沒有帶到id

// exit();     //讓程式結束不要往下跑

//準備資料
$stmt=$db_host->prepare($sql);
var_dump($stmt);
echo "<br>------------------------------------------<br>";
// exit();  //讓程式結束不要往下跑


//執行
try{
    $stmt->execute();
    $dataCount=$stmt->rowCount();
    echo "修改資料完成";
    header("location: ../product-list.php");
}catch (PDOException $e){
    echo "修改資料錯誤: ".$e->getMessage();
}



?>
