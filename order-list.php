<!--區間篩選待加js判斷star<end-->
<!--整份有分頁，篩選無分頁-->

<!--"訂單編號"篩選是單獨的。-->
<!--"時間區間"篩選可以是單獨的。-->
<!--"訂單狀態"篩選可以是單獨的。-->
<!--"訂單狀態"能再篩選"時間區間"-->
<!--"時間區間"不能再篩選"訂單狀態"-->

<?php
require_once("./method/pdo-connect.php");
require_once("./public/admin-if-login.php");
$MaxEndDate = date("Y/m/d"); //可以調整區間預設的$endDate

//搜尋：訂單編號
if (isset($_GET["order_id"])) {
    $filter_totalCount=0;
    $order_id = $_GET["order_id"];
    $sqlOrderList = "SELECT * FROM order_list WHERE id='$order_id'";
    $stmtOrderList = $db_host->prepare($sqlOrderList);
    try {
        $stmtOrderList->execute();
        $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
        $orderCount = $stmtOrderList->rowCount();
//        echo "order if"."<br>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    $filter_totalCount=1;
    $sqlOrderList = "SELECT * FROM order_list ORDER BY id ASC";
    $stmtOrderList = $db_host->prepare($sqlOrderList);
    try {
        $stmtOrderList->execute();
        $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
        $totalOrderCount = $stmtOrderList->rowCount();
//        echo "else"."<br>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    //分頁
    if (isset($_GET["p"])) {
        $p = $_GET["p"];
    } else {
        $p = 1;
    }
    $pageItems = 8;
    $startItem = ($p - 1) * $pageItems;
    $pageCount = $totalOrderCount / $pageItems; //頁數(可能非整數，要再下條件)
    $pageR = $totalOrderCount % $pageItems; //餘數
    $startNo=($p-1)*$pageItems+1; //第二頁第一筆
    $endNo=$p*$pageItems;
    if ($pageR != 0) {
        $pageCount = ceil($pageCount); //如果餘數不為0，則無條件進位 3
        if($pageCount==$p){
            $endNo=$endNo-($pageItems-$pageR);
        }
    }
    $sqlOrderList = "SELECT * FROM order_list ORDER BY id ASC LIMIT $startItem, $pageItems";
    $stmtOrderList = $db_host->prepare($sqlOrderList);
    try {
        $stmtOrderList->execute();
        $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
        $orderCount = $stmtOrderList->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//    篩選訂單編號後，清除篩選要顯示完整清單！empty() 但非0
if (isset($order_id)) {

} else {
    $order_id = 0;
}
if (empty($_GET["order_id"]) && $order_id !== "0")  {
    $filter_totalCount=1;
    $sqlOrderList = "SELECT * FROM order_list ORDER BY id ASC";
    $stmtOrderList = $db_host->prepare($sqlOrderList);
    try {
        $stmtOrderList->execute();
        $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
        $totalOrderCount = $stmtOrderList->rowCount();
//        echo "empty_order"."<br>";
        //分頁
        if (isset($_GET["p"])) {
            $p = $_GET["p"];
        } else {
            $p = 1;
        }
        $pageItems = 8;
        $startItem = ($p - 1) * $pageItems;
        $pageCount = $totalOrderCount / $pageItems; //頁數(可能非整數，要再下條件)
        $pageR = $totalOrderCount % $pageItems; //餘數
        $startNo=($p-1)*$pageItems+1; //第二頁第一筆
        $endNo=$p*$pageItems;
        if ($pageR != 0) {
            $pageCount = ceil($pageCount); //如果餘數不為0，則無條件進位 3
            if($pageCount==$p){
                $endNo=$endNo-($pageItems-$pageR);
            }
        }
        $sqlOrderList = "SELECT * FROM order_list ORDER BY id ASC LIMIT $startItem, $pageItems";
        $stmtOrderList = $db_host->prepare($sqlOrderList);
        try {
            $stmtOrderList->execute();
            $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
            $orderCount = $stmtOrderList->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        // 檢查是否有區間篩選
        if (isset($_GET["startDate"])) {
            $filter_totalCount=0;
            $startDate = $_GET["startDate"];
            if (isset($_GET["endDate"]) && $_GET["endDate"]!==""){
                $endDate = $_GET["endDate"];
            }else{
//                echo "抓到";
                $endDate = $MaxEndDate;
            }
            $sqlOrderList = "SELECT * FROM order_list WHERE DATE(order_time) BETWEEN ? AND ? ORDER BY id ASC";
            $stmtOrderList = $db_host->prepare($sqlOrderList);
            try {
                $stmtOrderList->execute([$startDate, $endDate]);
                $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
                $orderCount = $stmtOrderList->rowCount();
//                echo "empty_order +區間"."<br>";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        //檢查是否有區間篩選及訂單狀態篩選
        }else if(isset($_GET["startDate"]) && isset($_GET["status"])) {
            $filter_totalCount=0;
            $startDate = $_GET["startDate"];
            if (isset($_GET["endDate"]) && $_GET["endDate"]!==""){
                $endDate = $_GET["endDate"];
            }else{
//                echo "抓到";
                $endDate = $MaxEndDate;
            }
            $status=$_GET["status"];
            $sqlOrderList = "SELECT * FROM order_list WHERE status='$status' AND DATE(order_time) BETWEEN ? AND ? ORDER BY id ASC";
            $stmtOrderList = $db_host->prepare($sqlOrderList);
            try {
                $stmtOrderList->execute([$startDate, $endDate]);
                $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
                $orderCount = $stmtOrderList->rowCount();
//                echo "empty_order 狀態+區間"."<br>";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//訂單狀態篩選
if (isset($_GET["status"])){
    $filter_totalCount=0;
    $status=$_GET["status"];
    $sqlOrderList = "SELECT * FROM order_list WHERE status=?";
    $stmtOrderList = $db_host->prepare($sqlOrderList);
    try {
        $stmtOrderList->execute([$status]);
        $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
        $orderCount = $stmtOrderList->rowCount();
//        echo "status"."<br>";
        $pageCount = 0;  //非正確之道！暫時如此！不顯示頁碼
        // 檢查是否有區間篩選
        if (isset($_GET["startDate"])) {
            $filter_totalCount=0;
            $startDate = $_GET["startDate"];
            if (isset($_GET["endDate"]) && $_GET["endDate"]!==""){
                $endDate = $_GET["endDate"];
//                echo "$endDate";
            }else{
//                echo "抓到";
//                $endDate = $MaxEndDate;
            }
            $sqlOrderList = "SELECT * FROM order_list WHERE status='$status' AND DATE(order_time) BETWEEN ? AND ? ORDER BY id ASC";
            $stmtOrderList = $db_host->prepare($sqlOrderList);
            try {
                $stmtOrderList->execute([$startDate, $endDate]);
                $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
                $orderCount = $stmtOrderList->rowCount();
//                echo "status if +區間";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// 篩選status後，網址仍有status，為isset()，但empty()
//如果網址存在order_id，不繼續檢視status的empty()
if (isset($status)) {

} else {
    $status = 0;
}
if (isset($_GET["order_id"])){

}else if(empty($_GET["status"])){
    $filter_totalCount=1;
    $sqlOrderList = "SELECT * FROM order_list ORDER BY id ASC";
    $stmtOrderList = $db_host->prepare($sqlOrderList);
    try {
        $stmtOrderList->execute();
        $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
        $totalOrderCount = $stmtOrderList->rowCount();
//        echo "empty_status"."<br>";
        //分頁
        if (isset($_GET["p"])) {
            $p = $_GET["p"];
        } else {
            $p = 1;
        }
        $pageItems = 8;
        $startItem = ($p - 1) * $pageItems;
        $pageCount = $totalOrderCount / $pageItems; //頁數(可能非整數，要再下條件)
        $pageR = $totalOrderCount % $pageItems; //餘數
        $startNo=($p-1)*$pageItems+1; //第二頁第一筆
        $endNo=$p*$pageItems;
        if ($pageR != 0) {
            $pageCount = ceil($pageCount); //如果餘數不為0，則無條件進位 3
            if($pageCount==$p){
                $endNo=$endNo-($pageItems-$pageR);
            }
        }
        $sqlOrderList = "SELECT * FROM order_list ORDER BY id ASC LIMIT $startItem, $pageItems";
        $stmtOrderList = $db_host->prepare($sqlOrderList);
        try {
            $stmtOrderList->execute();
            $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
            $orderCount = $stmtOrderList->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        // 檢查是否有區間篩選
        if (isset($_GET["startDate"])) {
            $filter_totalCount=0;
            $startDate = $_GET["startDate"];
            if (isset($_GET["endDate"]) && $_GET["endDate"]!==""){
                $endDate = $_GET["endDate"];
//                echo "$endDate";
            }else{
//                echo "抓到";
//                $endDate = $MaxEndDate;
            }
            $sqlOrderList = "SELECT * FROM order_list WHERE DATE(order_time) BETWEEN ? AND ? ORDER BY id ASC";
            $stmtOrderList = $db_host->prepare($sqlOrderList);
            $pageCount = 0;  //非正確之道！暫時如此！不顯示頁碼
            try {
                $stmtOrderList->execute([$startDate, $endDate]);
                $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
                $orderCount = $stmtOrderList->rowCount();
//                echo "empty_status if +區間";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>


<!doctype html>
<html lang="en">
<head>
    <title>Order List</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>

    <style>
        body {
            font-size: 15px;
        }
        .form-control {
            width: 136px;
            height: 37px;
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
        <div class="col-lg-9 shadow-sm button-group py-2 ps-4 pe-3">
            <div class="d-flex justify-content-between">
                <div class="pt-2">
                    <a role="button" class="btn btn-primary" href="order-list.php"><i class="fas fa-home"></i> 回起始列表</a>
                </div>
                <form action="order-list.php" method="get">
                    <div class="d-flex justify-content-end align-items-center pt-2">
                        <div class="d-flex align-items-center">
                            <label for="order_id" class="d-block me-0">訂單編號</label>
                            <div class="me-2"></div>
                            <input type="number" class="form-control me-2" id="order_id" name="order_id"
                                   value="<?= $order_id ?>">
                            <button type="submit" class="btn btn-primary text-nowrap">篩選</button>
                        </div>
                    </div>
                </form>
            </div>
            <form action="order-list.php" method="get">
                    <div class="d-flex justify-content-end align-items-center pt-2">
                        <div class="d-flex align-items-center">
                            <label for="status" class="d-block me-2">訂單狀態</label>
                            <div class="me-2">
                                <select id="status" class="form-select me-2" aria-label="status select" name="status">
                                    <option value="訂單處理中" <?php if ($status==="訂單處理中")echo "selected" ?>>訂單處理中</option>
                                    <option value="訂單已完成" <?php if ($status==="訂單已完成")echo "selected" ?>>訂單已完成</option>
                                    <option value="訂單已取消" <?php if ($status==="訂單已取消")echo "selected" ?>>訂單已取消</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary text-nowrap">篩選</button>
                        </div>
                    </div>
            </form>

            <form action="order-list.php" method="get">
                    <div class="my-2 d-flex justify-content-end align-items-center">
                            <div class="d-flex align-items-center">
<!--                                <input type="hidden" name="order_id" value="--><?//= $order_id ?><!--">-->
                                <input type="hidden" name="status" value="<?= $status ?>">
                                <input type="date" class="form-control me-2" name="startDate"
                                       value="<?php if (isset($startDate)) echo $startDate; ?>">
                                <div class="me-2">~</div>
                                <input type="date" class="form-control me-2" name="endDate"
                                       value="<?php if (isset($endDate)) echo $endDate; ?>">
                                <button type="submit" class="btn btn-primary text-nowrap">篩選</button>
                            </div>
                    </div>
            </form>
        </div>
        <article class="article col-lg-9 shadow-sm table-responsive px-3 py-2">
            <div class="table-wrap">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr class="text-nowrap">
                        <th>查看內容</th>
                        <th>修改訂單</th>
                        <th>訂單編號</th>
                        <th>會員編號</th>
                        <th>訂單總金額</th>
                        <th>付款方式</th>
                        <th>付款狀態</th>
                        <th>送貨方式</th>
                        <th>收件人姓名</th>
                        <th>收件人電話</th>
                        <th>收件人地址</th>
                        <th>收件超商門市</th>
                        <th>訂單狀態</th>
                        <th>訂單日期</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rowOrderList as $value): ?>
                        <tr class="text-nowrap">
                            <td><a href="order-detail.php?order_id=<?= $value["id"] ?>"><i class="fas fa-search"></i></a></td>
                            <td><a href="order-edit.php?order_id=<?= $value["id"] ?>"><i class="fas fa-edit"></i></a> &nbsp/&nbsp
                                <a onclick="javascript:return del();" href="./method/doDeleteOrder.php?order_id=<?= $value["id"] ?>"><i class="fas fa-trash-alt"></i></a></td>
                            <td><?= $value["id"] ?></td>
                            <td><?= $value["member_id"] ?></td>
                            <td class="text-end">$ <?= $value["amount"] ?></td>
                            <td><?= $value["payment"] ?></td>
                            <td><?= $value["payment_status"] ?></td>
                            <td><?= $value["delivery"] ?></td>
                            <td><?= $value["receiver"] ?></td>
                            <td><?= $value["receiver_phone"] ?></td>
                            <td><?= $value["address"] ?></td>
                            <td><?= $value["convenient_store"] ?></td>
                            <td><?= $value["status"] ?></td>
                            <td><?= $value["order_time"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if ($filter_totalCount=='1'):?>
                <div class="py-3 ps-4">共 <?=$totalOrderCount?> 筆</div>
            <?php endif; ?>
            <?php if(isset($p)): ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if ($filter_totalCount=='1'):?>
                            <li class="page-item"><a class="page-link" href="order-list.php?p=1">第一頁</a></li>
                        <?php endif; ?>
                        <?php for($i=1; $i<$pageCount+1; $i++): ?>
                            <li class="page-item <?php if($p==$i)echo "active" ?>"><a class="page-link" href="order-list.php?p=<?=$i?>"><?=$i?></a></li>
                        <?php endfor; ?>
                        <?php if ($filter_totalCount=='1'):?>
                            <li class="page-item"><a class="page-link" href="order-list.php?p=<?= $pageCount ?>">最末頁</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
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

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

    <script>
        function del() {
            var msg = "您確定要刪除此筆訂單嗎？";
            if (confirm(msg)==true){
                return true;
            }else{
                return false;
            }
        }
    </script>
</body>
</html>