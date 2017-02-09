<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Album...</title>
</head>
<body>

<?php
// store the form inputs into variables
$title = $_POST['title'];
$year = $_POST['year'];
$artist = $_POST['artist'];
$albumId = $_POST['albumId'];

// variable to indicate if there are 1 or more input errors
$ok = true;

// validate the inputs before saving
if (empty($title)) {
    echo 'Title is required<br />';
    $ok = false;
}

if (!empty($year)) {  // if year is not empty (it can be)
    if ($year < 1900) {  // must be 1900 or later if we have a year value
        echo 'Year must be 1900 or greater';
        $ok = false;
    }
    else {
        $year = intval($year);  // convert to integer in case we have a decimal
    }
}

if (empty($artist)) {
    echo 'Artist is required<br />';
    $ok = false;
}

if ($ok == true) {
    // connect to db - dbtype, server address, dbname, username, password
    $conn = new PDO('mysql:host=localhost;dbname=gcrfreeman', 'root', '');

    // set up an SQL instruction to save the new album - INSERT or UPDATE
    if (empty($albumId)) {
        $sql = "INSERT INTO albums (title, year, artist) VALUES (:title, :year, :artist);";
    }
    else {
        $sql = "UPDATE albums SET title = :title, year = :year, artist = :artist WHERE albumId = :albumId";
    }

    // pass the input variables to the SQL command
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
    $cmd->bindParam(':year', $year, PDO::PARAM_INT);
    $cmd->bindParam(':artist', $artist, PDO::PARAM_STR, 50);

    // populate id if we have one
    if (!empty($albumId)) {
        $cmd->bindParam(':albumId', $albumId, PDO::PARAM_INT);
    }

    // execute the INSERT
    $cmd->execute();

    // disconnect
    $conn = null;

    // show a message to the user
    //echo 'Album Saved';
    header('location:albums.php');
}
?>

</body>
</html>
