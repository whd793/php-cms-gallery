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
    <title>Gallery - Super Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css"/>
    <link rel="stylesheet" href="css/lightbox.css"/>
    <script src="js/jquery-3.3.1.min.js" type="application/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</head>
<body>

<div id="notLoggedIn" class="container">
    <?php include("nav.php") ?>
    <p>You must be logged in as a super admin to access this page.</p>
</div>

<div id="container" class="container">
    <?php include("nav.php") ?>
    <h1>Super Admin</h1>
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
    <h3>Categories</h3>
    <a role="button" class="btn btn-outline-primary" href="createCategory.php">Create New Category</a>
    <br/>
    <br/>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Admin</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $categoryResult = mysqli_query($db, "SELECT * FROM Category");

        if (empty($categoryResult)) {
            $num_results = 0;
        } else {
            $num_results = mysqli_num_rows($categoryResult);
        }

        for ($i = 0; $i < $num_results; $i++) {
            $row = mysqli_fetch_array($categoryResult);

            $catId = $row["Id"];
            $catName = $row["Name"];
            $catAdmin = $row["Admin"];

            echo("<tr>");
            echo("<td>");
            echo($catName);
            echo("</td>");
            echo("<td>");
            echo($catAdmin);
            echo("</td>");
            echo("<td>");
            echo("<a role=\"button\" class=\"btn btn-primary\" href=\"updateCategoryForm.php?id=$catId\">Edit</a>");
            echo("</td>");
            echo("<td>");
            echo("<a role=\"button\" class=\"btn btn-danger\" href=\"deleteCategory.php?id=$catId\">Delete</a>");
            echo("</td>");
            echo("</tr>");
        }
        ?>
        </tbody>
    </table>
    <br/>
    <br/>
    <h3>Admins</h3>
    <a role="button" class="btn btn-outline-primary" href="createAdmin.php">Create New Admin</a>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Type</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $catAdminResult = mysqli_query($db, "SELECT * FROM Admin");

        if (empty($catAdminResult)) {
            $num_results = 0;
        } else {
            $num_results = mysqli_num_rows($catAdminResult);
        }

        for ($i = 0; $i < $num_results; $i++) {
            $row = mysqli_fetch_array($catAdminResult);

            $catAdminName = $row["Login"];

            echo("<tr>");
            echo("<td>");
            echo($catAdminName);
            echo("</td>");
            echo("<td>");
            echo("");
            echo("</td>");
            echo("<td>");
            echo($row["Type"]);
            echo("</td>");
            echo("<td>");
            echo("<a role=\"button\" class=\"btn btn-primary\" href=\"updateAdminForm.php?name=$catAdminName\">Edit</a>");
            echo("</td>");
            echo("<td>");
            echo("<a role=\"button\" class=\"btn btn-danger\" href=\"deleteAdmin.php?name=$catAdminName\">Delete</a>");
            echo("</td>");
            echo("</tr>");
        }
        ?>
        </tbody>
    </table>
    <br/>
    <br/>
    <h3>Images</h3>
    <a role="button" class="btn btn-outline-primary" href="uploadNewImage.php">Upload New Image</a>
    <br/>
    <br/>
</div>

<?php
if (empty($_SESSION["login"]) || $_SESSION["adminType"] == "CategoryAdmin") {
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