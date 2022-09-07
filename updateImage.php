<?php
session_start();

include("includes/openDbConn.php");

$description = $_POST["description"];
$category = $_POST["category"];
$imageId = $_GET["id"];

if (!empty($description) || !(empty($category))) {

        $updateImageDetails = "UPDATE Image SET Description = '" . $description . "', Category='" . $category . "' WHERE Id=".$imageId;

        if (mysqli_query($db, $updateImageDetails) == TRUE) {
            // set session message
            $_SESSION["infoMessage"] = "Image details updated!";
            include("includes/closeDbConn.php");
            header("Location: index.php");
            exit;
        } else {
            $_SESSION["errorMessage"] = "Something went wrong. Please try again.";
            include("includes/closeDbConn.php");
            header("Location: editImage.php?id=$imageId");
            exit;
        }

} else {
    $_SESSION["errorMessage"] = "Please enter a description and category for the image.";
    include("includes/closeDbConn.php");
    header("Location: editImage.php?id=$imageId");
    exit;
}