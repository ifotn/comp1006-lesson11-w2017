<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Album...</title>
</head>
<body>

<?php

$albumId = null;

// 1. Get the albumId from the URL, check it has a numeric value
if (!empty($_GET['albumId'])) {
    if (is_numeric($_GET['albumId'])) {
        $albumId = $_GET['albumId'];
    }
}

if (!empty($albumId)) {

    // 2. Connect
    $conn = new PDO('mysql:host=localhost;dbname=gcrfreeman', 'root', '');

    // 3. Set up and run the SQL DELETE COMMAND
    $sql = "DELETE FROM albums WHERE albumId = :albumId";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':albumId', $albumId, PDO::PARAM_INT);
    $cmd->execute();

    // 4. Disconnect
    $conn = null;
}

// 5. Redirect to refresh the albums page
header('location:albums.php');

?>

</body>
</html>

<?php ob_flush(); ?>
