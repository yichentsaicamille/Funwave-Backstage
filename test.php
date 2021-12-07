<!doctype html>
<html lang="en">

<head>
    <title>後台管理</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>
    <style>
        .content-list {
            /*margin: 95px 0px 0px 500px;*/
            margin-top: 90px;
            position: absolute;
            left: 15%;
            top: 40%;
        }
        .content-list li {
            background: #FFFBCC;
            height: 150px;
            margin: 20px;
        }
        .content-list li a {
            text-decoration: none;
            font-size: 36px;
            white-space: nowrap;
            line-height: 150px;
            text-align: center;
            display: block;
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
        <article class="col-lg-9 d-flex justify-content-center align-items-center">
            <ul class="row content-list d-flex justify-content-center list-unstyled">
                <li class="col-md-3 shadow-sm"><a href="">商品管理</a></li>
                <li class="col-md-3 shadow-sm"><a href="">服務管理</a></li>
                <li class="col-md-3 shadow-sm"><a href="">訂單管理</a></li>
                <li class="col-md-3 shadow-sm"><a href="">教練管理</a></li>
                <li class="col-md-3 shadow-sm"><a href="">資訊/消息管理</a></li>
                <li class="col-md-3 shadow-sm"><a href="">會員管理</a></li>
                <li class="col-md-3 shadow-sm"><a href="">評價管理</a></li>
                <li class="col-md-3 shadow-sm"><a href="">留言板</a></li>
                <li class="col-md-3 shadow-sm"><a href="">優惠券</a></li>
                <li class="col-md-3 shadow-sm"><a href="">行事曆管理</a></li>
            </ul>

        </article>
    </div>
</div>
</body>

</html>