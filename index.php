<?php
// session start to check user login
session_start();

include('includes/openDbConn.php');

$categoryName = "";

$categoryName = isset($_GET["cat"]) ? $_GET["cat"] : '';

// validate html
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery</title>
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
    <h1>Gallery</h1>
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
    <div class="row fill">
        <?php
        if (!empty($categoryName)) {
            $indexQuery = mysqli_query($db, "SELECT * FROM Image WHERE Category='".$categoryName."'");
        } else {
            $indexQuery = mysqli_query($db, "SELECT * FROM Image");
        }
        $counter = 0;
        while($row = mysqli_fetch_array($indexQuery, MYSQLI_BOTH)) {
            $imgLocation = $row['Location'];
            if ($counter < 4) {
                ?>
                <div class="col-md-3">
                    <a href="<?php echo $imgLocation; ?>" data-lightbox="<?php echo $row['Id']; ?>" data-title="<?php echo $row['Description']; ?>">
                        <img src="<?php echo $imgLocation ?>" class="img-thumbnail" width="100%">
                    </a>
                    <?php
                    $adminType = "";
                    $adminType = isset($_SESSION["adminType"]) ? $_SESSION["adminType"] : '';
                    if ($adminType == "SuperAdmin") {
                        $id = $row["Id"];
                        echo("<a role=\"button\" class=\"btn btn-primary\" href=\"editImage.php?id=$id\">");
                        echo("Edit");
                        echo("</a>");
                        echo("<a role=\"button\" class=\"btn btn-danger\" href=\"deleteImage.php?id=$id\">");
                        echo("Delete");
                        echo("</a>");
                    }
                    ?>
                    <a role="button" class="btn btn-primary" href="download.php?img=<?php echo $imgLocation ?>">Download</a>
                </div>
                <?php
                $counter++;
            } else if ($counter == 4) {
                $counter = 0;
                ?>
                <br/>
                <div class="w-100"></div>
                <br/>
                <div class="col-md-3">
                    <a href="<?php echo $row['Location']; ?>" data-lightbox="<?php echo $row['Id']; ?>" data-title="<?php echo $row['Description']; ?>">
                        <img src="<?php echo $row['Location']; ?>" class="img-thumbnail" width="100%">
                    </a>
                    <a role="button" class="btn btn-primary" href="download.php?img=<?php echo $imgLocation ?>">Download</a>
                </div>
                <?php
                $counter++;
            }
        }
        include('includes/closeDbConn.php');
        ?>
    </div>
</div>
</body>
</html>