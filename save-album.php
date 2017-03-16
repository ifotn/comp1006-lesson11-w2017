<?php ob_start();

// auth check
require_once ('auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Album...</title>
</head>
<body>

<?php

try {
    // store the form inputs into variables
    $title = $_POST['title'];
    $year = $_POST['year'];
    $artist = $_POST['artist'];
    $albumId = $_POST['albumId'];
    $cover = null;

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
        } else {
            $year = intval($year);  // convert to integer in case we have a decimal
        }
    }

    if (empty($artist)) {
        echo 'Artist is required<br />';
        $ok = false;
    }

    // check cover upload if any
    if (!empty($_FILES['cover']['name'])) {
        $name = $_FILES['cover']['name'];

        // use end() and explode() to get the letters after the last period i.e. the file extension
        $arr = end(explode('.', $name));
        //echo $arr;

        // convert the extension to lower case
        $type = strtolower($arr);
        //echo $type;

        // allow jpg / png / gif / svg
        $fileTypes = ['jpg', 'png', 'gif', 'svg'];

        if (!in_array($type, $fileTypes)) {
            echo 'Invalid Image Type<br />';
            $ok = false;
        }

        // size check
        $size = $_FILES['cover']['size'];
        if ($size > 2048000) {
            echo 'Cover Image must be less than 2 MB<br />';
            $ok = false;
        }

        // rename to unique file name
        $cover = uniqid("") . "-$name";

        // copy to /covers folder
        $tmp_name = $_FILES['cover']['tmp_name'];
        move_uploaded_file($tmp_name, "covers/$cover");

    }

    if ($ok == true) {
        // connect to db - dbtype, server address, dbname, username, password
        require_once('db.php');

        // set up an SQL instruction to save the new album - INSERT or UPDATE
        if (empty($albumId)) {
            $sql = "INSERT INTO albums (title, year, artist, cover) VALUES (:title, :year, :artist, :cover);";
        } else {
            $sql = "UPDATE albums SET title = :title, year = :year, artist = :artist, cover = :cover WHERE albumId = :albumId";
        }

        // pass the input variables to the SQL command
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
        $cmd->bindParam(':year', $year, PDO::PARAM_INT);
        $cmd->bindParam(':artist', $artist, PDO::PARAM_STR, 50);
        $cmd->bindParam(':cover', $cover, PDO::PARAM_STR, 50);

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
}
catch (exception $e) {
    header('location:error.php');
}
?>

</body>
</html>

<?php ob_flush(); ?>