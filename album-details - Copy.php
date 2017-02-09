<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Album Details</title>
</head>
<body>

<h1>Album Details</h1>

<form method="post" action="save-album.php">
    <fieldset>
        <label for="title">Title: *</label>
        <input name="title" id="title" required placeholder="Album Title" />
    </fieldset>
    <fieldset>
        <label for="year">Year:</label>
        <input name="year" id="year" type="number" min="1900" placeholder="Release Year" />
    </fieldset>
    <fieldset>
        <label for="artist">Artist: *</label>
        <input name="artist" id="artist" required placeholder="Artist Name" />
    </fieldset>
    <button>Save</button>
</form>

</body>
</html>
