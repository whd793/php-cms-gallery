<?php


session_start();

$login = $_POST["login"];
$password = $_POST["password"];
$adminType = $_POST["admin"];

include("includes/openDbConn.php");

if (!empty($login)) {

    $updateAdmin = "UPDATE Admin SET Login = '" . $login ."', Passwd = '" . $password ."', Type = '" . $adminType ."' WHERE Login='". $login."'";

    if (mysqli_query($db, $updateAdmin) == TRUE) {
        $_SESSION["infoMessage"] = "You have updated an admin!";
        include("includes/closeDbConn.php");
        header("Location:superAdmin.php");
        exit;
    } else {
        $_SESSION["errorMessage"] = "Something went wrong. Please try again.";
        include("includes/closeDbConn.php");
        header("Location:updateAdminForm.php");
        exit;
    }

} else {
    $_SESSION["errorMessage"] = "Please enter a login for the admin.";
    include("includes/closeDbConn.php");
    header("Location:updateAdminForm.php");
    exit;
}