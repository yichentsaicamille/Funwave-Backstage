<?php
require_once ("pdo-connect.php");

$coach_account=(!empty($_POST["coach_account"]) ? $_POST["coach_account"] : "");
$coach_email=(!empty($_POST["coach_email"]) ? $_POST["coach_email"] : "");
$coach_phone=(!empty($_POST["coach_phone"]) ? $_POST["coach_phone"] : "");
try {
    $select = $db_host->prepare("SELECT COUNT(*) FROM coach WHERE coach_account = :coach_account");
    $select->execute(array("coach_account" => $coach_account));

    $rowCount = $select->fetchColumn();
    if ($rowCount >= 1) {
        $registerStatus = "duplicate";
    }else {
        $stmt = $db_host->prepare("INSERT INTO coach(coach_account, coach_email, coach_phone) VALUES (:coach_account, :coach_email, :coach_phone)");
        $stmt->execute(array(":coach_account" => $coach_account, ":coach_email" => $coach_email, ":coach_phone" => $coach_phone));
        $rowCount = $stmt->rowCount();
        if ($rowCount == 1) {
            $registerStatus = "success";
        }
    }
} catch (PDOException $e) {
    echo 'Error ' . $e->getMessage();
}
header("HTTP/1.1 200 OK");

$body = array("registerStatus" => $registerStatus);
echo json_encode($body);

header("Location: index.php?registerStatus=" . $registerStatus);

if (isset($_GET["registerStatus"])) {
    switch ($_GET["registerStatus"]) {
        case "duplicate":
            echo "<script type='text/javascript'>alert('" . "帳號或信箱或手機已存在" . "');</script>";
            break;
        case "success":
            echo "<script type='text/javascript'>alert('" . "新增成功!" . "');</script>";
            break;
    }
}