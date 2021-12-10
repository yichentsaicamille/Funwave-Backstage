
<?php
require_once ("pdo-connect.php");

//用session帶入購物車資訊(product_id、product_price)，再重新取得數量、小計、總計？？？？（數量在cart上，只有小計總計能夠重算，數量一定要帶來 可否用session?）
$productId = array_column($_SESSION['cart'], "product_id");
$sql = "SELECT * FROM products where product_id in (" . implode(',', $productId) . " ) AND product_valid = 1 ORDER BY product_id DESC";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();

//撈出product_id要放入order-detail.php
foreach ($products as $product):
    echo $product['product_id'];
    $order_id='123';
    $product_id=$product['product_id'];
    $quantity='1';
    $sqlOrderDetail="INSERT INTO order_details(order_id, product_id, quantity) VALUES('$order_id' , '$product_id', '$quantity')";
    $stmtOrderDetail=$db_host->prepare($sqlOrderDetail);

    try{
        $stmtOrderDetail->execute();
        $order_details = $stmt->fetchAll();
        echo "建立order-detail資料完成";
    }catch (PDOException $e){
        echo "建立order-detail資料錯誤: ".$e->getMessage();
    }
endforeach;
var_dump($products);

$member_id='88';
$amount='0';
$payment=$_POST["payment"];
$payment_status='未付款';
$receiver=$_POST["receiver"];
$receiver_phone=$_POST["receiver_phone"];
$address=$_POST["address"];
$convenient_store=$_POST["convenient_store"];
if ($_POST["delivery"]==="#delivery1"):
    $delivery="宅配到府";
    $convenient_store="";
else:
    $delivery="超商取貨";
    $address="";
endif;
$status='訂單處理中';
$order_time=date("Y/m/d H:i:s");

$sqlOrderList="INSERT INTO order_list(member_id , amount, payment, payment_status, delivery, receiver, receiver_phone, address, convenient_store, status, order_time) VALUES('$member_id' , '$amount', '$payment', '$payment_status', '$delivery', '$receiver', '$receiver_phone', '$address', '$convenient_store', '$status', '$order_time')";
$stmtOrderList=$db_host->prepare($sqlOrderList);
try{
    $stmtOrderList->execute();
    $orderCount=$stmtOrderList->rowCount();
    echo "建立order-list資料完成";
    var_dump($payment);
    if ($payment=="信用卡"){
//        header("location: doCreditCard.php");
    }else{
//        header("location: ../product-list.php");
    }
}catch (PDOException $e){
    echo "建立order-list資料錯誤: ".$e->getMessage();
}
?>



