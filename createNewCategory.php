<?php

session_start();

$name = $_POST["name"];
$categoryAdmin = $_POST["categoryAdmin"];

include("includes/openDbConn.php");

if (!empty($name)) {
    // add category to our database
    $insertCategory = "INSERT INTO Category (Name, Admin) VALUES ('$name', '$categoryAdmin')";

    if (mysqli_query($db, $insertCategory) == TRUE) {
        $_SESSION["infoMessage"] = "You have created a new category!";
        include("includes/closeDbConn.php");
        header("Location:superAdmin.php");
        exit;
    } else {
        $_SESSION["errorMessage"] = "Something went wrong. Please try again.";
        include("includes/closeDbConn.php");
        header("Location:createCategory.php");
        exit;
    }

} else {
    $_SESSION["errorMessage"] = "Please enter a name for the category.";
    include("includes/closeDbConn.php");
    header("Location:createCategory.php");
    exit;
}