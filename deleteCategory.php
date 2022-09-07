<?php
session_start();

$id = $_GET["id"];

include("includes/openDbConn.php");

$sql = "DELETE FROM Category Where Id=".$id;

$result = mysqli_query($db, $sql);

include("includes/closeDbConn.php");

$_SESSION["infoMessage"] = "You have deleted a category!";

header("Location:superAdmin.php");

exit;