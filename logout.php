<?php

session_start();

$_SESSION["login"] = "";
$_SESSION["errorMessage"] = "";
$_SESSION["adminType"] = "";
$_SESSION["infoMessage"] = "";

session_unset();
session_destroy();

header("Location:index.php");