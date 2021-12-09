<?php
 $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<nav class="navbar">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="" href="#">商品管理</a>
        </li>
        <li class="nav-item">
            <a class="" href="#">服務管理</a>
        </li>
        <li class="nav-item">
            <a class="<?php
            if (($activePage === 'order-list')) {
                echo "active";
            }else if(($activePage === 'order-detail')) {
                echo "active";
            }else if(($activePage === 'order-edit')) {
                echo "active";
            }else {
                echo "";
            }
            ?>" href="./order-list.php">訂單管理</a>
        </li>
        <li class="nav-item">
            <a class="<?php
            if (($activePage === 'coach')) {
                echo "active";
            }else if(($activePage === 'coach-create')) {
                echo "active";
            }else if(($activePage === 'coach-edit')) {
                echo "active";
            }else if(($activePage === 'coach-examine')) {
                echo "active";
            }else {
                echo "";
            }
            ?>" href="./coach.php">教練管理</a>
        </li>
        <li class="nav-item">
            <a class="<?php
            if (($activePage === 'info-list')) {
                echo "active";
            }else if(($activePage === 'info-editor')) {
                echo "active";
            }else if(($activePage === 'info-create')) {
                echo "active";
            }else if(($activePage === 'info-read')) {
                echo "active";
            }else {
                echo "";
            }
            ?>" href="./info-list.php">資訊/消息管理</a>
        </li>
        <li class="nav-item">
            <a class="<?php
            if (($activePage === 'member-list')) {
                echo "active";
            }else if(($activePage === 'member-content')) {
                echo "active";
            }else if(($activePage === 'member-edit')) {
                echo "active";
            }else if(($activePage === 'create-member')) {
                echo "active";
            }else {
                echo "";
            }
            ?>" href="./member-list.php">會員管理</a>
        </li>
        <li class="nav-item">
            <a class="" href="#">評價管理</a>
        </li>
        <li class="nav-item">
            <a class="" href="#">留言板</a>
        </li>
        <li class="nav-item">
            <a class="" href="#">優惠券</a>
        </li>
        <li class="nav-item">
            <a class="" href="#">行事曆管理</a>
        </li>
    </ul>
</nav>