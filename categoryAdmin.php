<?php
// session start to check user login
session_start();

// validate html
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");

include('includes/openDbConn.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - Category Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css"/>
    <link rel="stylesheet" href="css/lightbox.css"/>
    <script src="js/jquery-3.3.1.min.js" type="application/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
            integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
            integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
            crossorigin="anonymous"></script>
    <script src="js/lightbox.js" type="application/javascript"></script>
</head>
<body>
<div id="notLoggedIn" class="container">
    <?php include("nav.php") ?>
    <p>You must be logged in as an admin to access this page.</p>
</div>
<div id="container" class="container">
    <?php include("nav.php") ?>
    <h1>Category Admin</h1>
    <div id="infoMsg">
        <?php
        if (!empty($_SESSION["infoMessage"])) {
            ?>
            <div class="alert alert-info" role="alert">
                <?php
                echo($_SESSION["infoMessage"]);
                ?>
            </div>
            <?php
            $_SESSION["infoMessage"] = "";
        }
        ?>
    </div>
    <br/>
    <br/>
    <h3>Images</h3>
    <a role="button" class="btn btn-outline-primary" href="uploadNewImage.php">Upload New Image</a>
    <div class="row fill">
        <?php
        $user = $_SESSION["login"];
        $getUserOwnedCategoriesQuery = mysqli_query($db, "SELECT * FROM Category Where Admin='" . $user . "'");
        $counter = 0;

        while ($categoryRow = mysqli_fetch_array($getUserOwnedCategoriesQuery, MYSQLI_BOTH)) {
            $getImagesForCategoryQuery = mysqli_query($db, "SELECT * FROM Image Where Category='" . $categoryRow["Name"] . "'");
            while ($imagesRow = mysqli_fetch_array($getImagesForCategoryQuery, MYSQLI_BOTH)) {
                $imageId = $imagesRow["Id"];
            ?>
        <div class="col-md-3">
            <a href="<?php echo $imagesRow['Location']; ?>" data-lightbox="<?php echo($imageId); ?>"
               data-title="<?php echo $imagesRow['Description']; ?>">
                <img src="<?php echo $imagesRow['Location']; ?>" class="img-thumbnail" width="100%">
            </a>
            <a role= "button" class="btn btn-primary" href="editImage.php?id=<?php echo($imageId); ?>">Edit</a>
            <a role="button" class="btn btn-danger" href="deleteImage.php?id=<?php echo($imageId); ?>">Delete</a>
        </div>
        <?php
        }
        }
        ?>
    </div>
    <br/>
    <br/>
</div>

<?php
if (empty($_SESSION["login"])) {
    ?>
    <script type="text/javascript"> $("#container").hide() </script>
<?php
} else {
?>
    <script type="text/javascript"> $("#notLoggedIn").hide() </script>
    <?php
}
?>

<?php
include("includes/closeDbConn.php");
?>
</body>
</html>