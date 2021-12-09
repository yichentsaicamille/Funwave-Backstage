<?php
require_once("./method/pdo-connect.php");
if (isset($_GET["info_id"])) {
    $info_id = $_GET["info_id"];
} else {
    $info_id = 0;
}
$sql = "SELECT * FROM information WHERE info_valid=1 AND info_id=?";
$stmt = $db_host->prepare($sql);

try {
    $stmt->execute([$info_id]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $infoCount = $stmt->rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>information</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>
    <style>
        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row wrap d-flex ">
        <?php require_once("./public/header.php") ?>
        <aside class="col-lg-2 navbar-side shadow-sm">
            <?php require_once("./public/nav.php") ?>
        </aside>

        <form action="./method/infoInsert.php" method="post">
            <?php if ($infoCount > 0):
            foreach ($row

            as $key => $value): ?>
            <div class="col-lg-9 button-group d-flex align-items-center shadow-sm px-3">

                <a class="btn btn-primary me-4" href="./info-list.php">返回</a>
<!--                <a href="./method/infoDelete.php?info_id=--><?//= $value["info_id"] ?><!--" class="btn btn-danger"-->
<!--                   onclick="javascript:return del();">刪除</a>-->
            </div>
            <article class="article col-9 shadow-sm">
                <div class="p-5">

                    <table class="table table-bordered">
                        <tr>
                            <th>id</th>
                            <td><?= $value["info_id"] ?></td>
                        </tr>
                        <tr>
                            <th>類別</th>
                            <td><?= $value["info_category"] ?></td>
                        </tr>
                        <tr>
                            <th>建立時間</th>
                            <td><?= $value["info_time"] ?></td>
                        </tr>
                        <tr>
                            <th>標題</th>
                            <td><?= $value["info_title"] ?></td>
                        </tr>
                        <tr>
                            <th>內容</th>
                            <td>
                                <pre style="max-width: 960px"><?= $value["info_content"] ?></pre>
                            </td>
                        </tr>
                        <tr>
                            <th>圖片</th>
                            <?php if ($value["info_image"] != null):
                                ?>
                                <td>
                                    <img src="../images/<?= $value["info_image"] ?>" style="max-width:930px ">
                                </td>
                            <?php else: ?>
                                <td>
                                </td>
                            <?php endif; ?>
                        </tr>

                        <?php endforeach; else: ?>
                            <tr>
                                <td>沒有資料</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </article>
        </form>
    </div>
</div>
<script>
    function del() {
        var msg = "確定要刪除嗎？\n\n請確認！";
        if (confirm(msg) == true) {
            window.location.replace("infoDelete.php?id=<?= $value["info_id"] ?>");
            return true;
        } else {
            return false;
        }
    }
</script>


</body>
</html>
