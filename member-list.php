<?php
require_once("./method/pdo-connect.php");
require_once("./public/admin-if-login.php");

$sqlMember = "SELECT * FROM member WHERE member_valid=1";
$stmtMember = $db_host->prepare($sqlMember);

try {
    $stmtMember->execute([]);
    $rowMember = $stmtMember->fetchAll(PDO::FETCH_ASSOC);
    $totalMember = $stmtMember->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}

// 如果有搜尋
if (isset($_GET["search"]) && ($_GET["search"] != "")) {
    $search = $_GET["search"];
    $sqlMember = "SELECT * FROM member WHERE member_name LIKE '%$search%' AND member_valid=1";
    $stmtMember = $db_host->prepare($sqlMember);
} else {
    //如果沒有搜尋就顯示分頁
    if (isset($_GET["p"])) {
        $p = $_GET["p"];
    } else {
        $p = 1;
    }
    $pageItems = 5;
    $startItem = ($p - 1) * $pageItems;

    //計算總頁數
    $pageCount = $totalMember / $pageItems;


    //取餘數
    $pageR = $totalMember % $pageItems;


    $startNo = ($p - 1) * $pageItems + 1;
    $endNo = $p * $pageItems;

    if ($pageR !== 0) {
        $pageCount = ceil($pageCount); //如果不=0無條件進位
        if ($pageCount == $p) {
            $endNo = $endNo - ($pageItems - $pageR);
        }
    }
    //    有限制筆數的語句
    $sqlMember = "SELECT * FROM member WHERE member_valid=1 LIMIT $startItem, $pageItems";
    //    準備好語句
    $stmtMember = $db_host->prepare($sqlMember);
}
//最後執行
try {
    $stmtMember->execute([]);
    $rowMember = $stmtMember->fetchAll(PDO::FETCH_ASSOC);
    $memberRows= $stmtMember->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Member List</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php require_once("./public/css.php") ?>

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
            <div class="col-lg-9 d-flex justify-content-between align-items-center button-group shadow-sm">
                <div class="d-flex">
                    <a role="button" class="btn btn-primary me-2" href="member-list.php"><i class="fas fa-home"></i> 回起始列表</a>
                    <a role="button" href="./member-create.php" class="btn btn-primary"><i class="fas fa-plus"></i> 新增會員</a>
                </div>
                <form action="member-list.php" method="get">
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" name="search" value="<?php if (isset($search)) echo $search; ?>" placeholder="請輸入搜尋姓名">
                        <!--                        <button class="btn btn-secondary text-nowrap">搜尋</button>-->
                        <button class="btn btn-primary text-nowrap">搜尋</button>
                    </div>
                </form>
            </div>
            <!--            <form action="member-list.php" method="get">-->
            <article class="article col-lg-9 shadow-sm table-responsive">
                <!--content-->
                <div class="table-wrap">
                    <?php if ($memberRows > 0) : ?>
                        <table class="table table-control table-striped align-middle my-3">
                            <thead>
                                <tr>
                                    <th>查看</th>
                                    <th>照片</th>
                                    <th>姓名</th>
                                    <th>性別</th>
                                    <th>電話</th>
                                    <th>信箱</th>
                                    <th>地址</th>
                                    <th>建立時間</th>
                                    <th>編輯</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rowMember as $value) : ?>
                                    <tr>
                                        <td>
                                            <a role="button" href="./member-content.php?member_id=<?= $value["member_id"] ?>" class="ps-2"><i class="fas fa-search"></i></a>
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <img class="cover-fit member-photo" src="./images/member/<?= $value["member_photo"] ?>">
                                        </td>
                                        <td><?= $value["member_name"] ?></td>
                                        <td><?= $value["member_gender"] ?></td>
                                        <td><?= $value["member_phone"] ?></td>
                                        <td><?= $value["member_email"] ?></td>
                                        <td><?= $value["member_address"] ?></td>
                                        <td><?= $value["member_created_at"] ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <a role="button" href="member-edit.php?member_id=<?= $value["member_id"] ?>"><i class="fas fa-edit"></i></a>
                                                <div>&nbsp;/&nbsp;</div>
                                                <a role="button" href="./method/doDeleteMember.php?member_id=<?= $value["member_id"] ?>" onclick="javascript:return del();"><i class="fas fa-trash-alt"></i></a>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div>
                        <!--如果有分頁要顯示目前筆數-->
                        <?php if (isset($p)): ?>
                            <div class="py-2">共 <?= $totalMember ?> 筆</div>
                        <?php else: ?>
                            <div class="py-2">共 <?= $memberRows ?> 筆</div>
                        <?php endif; ?>
                    </div>
                    <!--        如果使用搜尋功能因為沒有p pagaCount會跑出來有問題 所以加上判斷 有p才出現這個UI-->
                    <?php if (isset($p)): ?>
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="member-list.php?p=1">第一頁</a></li>
                                <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                <!--當下頁數跟頁碼相同時echo active 寫在li class裡面-->
                                <li class="page-item <?php if ($p == $i) echo "active" ?>">
                                    <a class="page-link" href="member-list.php?p=<?= $i ?>"><?= $i ?></a></li>
                                    <?php endfor; ?>
                                    <li class="page-item"><a class="page-link" href="member-list.php?p=<?= $pageCount ?>">最末頁</a></li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                    <?php else : ?>
                        沒有會員資料
                    <?php endif; ?>
                </div>
                <!--content-->
            </article>
            <!--</form>-->
        </div>
    </div>
</body>


<script>
    // let notice=document.querySelector("#notice");
    // notice.onclick=function(){
    //     confirm();
    // }

    function del() {
        var msg = "確定要刪除嗎？\n\n請確認！";
        if (confirm(msg) == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

</html>