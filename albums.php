<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Albums</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

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
echo '<table class="table table-striped table-hover"><tr><th>Title</th><th>Year</th><th>Artist</th></tr>';

// loop through data
foreach ($albums as $album) {
    // print each album as a new row
    echo '<tr><td>' . $album['title'] . '</td>
        <td>' . $album['year'] . '</td>
        <td>' . $album['artist'] . '</td></tr>';
}

// end table
echo '</table>';

// disconnect
$conn = null;
?>

<!-- Latest   jQuery -->
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
