<?php

session_start();

echo("<?xml version=\1.0\" encoding=\"UTF-8\"?>");

include('includes/openDbConn.php');

$id = $_GET["id"];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - Update Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css"/>
</head>

<body>

<div class="container">
    <?php include("nav.php") ?>
    <h1>Update Category</h1>
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
            $_SESSION["errorMessage"] = "";
        }
        ?>
    </div>
    <form id="update_category_form" method="post" action="updateCategory.php?id=<?php echo($id); ?>">
        <br />
        <?php
        $query = mysqli_query($db, "select * from Category WHERE Id=".$id);
        $row = mysqli_fetch_array($query);
        ?>
        <div class="form-group">
            <label title="name" for="name">Name</label>
            <input type="text" class="form-control"
                   name="name"
                   id="name"
                   placeholder="Enter Category Name"
            value="<?php echo($row["Name"]); ?>"/>
        </div>
        <div class="form-group">
            <label for="categoryAdmin">Category Admin</label>
            <select class="form-control" id="categoryAdmin" name="categoryAdmin">
                <?php
                $getAdminResults = mysqli_query($db, "SELECT * FROM Admin WHERE Type='CategoryAdmin'");

                while($adminRow = mysqli_fetch_array($getAdminResults)) {
                    if ($row["Admin"] == $adminRow["Login"]) {
                        ?>
                        <option selected><?php echo $adminRow['Login']; ?></option>
                        <?php
                    } else {
                        ?>
                        <option><?php echo $adminRow['Login']; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
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
