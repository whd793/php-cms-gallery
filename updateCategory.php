<?php

session_start();

$id = $_GET["id"];

$name = $_POST["name"];
$categoryAdmin = $_POST["categoryAdmin"];

include("includes/openDbConn.php");

if (!empty($name)) {
    // add category to our database
    $updateCategory = "UPDATE Category SET Name = '" . $name . "', Admin = '". $categoryAdmin . "' WHERE Id=".$id;

    if (mysqli_query($db, $updateCategory)) {
        $_SESSION["infoMessage"] = "You have updated the category!";
        include("includes/closeDbConn.php");
        header("Location:superAdmin.php");
        exit;
    } else {
        $_SESSION["errorMessage"] = "Something went wrong. Please try again.";
        include("includes/closeDbConn.php");
        header("Location:updateCategory.php");
        exit;
    }

} else {
    $_SESSION["errorMessage"] = "Please enter a name for the category.";
    include("includes/closeDbConn.php");
    header("Location:createCategory.php");
    exit;
}