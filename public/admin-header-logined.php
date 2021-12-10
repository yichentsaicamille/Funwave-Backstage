<header class="header shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="logo-text" href="#"><img class="logo" src="./images/logo.png" alt="">Fun浪</a>
        <div>
            <div>Hi, <?= $_SESSION["admin"]["admin_name"] ?>&nbsp;&nbsp;<a href="./method/doLogoutAdmin.php" class="btn btn-primary btn-sm text-white">登出</a></div>
        </div>
    </div>
</header>