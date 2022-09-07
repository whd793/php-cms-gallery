<?php

session_start();

$login = $_POST["login"];
$password = $_POST["password"];
$adminType = $_POST["admin"];

include("includes/openDbConn.php");

if (!empty($login)) {

    // check if login already exists
    $getAdmin = "SELECT * FROM Admin WHERE Login='" . $login . "'";
    if (mysqli_num_rows(mysqli_query($db, $getAdmin)) > 0) {
        // user exists already
        $_SESSION["errorMessage"] = "Login taken. Please use different login.";
        include("includes/closeDbConn.php");
        header("Location:createAdmin.php");
        exit;
    }

    // add admin to our database
    $insertAdmin = "INSERT INTO Admin (Login, Passwd, Type) VALUES ('$login', '$password', '$adminType')";

    if (mysqli_query($db, $insertAdmin) == TRUE) {
        $_SESSION["infoMessage"] = "You have created a new admin!";
        include("includes/closeDbConn.php");
        header("Location:superAdmin.php");
        exit;
    } else {
        $_SESSION["errorMessage"] = "Something went wrong. Please try again.";
        include("includes/closeDbConn.php");
        header("Location:createAdmin.php");
        exit;
    }

} else {
    $_SESSION["errorMessage"] = "Please enter a login for the admin.";
    include("includes/closeDbConn.php");
    header("Location:createAdmin.php");
    exit;
}