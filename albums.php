<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Albums</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>

<h1>Albums</h1>
<a href="album-details.php">Add a New Album</a>

<?php
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
<tr><th>Title</th><th>Year</th><th>Artist</th><th>Edit</th><th>Delete</th></tr>';

// loop through data
foreach ($albums as $album) {
    // print each album as a new row
    echo '<tr><td>' . $album['title'] . '</td>
        <td>' . $album['year'] . '</td>
        <td>' . $album['artist'] . '</td>
        <td><a href="album-details.php?albumId=' . $album['albumId'] . '" class="btn btn-primary">Edit</a></td>
        <td><a href="delete-album.php?albumId=' . $album['albumId'] . '"
        class="btn btn-danger confirmation">Delete</a></td></tr>';
}

// end table
echo '</table>';

// disconnect
$conn = null;
?>

<!-- Latest   jQuery -->
<script src="js/jquery-3.1.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- custom js -->
<script src="js/app.js"></script>

</body>
</html>
