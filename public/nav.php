<?php
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<nav class="navbar">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="" href="#">商品管理</a>
        </li>
        <li class="nav-item">
            <a class="<?php
            if (($activePage === 'service')) {
                echo "active";
            }else if(($activePage === 'addCourse')) {
                echo "active";
            }else if(($activePage === 'addCourseOrder')) {
                echo "active";
            }else if(($activePage === 'addCourseSchedule')) {
                echo "active";
            }else if(($activePage === 'addSpot')) {
                echo "active";
            }else if(($activePage === 'addStudent')) {
                echo "active";
            }else if(($activePage === 'examineOrder')) {
                echo "active";
            }else if(($activePage === 'course-list')) {
                echo "active";
            }else if(($activePage === 'course-order-list')) {
                echo "active";
            }else if(($activePage === 'course-schedule-list')) {
                echo "active";
            }else if(($activePage === 'examineCourse')) {
                echo "active";
            }else if(($activePage === 'examineCourseSchedule')) {
                echo "active";
            }else if(($activePage === 'examineSpot')) {
                echo "active";
            }else if(($activePage === 'examineStudent')) {
                echo "active";
            }else if(($activePage === 'spot-list')) {
                echo "active";
            }else if(($activePage === 'student-list')) {
                echo "active";
            }else if(($activePage === 'updateCourse')) {
                echo "active";
            }else if(($activePage === 'updateCourseSchedule')) {
                echo "active";
            }else if(($activePage === 'updateOrder')) {
                echo "active";
            }else if(($activePage === 'updateSpot')) {
                echo "active";
            }else if(($activePage === 'updateStudent')) {
                echo "active";
            }else {
                echo "";
            }
            ?>" href="./service.php">服務管理</a>
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