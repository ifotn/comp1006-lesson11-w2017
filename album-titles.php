<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Album Titles</title>
</head>
<body>

<?php
// connect to db
$conn = new PDO('mysql:host=localhost;dbname=gcrfreeman', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // helps with debugging db errors

// write an sql query to select the album titles
$sql = "SELECT title FROM albums";

// execute the query and store the results
$cmd = $conn->prepare($sql);
$cmd->execute();
$albums = $cmd->fetchAll();  // $albums is the whole collection of data from the query

// loop through the data - $album is the current item in the list of $albums
foreach($albums as $album) {
    // display the titles using echo
    echo $album['title'] . '<br />';
}

// disconnect
$conn = null;
?>

</body>
</html>
