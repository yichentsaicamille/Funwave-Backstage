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
        <div class="row wrap d-flex">
            <?php require_once("./public/admin-header-logined.php") ?>
            <aside class="navbar-side shadow-sm">
                <?php require_once("./public/nav.php") ?>
            </aside>
            <div class="container-fluid">
                <img class="cover-fit home-page" src="./images/home-page.png" alt="">
            </div>

        </div>
    </div>
</body>

</html>