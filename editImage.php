<?php

session_start();

echo("<?xml version=\1.0\" encoding=\"UTF-8\"?>");

$imageId = $_GET["id"];

include('includes/openDbConn.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - Edit Image</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css"/>
    <script src="js/jquery-3.3.1.min.js" type="application/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</head>

<body>

<div class="container">
    <?php include("nav.php") ?>
    <h1>Edit Image Details</h1>
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
    <form id="new_image_form" method="post" action="updateImage.php?id=<?php echo($imageId)?>">
        <br />
        <?php
        $query = mysqli_query($db, "SELECT * FROM Image WHERE Id=".$imageId);
        $imageRow = mysqli_fetch_array($query);
        ?>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control"
                   name="description"
                   id="description"
                   placeholder="Enter a description for the image"
            value="<?php echo($imageRow["Description"]); ?>"/>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
                <?php
                $getCategoryResults = mysqli_query($db, "SELECT * FROM Category");

                while($row = mysqli_fetch_array($getCategoryResults)) {
                    if ($row["Name"] == $imageRow["Category"]) {
                        ?>
                        <option selected><?php echo $row['Name']; ?></option>
                        <?php
                    } else {
                        ?>
                        <option><?php echo $row['Name']; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <button id="" type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php
include("includes/closeDbConn.php");
?>
</body>

</html>
