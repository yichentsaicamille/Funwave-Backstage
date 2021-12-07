<?php
require_once("./method/pdo-connect.php");
$sql = "SELECT * FROM coach INNER JOIN genre ON coach.genre_id = genre.genre_id AND coach_valid=1";
$stmt = $db_host->prepare($sql);

try {
    $stmt->execute();
//    $row = $stmt->fetch();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e){
    echo $e->getMessage();
}

//$sqlSearch = "SELECT coach_name, coach_account, coach_email FROM coach WHERE coach_name LIKE '{$_GET["search"]}'";
//$stmtSearch=$db_host->prepare($sqlSearch);
//$result=$db_host->query($sqlSearch);
//$resultCount=$result->num_rows;
//$stmtSearch->execute();
//$data=$stmtSearch->fetchAll();
//$num_rows = $result->fetchColumn();
//if ($num_rows>0) {
//    while ($row=$result->fatch_assoc()) {
//        var_dump($row);
//        echo "<br>";
//    }
//}

if (isset($_POST["search"])) {
    $search = $_POST["search"];
    $sql = "SELECT * FROM coach WHERE coach_name LIKE '%$search%'";
}else {
    $sql = "SELECT * FROM coach INNER JOIN genre ON coach.genre_id = genre.genre_id AND coach_valid=1";
}

//$stmt = $db_host->prepare($sql);
//$stmt->execute();
//$num_rows = $stmt->fetchColumn();
//$data = $stmt->fetchAll();
//var_dump($data);
?>
<!doctype html>
<html lang="en">

<head>
    <title>教練管理</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>

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
                            <input class="form-control me-2" type="search" name="search" value="<?php if (isset($search)) echo $search; ?>">
                            <button class="btn btn-primary text-nowrap" type="submit">搜尋</button>
                        </div>
                    </form>
                </div>
            </div>
            <article class="article col-lg-9 shadow-sm table-responsive">
                <!--content-->
                <div class="table-wrap">
                    <?php if ($data = $stmt->fetchAll() > 0): ?>
                        <table class="table table-control align-middle my-3">
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
                                    <th>建立時間</th>
                                    <th>編輯</th>
                                </tr>
                            </thead>
                            <tbody>
<!--                                --><?php //while ($row = $result->fetch_assoc()) : ?>
                                <?php foreach ($rows as $value):
                                ?>
                                <?php  ?>
                                    <tr>
                                        <td>
                                            <a role="button" href="coach-examine.php?id=<?=$value["coach_id"]?>" class="btn btn-primary">查看</a>
                                        </td>
                                        <td>
                                            <img class="cover-fit photo-list" src="images/<?= $value["coach_photo"] ?>">
                                        </td>
                                        <td><?= $value["coach_name"] ?></td>
                                        <td><?= $value["gender"] ?></td>
                                        <td><?= $value["coach_expertise"] ?></td>
                                        <td><?= $value["coach_phone"] ?></td>
                                        <td><?= $value["coach_email"] ?></td>
                                        <td><?= $value["coach_address"] ?></td>
                                        <td><?= $value["coach_created_at"] ?></td>
                                        <td class="d-flex flex-column justify-content-center">
                                            <a role="button" href="coach-edit.php?id=<?= $value["coach_id"] ?>" class="btn btn-primary mb-2">修改</a>
                                            <a role="button" href="method/deleteCoach.php?id=<?= $value["coach_id"] ?>" class="btn btn-danger">刪除</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
<!--                        <nav aria-label="Page navigation example my-5">-->
<!--                            <ul class="pagination d-flex justify-content-center">-->
<!--                                <li class="page-item">-->
<!--                                    <a class="page-link" href="#" aria-label="Previous">-->
<!--                                        <span aria-hidden="true">&laquo;</span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">1</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">2</a></li>-->
<!--                                <li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--                                <li class="page-item">-->
<!--                                    <a class="page-link" href="#" aria-label="Next">-->
<!--                                        <span aria-hidden="true">&raquo;</span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </nav>-->
                    <?php else : ?>
                        沒有會員資料
                    <?php endif; ?>
                </div>

            </article>
            <!--/content-->
        </div>
    </div>

</body>

</html>