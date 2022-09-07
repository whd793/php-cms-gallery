<?php

// force the download of the image in the URL query string

if (empty($_GET['img'])) {
    header("HTTP/1.0 404 Not Found");
    return;
}

$image = $_GET['img'];
$basename = basename($image);
$mime = ($mime = getimagesize($image)) ? $mime['mime'] : $mime;
$size = filesize($image);
$fp = fopen($image, "rb");

if (!($mime && $size && $fp)) {
    // error.
    return;
}

header("Content-type: " . $mime);
header("Content-Length: " . $size);
// NOTE: Possible header injection via $basename
header("Content-Disposition: attachment; filename=" . $basename);
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
fpassthru($fp);