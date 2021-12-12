<?php
require_once ("./method/pdo-connect.php");

$order_id=$_POST["order_id"];
$payment=$_POST["payment"];
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
$payment=$_POST["payment"];
$payment_status=$_POST["payment_status"];
$status=$_POST["status"];

$sqlOrderList="UPDATE order_list SET delivery='$delivery', receiver='$receiver', receiver_phone='$receiver_phone', address='$address', convenient_store='$convenient_store', status='$status', payment='$payment', payment_status='$payment_status'  WHERE id='$order_id'";
$stmtOrderList=$db_host->prepare($sqlOrderList);
//var_dump($stmtOrderList);
try{
    $stmtOrderList->execute();
    $orderCount=$stmtOrderList->rowCount();
//     echo "修改資料完成";
//    header("location: ../order-list.php");
}catch (PDOException $e){
    echo "修改資料錯誤: ".$e->getMessage();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>doUpdateOrder</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>
    <style>
        .top-ipt-group {
            padding-left: 0px;
            padding-right: 0px;
        }
    </style>

</head>
<body>
<div class="container-fluid">
    <div class="row wrap d-flex">
        <?php require_once("./public/admin-header-logined.php"); ?>
        <!--menu-->
        <aside class="col-lg-2 navbar-side shadow-sm">
            <?php require_once("./public/nav.php") ?>
        </aside>
        <!--/menu-->
        <article class="article col-lg-7 shadow-sm d-flex justify-content-center align-items-center p-5 mt-5">
            <div class="">
                <div class="text-center d-block">
                    <i class="fas fa-check-circle fa-5x mt-5 mb-4 text-success"></i>
                    <h3 class="mb-5">訂單已修改!</h3>
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
