<?php
// session start to check user login
session_start();

// validate html
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - Readme</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css"/>
    <link rel="stylesheet" href="css/lightbox.css"/>
    <script src="js/jquery-3.3.1.min.js" type="application/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="js/lightbox.js" type="application/javascript"></script>
</head>
<body>
<div class="container">
    <?php include("nav.php") ?>
    <h1>Readme</h1>
    <p>Jeff Cardwell, Fisher Adelakin, Kayla Heemstra, Won Lee</p>
    <p>Using jQuery to hide and show elements based on whether the user is logged in or not</p>
    <p>File Upload does not work because of permissions. For some reason, we are not allowed to insert or move files into our upload folder for no reason.</p>
</div>
</body>
</html>