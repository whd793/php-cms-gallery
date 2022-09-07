<?php

session_start();

$catAdminName = $_GET["name"];

include("includes/openDbConn.php");

$sql = "DELETE FROM Admin WHERE Login='".$catAdminName."'";

$result = mysqli_query($db, $sql);

include("includes/closeDbConn.php");

$_SESSION["infoMessage"] = "You have deleted an admin!";

header("Location:superAdmin.php");

exit;