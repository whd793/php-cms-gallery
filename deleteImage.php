<?php
session_start();

$imageId = $_GET["id"];

include("includes/openDbConn.php");

$getLocationQuery = "SELECT * FROM Image WHERE Id=".$imageId;
$locationResult = mysqli_query($db, $getLocationQuery);
$row = mysqli_fetch_array($locationResult);
$imageLocation = $row["Location"];

$deleteQuery = "DELETE FROM Image WHERE Id=".$imageId;

$result = mysqli_query($db, $deleteQuery);

// delete file from our database
unlink($imageLocation);

include("includes/closeDbConn.php");

$_SESSION["infoMessage"] = "You have deleted an image!";

if($_SESSION["adminType"] == "SuperAdmin")
    header("Location:superAdmin.php");
else if ($_SESSION["adminType"] == "CategoryAdmin")
    header("Location: categoryAdmin.php");

exit;