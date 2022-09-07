<?php
session_start();

include('includes/openDbConn.php');

set_time_limit(300);

$allowed = array('gif', 'jpg', 'jpeg');

$description = $_POST["description"];
$category = $_POST["category"];

if (!empty($description) || !(empty($category))) {

    $filename = $_FILES["image"]["name"];
    $extension = PATHINFO($filename, PATHINFO_EXTENSION);

    if (!in_array($extension, $allowed)) {
        $_SESSION["errorMessage"] = "Please upload an image that is either .jpg/.jpeg or .gif.";
        include("includes/closeDbConn.php");
        header("Location:uploadNewImage.php");
        exit;
    } else {
        $getCategoryCount = mysqli_query($db, "SELECT * FROM Image WHERE Category = '".$category."'");
        $count = mysqli_num_rows($getCategoryCount) + 1; // increment the count so we don't overwrite
        $newFileName = $category . $count . '.' . $extension;
        $targetDir = "image_upload/";
        $targetLocation = "image_upload/".$newFileName;

        // make sure file is uploaded to temp
        if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
            echo "Problem: possible file upload attack.";
            exit;
        }

        // copy the file into its location on the server
        if(!copy($_FILES['image']['tmp_name'], $targetLocation)) {
            echo "Problem: Could not move file into directory";
            exit;
        }

        // resize image
        $dir = "./upload/";
        $middir = "./mid/";
        $thdir = "./thumb/";
        $img = $newFileName;

        // create mid image
        resizejpeg($dir, $middir, $img, 640, 480, "mid_");

        // create thumb image
        resizejpeg($dir, $thdir, $img, 160, 120, "th_");

        $insertCategory = "INSERT INTO Image (Category, Description, Location) VALUES ('$category', '$description', '$targetLocation')";

        if (mysqli_query($db, $insertCategory) == TRUE) {
            // set session message
            $_SESSION["infoMessage"] = "File successfully uploaded";
            include("includes/closeDbConn.php");
            header("Location: index.php");
            exit;
        } else {
            $_SESSION["errorMessage"] = "Something went wrong. Please try again.";
            include("includes/closeDbConn.php");
            header("Location: uploadNewImage.php");
            exit;
        }
    }

} else {
    $_SESSION["errorMessage"] = "Please enter a description and category for the image.";
    include("includes/closeDbConn.php");
    header("Location: uploadNewImage.php");
    exit;
}

function resizejpeg($dir, $newdir, $img, $max_w, $max_h, $prefix) {

    // set destination directory
    if (!$newdir)
        $newdir = $dir;

    // get original image width and height
    list($or_w, $or_h, $or_t) = getimagesize($dir.$img);

    // make sure image is a jpeg
    if ($or_t == 2) {

        // obtain image ratio
        $ratio = ($or_h / $or_w);

        // original image
        $or_image = imagecreatefromjpeg($dir.$img);

        // resize image?
        if ($or_w > $max_w || $or_h > $max_h) {

            // resize by height, then width (height dominant)
            if ($max_h < $max_w) {
                $rs_h = $max_h;
                $rs_w = $rs_h / $ratio;
            } else {
                // resize by width, then height (width dominant)
                $rs_w = $max_w;
                $rs_h = $ratio * $rs_w;
            }

            // copy old image to new image
            $rs_image = imagecreatetruecolor($rs_w, $rs_h);
            imagecopyresampled($rs_image, $or_image, 0, 0, 0, 0, $rs_w, $rs_h, $or_w, $or_h);
        } else {
            // no resizing
            $rs_w = $or_w;
            $rs_h = $or_h;

            $rs_image = $or_image;
        }

        // generate resized image
        imagejpeg($rs_image, $newdir.$prefix.$img, 100);

        return true;
    } else {
        return false;
    }
}