<?php

session_start();

include("includes/openDbConn.php");

echo("<?xml version=\1.0\" encoding=\"UTF-8\"?>");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css"/>
</head>

<body>

<div class="container">
    <?php include("nav.php") ?>
    <h1>Admin Login</h1>
    <div id="errorMsg">
        <?php
        if (!empty($_SESSION["errorMessage"])) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo($_SESSION["errorMessage"]);
                ?>
            </div>
        <?php
        }
        ?>
    </div>
    <br/>
    <form id="login_form" method="post" action="logUserIn.php">
        <small id="usernameHelp" class="form-text text-muted">If you are an admin, login in here using your user ID and password.</small>
        <br />
        <div class="form-group">
            <label title="username" for="username">Username</label>
            <input type="text" class="form-control"
                   name="username"
                   id="username" aria-describedby="usernameHelp"
                   placeholder="Enter username"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password"/>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <small id="adminHelp" class="form-text text-muted">If you don't have an account, please contact the Web Admin.</small>
    </form>
</div>

<script src="js/jquery-3.3.1.min.js" type="application/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<?php
include("includes/closeDbConn.php");
?>
</body>

</html>
