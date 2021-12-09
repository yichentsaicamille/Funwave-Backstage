<!--差分頁-->

<?php
require_once("./method/pdo-connect.php");
require_once("./public/if-login.php");

$sqlMember = "SELECT * FROM member WHERE member_valid=1";
$stmtMember = $db_host->prepare($sqlMember);

try {
    $stmtMember->execute([]);
    $rowMember = $stmtMember->fetchAll(PDO::FETCH_ASSOC);
    $memberExist = $stmtMember->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}


if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sqlMember = "SELECT * FROM member WHERE member_name LIKE '%$search%' AND member_valid=1";
    $stmtMember = $db_host->prepare($sqlMember);
    try {
        $stmtMember->execute([]);
        $rowMember = $stmtMember->fetchAll(PDO::FETCH_ASSOC);
        $memberExist = $stmtMember->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    $search = "";
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
            <?php require_once("./public/header-logined.php"); ?>
            <!--menu-->
            <aside class="col-lg-2 navbar-side shadow-sm">
                <?php require_once("./public/nav.php") ?>
            </aside>
            <!--/menu-->
            <div class="col-lg-9 d-flex justify-content-between align-items-center button-group shadow-sm">
                <div>
                    <a role="button" href="./create-member.php" class="btn btn-primary">新增</a>
                </div>
                <form action="member-list.php" method="get">
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" name="search" value="<?php if (isset($search)) echo $search; ?>">
<!--                        <button class="btn btn-secondary text-nowrap">搜尋</button>-->
                        <button class="btn btn-primary text-nowrap">搜尋</button>
                    </div>
                </form>
            </div>
<!--            <form action="member-list.php" method="get">-->
                <article class="article col-lg-9 shadow-sm table-responsive">
                    <!--content-->
                    <div class="table-wrap">
                        <?php if ($memberExist > 0) : ?>
                            <table class="table table-bordered align-middle my-3">
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
                                            <td>
                                                <img class="cover-fit member-photo" src="./images/member/ <?= $value["member_photo"] ?>">
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
                            <nav aria-label="Page navigation example my-5">
                                <ul class="pagination d-flex justify-content-center">
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                </ul>
                            </nav>
                        <?php else : ?>
                            沒有會員資料
                        <?php endif; ?>
                    </div>
                </article>
<!--            </form>-->
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