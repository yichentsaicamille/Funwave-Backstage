<!--是否需要在資料表order-detail添加會員編號欄位。圖片路徑待添加-->
<?php
require_once("./method/pdo-connect.php");
require_once("./public/admin-if-login.php");
$order_id = $_GET["order_id"]; //order id
$sqlOrder = "SELECT * FROM order_list WHERE id=?";
$stmtOrder = $db_host->prepare($sqlOrder);
try {
    $stmtOrder->execute([$order_id]);
    $rowOrder = $stmtOrder->fetch();
} catch (PDOException $e) {
    echo "取得訂單資訊錯誤<br>";
    echo $e->getMessage();
}

//join:user_order_detail、products
$sqlOrderProducts = "SELECT order_details.*, products.*
FROM order_details
JOIN products ON order_details.product_id = products.product_id 
WHERE order_details.order_id=?";
$stmtOrderProducts = $db_host->prepare($sqlOrderProducts);
try {
    $stmtOrderProducts->execute([$order_id]);
    $rowsOrderProducts = $stmtOrderProducts->fetchAll(PDO::FETCH_ASSOC);
//    var_dump($rowsOrderProducts);
} catch (PDOException $e) {
    echo "取得訂單細節錯誤<br>";
    echo $e->getMessage();
}
?>


<!doctype html>
<html lang="en">
<head>
    <title>Order detail</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>

    <style>
        th{
            max-width: 40px;
        }
        th3{
            max-width: 60px;
        }
        td{
            max-width: 60px;
            word-wrap: break-word;
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
        <div class="col-9 d-flex justify-content-between align-items-center button-group shadow-sm">
            <div>
                <a role="button" href="order-list.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-lg-9 shadow-sm table-responsive px-3 py-2">
            <!--content-->
            <div class="table-wrap">
                <table class="table table-bordered table-sm text-center">
                    <thead>
                    <tr>
                        <th>訂單編號</th>
                        <th>產品編號</th>
                        <th class="th3">產品名稱</th>
                        <th class="th3">產品圖片</th>
                        <th>單價</th>
                        <th>數量</th>
                        <th>小計</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total=0;
                    foreach ($rowsOrderProducts as $value):
                        ?>
                        <tr>
                            <td><?= $order_id ?></td>
                            <td><?= $value["product_id"] ?></td>
                            <td><?= $value["product_name"] ?></td>
                            <td>
                                <div class="ratio ratio-1x1">
                                    <img class="cover-fit" src="images/product/<?=$value["product_image"]?>" alt="product image">
                                </div>
                            </td>
                            <td class="text-end">$<?= $value["product_price"] ?></td>
                            <td class="text-end"><?= $value["quantity"] ?></td>
                            <td class="text-end"><?php
                                $subtotal = $value["quantity"] * $value["product_price"];
                                echo "$" . $subtotal;
                                $total += $subtotal;
                                ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="fw-bold">總計</td>
                        <td class="text-end" colspan="6">$<?= $total ?></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </article>
    </div>
</div>


<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>