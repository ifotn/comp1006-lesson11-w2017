<?php
$pageTitle = 'Album List';
require_once('header.php'); ?>

<h1>Albums</h1>

<?php

// access current session
session_start();

if (!empty($_SESSION['userId'])) {
    echo '<a href="album-details.php">Add a New Album</a> ';
    echo '<a href="logout.php">Logout</a>';
}

// connect
$conn = new PDO('mysql:host=localhost;dbname=gcrfreeman', 'root', '');

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// set up query
$sql = "SELECT albumId, title, year, artist FROM albums ORDER BY title";

// run query and store results
$cmd = $conn->prepare($sql);
$cmd->execute();
$albums = $cmd->fetchAll();

// start table and headings
echo '<table class="table table-striped table-hover">
<tr><th>Title</th><th>Year</th><th>Artist</th>';

if (!empty($_SESSION['userId'])) {
    echo '<th>Edit</th><th>Delete</th>';
}

echo '</tr>';

// loop through data
foreach ($albums as $album) {
    // print each album as a new row
    echo '<tr><td>' . $album['title'] . '</td>
        <td>' . $album['year'] . '</td>
        <td>' . $album['artist'] . '</td>';

        if (!empty($_SESSION['userId'])) {
            echo '<td><a href="album-details.php?albumId=' . $album['albumId'] . '" class="btn btn-primary">Edit</a></td>
        <td><a href="delete-album.php?albumId=' . $album['albumId'] . '"
        class="btn btn-danger confirmation">Delete</a></td>';
        }

        echo '</tr>';
}

// end table
echo '</table>';

// disconnect
$conn = null;
?>

<?php require_once('footer.php'); ?>
