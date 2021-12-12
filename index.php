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
    <style>
        .container-fluid {
            padding-left: 0px;
            padding-right: 0px;
        }
        .row {
            --bs-gutter-x: 0rem; 
            margin-right: 0px;
        }
        .header-wrapper {
            padding: 0px 36px;
        }
        .home-page {
            position: relative;
            margin: 0px;
        }
        .content-list {
            margin-top: 100px;
            position: absolute;
            top: 0px;
            margin-right: 170px;
            
        }

        .content-list li {
            background: #f3f3f3;
            height: 100px;
            margin: 20px;
            opacity: .6;
        }

        .content-list li a {
            text-decoration: none;
            font-size: 40px;
            white-space: nowrap;
            line-height: 100px;
            text-align: center;
            display: block;
            transition: .5s;
            color: var(--quarry-color);
        }
        .content-list li a:hover {
            color: var(--aruba-blue-color);
            box-shadow: 5px 5px 5px #666565;
            -webkit-box-shadow: 5px 5px 5px #666565;
            -moz-box-shadow: 5px 5px 5px #666565;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row wrap d-flex">
            <?php require_once("./public/admin-header-logined.php") ?>
            <!-- <aside class="navbar-side shadow-sm">
                <?php require_once("./public/nav.php") ?>
            </aside> -->
            <div class="container-fluid">
                <img class="cover-fit home-page" src="./images/home-page-update2.png" alt="">
                <img class="man" src="./images/home-page-man.png" alt="">
                <ul class="row content-list d-flex justify-content-center list-unstyled">
                    <li class="col-md-4 shadow-sm"><a href="product-list.php"><i class="fas fa-store"></i>&ensp;商品管理</a></li>
                    <li class="col-md-4 shadow-sm"><a href="service.php"><i class="fas fa-dove"></i>&ensp;服務管理</a></li>
                    <li class="col-md-4 shadow-sm"><a href="order-list.php"><i class="fas fa-list-alt"></i>&ensp;訂單管理</a></li>
                    <li class="col-md-4 shadow-sm"><a href="coach.php"><i class="fas fa-chalkboard-teacher"></i>&ensp;教練管理</a></li>
                    <li class="col-md-4 shadow-sm"><a href="info-list.php"><i class="fas fa-file-alt"></i>&ensp;資訊管理</a></li>
                    <li class="col-md-4 shadow-sm"><a href="member-list.php"><i class="fas fa-users"></i>&ensp;會員管理</a></li>
                </ul>
            </div>
            <article class="col d-flex justify-content-center align-items-center">

            </article>
        </div>
    </div>
</body>

</html>