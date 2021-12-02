<?php
require_once("./method/db-connect.php");
$sql = "SELECT * FROM coach";
$result = $conn->query($sql);
$memberCount = $result->num_rows;

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM member WHERE name LIKE '%$search%'";
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
                    <a role="button" href="member.php" class="btn btn-primary">新增</a>
                </div>
                <form action="./method/member-management.php" method="get">
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" name="search" value="<?php if (isset($search)) echo $search; ?>">
                        <button class="btn btn-primary text-nowrap">搜尋</button>
                    </div>
                </form>
            </div>
            <article class="article col-lg-9 shadow-sm table-responsive">
                <!--content-->
                <div class="table-wrap">
                    <?php if ($memberCount > 0) : ?>
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
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td>
                                            <a role="button" href="" class="btn btn-primary">查看</a>
                                        </td>
                                        <td>
                                            <img class="cover-fit" src="images/<?= $row["photo"] ?>">
                                        </td>
                                        <td><?= $row["name"] ?></td>
                                        <td><?= $row["gender"] ?></td>
                                        <td><?= $row["expertise"] ?></td>
                                        <td><?= $row["phone"] ?></td>
                                        <td><?= $row["email"] ?></td>
                                        <td><?= $row["address"] ?></td>
                                        <td><?= $row["created_at"] ?></td>
                                        <td>
                                            <a role="button" href="" class="btn btn-danger">刪除</a>
                                            <a role="button" href="member-edit.php?id=<?= $row["id"] ?>" class="btn btn-primary">修改</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example my-5">
                            <ul class="pagination d-flex justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
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