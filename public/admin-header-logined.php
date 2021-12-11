<header class="header shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center header-wrapper">
        <a class="logo-text" href="./index.php"><img class="logo" src="./images/FUN浪-logos.jpeg" alt="">&nbsp;FUN浪</a>
        <div>
            <div><span style="color: white">Hi, &nbsp;<?= $_SESSION["admin"]["admin_name"] ?></span><a href="./method/doLogoutAdmin.php" class="logoutButton ms-3 me-2">登出</a></div>
        </div>
    </div>
</header>