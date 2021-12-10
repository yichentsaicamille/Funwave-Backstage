<?php
require_once("./method/pdo-connect.php");
require_once("./public/admin-if-login.php");

?>

<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require_once("./public/admin-header-logined.php"); ?>
            <!--menu-->
            <aside class="col-lg-2 navbar-side shadow-sm">
                <?php require_once("./public/nav.php") ?>
            </aside>
        </div>
    </div>
</body>

</html>