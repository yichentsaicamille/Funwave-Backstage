<!--fontawesome先自行帶-->
<?php
require_once("pdo-connect.php");
require_once("../public/if-login.php");

//提取order-list的最新的id，以修改其付款狀態
$sqlOrderList="SELECT * FROM order_list";
$stmtOrderList=$db_host->prepare($sqlOrderList);
try{
    $stmtOrderList->execute();
    $rowOrderList=$stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
    $orderCount=$stmtOrderList->rowCount();
}catch (PDOException $e){
    echo $e->getMessage();
}
$order_id=$rowOrderList[$orderCount-1]['id'];

//回頭修改order_list的資料付款狀態
$payment_status='已付款';
$sqlOrderList="UPDATE order_list SET payment_status='$payment_status' WHERE id='$order_id'";
$stmtOrderList=$db_host->prepare($sqlOrderList);
try{
    $stmtOrderList->execute();
    $orderCount=$stmtOrderList->rowCount();
//    echo "修改資料完成";
}catch (PDOException $e){
    echo "修改資料錯誤: ".$e->getMessage();
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>Cart checkout</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("../public/css.php") ?>
    <!-- fontawesome -->
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.css">

    <style>
        body {
            background: #f3f3f3;
        }
        .header {
            padding-left: 0px;
            padding-right: 0px;
        }
        .article {
            background: #fff;
            margin: 100px auto;
            padding: 0px 10px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row wrap d-flex justify-content-center align-items-center">
    <?php require_once("../public/cart_header.php") ?>
        </aside>
        <article class="article col-lg-7 shadow-sm d-flex justify-content-center align-items-center p-5 mt">
            <div class="">
                <div class="text-center d-block">
                    <i class="fas fa-check-circle fa-5x mt-5 mb-4 text-success"></i>
                    <h3 class="mb-2">付款成功!</h3>
                    <h3 class="mb-5">訂單已送出!</h3>
                </div>
            </div>
        </article>
    </div>
</div>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

</body>
</html>