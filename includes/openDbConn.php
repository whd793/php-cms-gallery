<?php
@ $db = mysqli_connect("localhost", "cgt356web1h", "Acquired1h3775", "cgt356web1h");

// check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

