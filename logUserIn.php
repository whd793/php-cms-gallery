<?php

// start session
session_start();

include("includes/openDbConn.php");

$username = $_POST["username"];
$password = $_POST["password"];

// add the login attempt to our Logging table
// we log the username, password, REMOTE_ADDR (IP), HTTP_HOST, Date, Time, Attempted UserID, HTTP_USER_AGENT, Success

$ipAddress = $_SERVER['REMOTE_ADDR'];
$host = $_SERVER['REMOTE_HOST'];

// current date
$date = date("Y/m/d");

// current time
$time = date("h:i:sa");

$userAgent = $_SERVER['HTTP_USER_AGENT'];

// check to see if this admin exists in our database
$checkAdminLogin = "SELECT * FROM Admin WHERE Login='".$username."'";

// result of query
$result = mysqli_query($db, $checkAdminLogin);

if (empty($result)) {
    $num_records = 0;
} else {
    $num_records = mysqli_num_rows($result);
}

if ($num_records == 1) {
    // get the row of our result
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    // get the admin type so we know how to redirect the admin
    $adminType = $row["Type"];

    // check if the passwords are equal
    if ($password == $row["Passwd"]) {
        $_SESSION["errorMessage"] = "";
        $_SESSION["infoMessage"] = "You have successfully logged in!";
        $_SESSION["login"] = $username;
        $_SESSION["adminType"] = $adminType;

        if ($adminType == "CategoryAdmin") {
            $insertLog = "INSERT INTO Logging (Login, Passwd, IP, UserHost, LoginDate, LoginTime, UserAgent, Success) VALUES ('$username', '$password', '$ipAddress', '$host', '$date', '$time', '$userAgent', TRUE)";

            if (mysqli_query($db, $insertLog) == TRUE) {
                include("includes/closeDbConn.php");
                header("Location: categoryAdmin.php");
                exit;
            } else {
                echo mysqli_error($db);
            }

        }

        if ($adminType == "SuperAdmin") {
            $insertLog = "INSERT INTO Logging (Login, Passwd, IP, UserHost, LoginDate, LoginTime, UserAgent, Success) VALUES ('$username', '$password', '$ipAddress', '$host', '$date', '$time', '$userAgent', TRUE)";

            if (mysqli_query($db, $insertLog) == TRUE) {
                include("includes/closeDbConn.php");
                header("Location: superAdmin.php");
                exit;
            } else {
                echo mysqli_error($db);
            }
        }
    } else {

        $_SESSION["errorMessage"] = "Invalid password";
        $insertLog = "INSERT INTO Logging (Login, Passwd, IP, UserHost, LoginDate, LoginTime, UserAgent, Success) VALUES ('$username', '$password', '$ipAddress', '$host', '$date', '$time', '$userAgent', FALSE)";

        if (mysqli_query($db, $insertLog) == TRUE) {
            include("includes/closeDbConn.php");
            header("Location: login.php");
            exit;
        } else {
            echo mysqli_error($db);
        }
    }
} else {
    $_SESSION["errorMessage"] = "Your login was incorrect. Try again.";
    $insertLog = "INSERT INTO Logging (Login, Passwd, IP, UserHost, LoginDate, LoginTime, UserAgent, Success) VALUES ('$username', '$password', '$ipAddress', '$host', '$date', '$time', '$userAgent', FALSE)";

    if (mysqli_query($db, $insertLog) == TRUE) {
        include("includes/closeDbConn.php");
        header("Location: login.php");
        exit;
    } else {
        echo mysqli_error($db);
    }
}