<?php
require_once ("pdo-connect.php");
//用session帶購物車資訊(product_id)結合products，以取得product_price
$productId = array_column($_SESSION['cart'], "product_id");
//var_dump($productId);
$sql = "SELECT * FROM products where product_id in (" . implode(',', $productId) . " ) AND product_valid = 1 ORDER BY product_id DESC";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();



//新增資料進order_list
$member_id='888'; //還沒做會員用假資料(admin->888)
$amount='0'; //待完成！
$payment=$_POST["payment"];
$payment_status='未付款'; //待調整
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

$sqlOrder="INSERT INTO order_list(member_id , amount, payment, payment_status, delivery, receiver, receiver_phone, address, convenient_store, status, order_time) VALUES('$member_id' , '$amount', '$payment', '$payment_status', '$delivery', '$receiver', '$receiver_phone', '$address', '$convenient_store', '$status', '$order_time')";
$stmtOrder=$db_host->prepare($sqlOrder);
try{
    $stmtOrder->execute();
    $rowOrder = $stmtOrder->fetchAll(PDO::FETCH_ASSOC);
    $orderCount = $stmtOrder->rowCount();
    echo "建立order-list資料完成";
    echo '<br>';
//    var_dump($payment);
    if ($payment=="信用卡"){
//        header("location: doCreditCard.php");
    }else{
//        header("location: ../product-list.php");
    }
}catch (PDOException $e){
    echo "建立order-list資料錯誤: ".$e->getMessage();
}


//提取order-list的最新的id，給order-detail用
$sqlOrderList="SELECT * FROM order_list";
$stmtOrderList=$db_host->prepare($sqlOrderList);
try{
    $stmtOrderList->execute();
    $rowOrderList=$stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
    $orderCount=$stmtOrderList->rowCount();
}catch (PDOException $e){
    echo $e->getMessage();
}

//提取session的product_id對應的quantity，給order-detail用
$cart_id_quantity=array_column($_SESSION['cart'], 'quantity', 'product_id');
//var_dump($cart_id_quantity);
//echo '<br>';

//新增資料進order_details
$total=0;
foreach ($products as $product):
    echo $product['product_id'];
    $order_id=$rowOrderList[$orderCount-1]['id'];
    $product_id=$product['product_id'];
    $quantity=$cart_id_quantity[$product_id];
    $sqlOrderDetail="INSERT INTO order_details(order_id, product_id, quantity) VALUES('$order_id' , '$product_id', '$quantity')";
    $stmtOrderDetail=$db_host->prepare($sqlOrderDetail);
    //提取session的product_id對應的"quantity"，用session的product_id結合products以取得"product_price"，計算小計"subtotal"，再算得"total"，給order-list用
    $product_price=(int) $product['product_price'];
    $subtotal=$quantity*$product_price;
//    var_dump($product_price);
//    echo '<br>';
//    var_dump($subtotal);
//    echo '<br>';
    $total+=$subtotal;
//    echo '<br>';
//    var_dump($total);
//    echo '<br>';

    try{
        $stmtOrderDetail->execute();
        $rowOrderDetail = $stmtOrderDetail->fetchAll(PDO::FETCH_ASSOC);
        $orderDetailCount = $stmtOrderDetail->rowCount();
        echo "建立order-detail資料完成";
        echo '<br>';
    }catch (PDOException $e){
        echo "建立order-detail資料錯誤: ".$e->getMessage();
    }

endforeach;
$myArr4[0]=$order_id;
$myArr4[1]=$total;
print_r($myArr4);
print_r($myArr4[1]);

//修改order_list的資料amount
$sqlOrderList="UPDATE order_list SET amount='$total' WHERE id='$order_id'";
$stmtOrderList=$db_host->prepare($sqlOrderList);
try{
    $stmtOrderList->execute();
    $orderCount=$stmtOrderList->rowCount();
    echo "修改資料完成";
}catch (PDOException $e){
    echo "修改資料錯誤: ".$e->getMessage();
}
?>
