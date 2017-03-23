<?php ob_start();

$pageTitle = 'Album List';
require_once('header.php');

if (!empty($_GET['keywords'])) {
    $keywords = $_GET['keywords'];
}
?>

<h1>Albums</h1>

<form method="get">
    <label for="keywords">Keywords:</label>
    <input name="keywords" id="keywords" value="<?php echo $keywords; ?>" />
    <select name="searchColumn" id="searchColumn">
        <option value="title">Search Titles</option>
        <option value="artist">Search Artists</option>
    </select>
    <select name="searchType" id="searchType">
        <option value="or">Any Keyword</option>
        <option value="and">All Keywords</option>
    </select>
    <button class="btn btn-primary">Search</button>
</form>

<?php

// access current session
session_start();

//try {
    // connect
    require_once('db.php');

    // check for search keywords
    if (!empty($_GET['keywords'])) {
       //$keywords = $_GET['keywords'];
        $searchColumn = $_GET['searchColumn'];
        $searchType = $_GET['searchType'];

        $wordList = explode(" ", $keywords);

        // query
        $sql = "SELECT albumId, title, year, artist, cover FROM albums WHERE ";
        $wordCounter = 0;

        foreach($wordList as $word) {
            $sql .= $searchColumn . " LIKE ?";
            $wordList[$wordCounter] = "%" . $word . "%";
            $wordCounter++;

            if ($wordCounter < sizeof($wordList)) {
                $sql .= " " . $searchType . " ";
            }
        }

        $sql .= " ORDER BY title";
        //echo $sql;

        echo "<h2>Keywords: $keywords</h2>";
    }
    else {
        $keywords = null;
        $wordList = null;
        // set up query
        $sql = "SELECT albumId, title, year, artist, cover FROM albums ORDER BY title";
    }

    //exit();

    // run query and store results
    $cmd = $conn->prepare($sql);
    $cmd->execute($wordList);
    $albums = $cmd->fetchAll();

    // start table and headings
    echo '<table class="table table-striped table-hover sortable">
    <tr><th>Title</th><th>Year</th><th>Artist</th><th>Cover</th>';

    if (!empty($_SESSION['userId'])) {
        echo '<th>Edit</th><th>Delete</th>';
    }

    echo '</tr>';

    // loop through data
    foreach ($albums as $album) {
        // print each album as a new row
        echo '<tr><td>' . $album['title'] . '</td>
            <td>' . $album['year'] . '</td>
            <td>' . $album['artist'] . '</td>
            <td>';
            if (!empty($album['cover'])) {
                echo '<img src="covers/' . $album['cover'] . '" class="thumb" />';
            }
        echo '</td>';

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
/*}
catch (exception $e) {
    mail('rich.freeman@georgiancollege.ca', 'Album Page Error', $e);
    header('location:error.php');
}*/
?>

<?php require_once('footer.php');
ob_flush(); ?>
