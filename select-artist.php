<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select an Artist</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

<h1>Select an Artist</h1>

<form method="post" action="artist-details.php">
    <label for="artist">Artist:</label>
    <select name="artist" id="artist">
        <?php
        // connect
        $conn = new PDO('mysql:host=localhost;dbname=gcrfreeman', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // set up & run query & store the results
        $sql = "SELECT artist FROM albums GROUP BY artist ORDER BY artist";

        // loop throught the data
        $cmd = $conn->prepare($sql);
        $cmd->execute();
        $artists = $cmd->fetchAll();

        foreach ($artists as $artist) {
            // display each artist inside <option></option> tags
            echo '<option>' . $artist['artist'] . '</option>';
        }

        // disconnect
        $conn = null;
        ?>
    </select>
    <button class="btn btn-success">Go >></button>
</form>

<!-- Latest   jQuery -->
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
