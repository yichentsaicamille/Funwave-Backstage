<?php
require_once("./method/pdo-connect.php");
$sql = "select * from coach inner join genre on genre.genre_id = coach.genre_id";
$stmt = $db_host->prepare($sql);

try {
    $stmt->execute();
//    $row = $stmt->fetch();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    $resultTotal=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $totalCoach = $stmt->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}

//如果有搜尋
if (isset($_GET["search"]) && ($_GET["search"] != "")) {
    $search = $_GET["search"];
    $sql = "select * from coach inner join genre on genre.genre_id = coach.genre_id WHERE coach_name LIKE '%$search%'";
    //  $sql = "SELECT * FROM coach WHERE coach_name LIKE '%$search%'";
    //準備好語句for搜尋框
    $result_query = $db_host->prepare($sql);
} else {
//如果沒有搜尋就顯示分頁

    if (isset($_GET["p"])) {
        $p = $_GET["p"];

    } else {
        $p = 1;

    }
    $pageItems = 10;
    $startItem = ($p - 1) * $pageItems;

//計算總頁數
    $pageCount = $totalCoach / $pageItems;


//取餘數
    $pageR = $totalCoach % $pageItems;


    $startNo = ($p - 1) * $pageItems + 1;
    $endNo = $p * $pageItems;

    if ($pageR !== 0) {
        $pageCount = ceil($pageCount);//如果不=0無條件進位
        if ($pageCount == $p) {
            $endNo = $endNo - ($pageItems - $pageR);
        }
    }

//    有限制筆數的語句
    $sql = "select * from coach inner join genre on genre.genre_id = coach.genre_id LIMIT $startItem, $pageItems";
//    準備好語句
    $result_query = $db_host->prepare($sql);

}

//最後執行
try {
    $result_query->execute();
    $rows = $result_query->fetchAll(PDO::FETCH_ASSOC);
    $coach_rows = $result_query->rowCount();

    //    echo $course_rows;
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>教練管理</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>
    <style>
        .date-table {
            max-width: 110px;
            min-width: 100px;
        }
        .expertise-width {
            width: 120px;
            min-width: 100px;
        }

        .address-width {
            width: 200px;
            min-width: 120px;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row wrap d-flex">
        <?php require_once("./public/header.php") ?>
        <!--menu-->
        <aside class="col-lg-2 navbar-side shadow-sm">
            <?php require_once("./public/nav.php") ?>
        </aside>
        <!--/menu-->
        <div class="col-lg-9 d-flex justify-content-between align-items-center button-group shadow-sm">
            <div>
                <a role="button" href="coach-create.php" class="btn btn-primary text-nowrap">新增</a>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <label for="" class="me-2">搜尋</label>
                <form action="coach.php" method="get">
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" name="search"
                               value="<?php if (isset($search)) echo $search; ?>">
                        <button class="btn btn-primary text-nowrap" type="submit">搜尋</button>
                    </div>
                </form>
            </div>
        </div>
        <article class="article col-lg-9 shadow-sm table-responsive">
            <!--content-->
            <div class="table-wrap">
                <?php if ($coach_rows > 0) :  ?>
                    <table class="table table-bordered align-middle text-center my-3">
                        <thead>
                        <tr>
                            <th>查看</th>
                            <th>照片</th>
                            <th>姓名</th>
                            <th>性別</th>
                            <th>專長</th>
                            <th>電話</th>
                            <th>信箱</th>
                            <th>地址</th>
                            <th class="date-table">建立時間</th>
                            <th>編輯</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rows as $value) :
                            ?>
                            <tr>
                                <td class="">
                                    <a role="button" href="coach-examine.php?id=<?= $value["coach_id"] ?>"
                                       class=""><i class="fas fa-search"></i></a>
                                </td>
                                <td>
                                    <img class="cover-fit photo-list" src="images/coach/<?= $value["coach_photo"] ?>">
                                </td>
                                <td><?= $value["coach_name"] ?></td>
                                <td><?= $value["gender"] ?></td>
                                <td class="expertise-width"><?= $value["coach_expertise"] ?></td>
                                <td><?= $value["coach_phone"] ?></td>
                                <td><?= $value["coach_email"] ?></td>
                                <td class="address-width"><?= $value["coach_address"] ?></td>
                                <td><?= $value["coach_created_at"] ?></td>
                                <td class="text-nowrap">
                                    <a role="button" href="coach-edit.php?id=<?= $value["coach_id"] ?>"
                                       class="mb-2"><i class="fas fa-edit"></i></a> /
                                    <a role="button" href="method/deleteCoach.php?id=<?= $value["coach_id"] ?>"
                                       class="" onclick="javascript:return del();" value="刪除"><i
                                                class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div>
                        <!--如果有分頁要顯示目前筆數-->
                        <?php if (isset($p)): ?>
                            <div class="py-2">共 <?= $totalCoach ?> 筆</div>
                        <?php else: ?>
                            <div class="py-2">共 <?= $coach_rows ?> 筆</div>
                        <?php endif; ?>
                    </div>


                    <!--        如果使用搜尋功能因為沒有p pagaCount會跑出來有問題 所以加上判斷 有p才出現這個UI-->
                    <?php if (isset($p)): ?>
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination justify-content-center">
                                <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                    <!--當下頁數跟頁碼相同時echo active 寫在li class裡面-->
                                    <li class="page-item <?php if ($p == $i) echo "active" ?>">
                                        <a class="page-link" href="coach.php?p=<?= $i ?>"><?= $i ?></a></li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>

                <?php else : ?>
                    沒有課程資料
                <?php endif; ?>
            </div>

        </article>
        <!--/content-->
    </div>
</div>

<script>
    function del() {
        var msg = "確定要刪除嗎？\n\n請確認！";
        if (confirm(msg) == true) {
            window.location.replace("./method/deleteCoach.php?member_id=<?= $value["coach_id"] ?>");
            return true;
        } else {
            return false;
        }
    }
</script>
</body>

</html>