<?php
require_once("pdo-connect.php");

if (isset($_POST["admin_account"])) { //確保資料可以送到後端
    $admin_account = $_POST["admin_account"];
    $admin_password = $_POST["admin_password"];
} else {
    exit();
}


$sqlAdmin = "SELECT * FROM admin WHERE admin_account=? AND admin_password=?";
$stmtAdmin = $db_host->prepare($sqlAdmin);

// // echo $sql;
try {
    $stmtAdmin->execute([$admin_account, $admin_password]);
    $adminExist=$stmtAdmin->rowCount();
    if($adminExist>0){
        $rowAdmin = $stmtAdmin->fetch();
        $admin=[
            "admin_id"=>$rowAdmin["admin_id"],
            "admin_account"=>$rowAdmin["admin_account"],
            "admin_password"=>$rowAdmin["admin_password"],
            "admin_name"=>$rowAdmin["admin_name"]
        ];
        $_SESSION["admin"]=$admin; 
        // header("location: ../member-list.php");
    }else{
        header("location: ../log-in-admin.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}