<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Album Details</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>

<main class="container">
    <h1>Album Details</h1>
    <a href="albums.php">View Albums</a>

    <form method="post" action="save-album.php">
        <fieldset class="form-group">
            <label for="title" class="col-sm-1">Title: *</label>
            <input name="title" id="title" required placeholder="Album Title" />
        </fieldset>
        <fieldset class="form-group">
            <label for="year" class="col-sm-1">Year:</label>
            <input name="year" id="year" type="number" min="1900" placeholder="Release Year" />
        </fieldset>
        <fieldset class="form-group">
            <label for="artist" class="col-sm-1">Artist: *</label>
            <input name="artist" id="artist" required placeholder="Artist Name" />
        </fieldset>
        <button class="btn btn-success col-sm-offset-1">Save</button>
    </form>

</main>
<!-- Latest jQuery -->
<script src="js/jquery-3.1.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
