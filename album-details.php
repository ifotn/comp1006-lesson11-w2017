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
        <input name="title" id="title" required />
    </fieldset>
    <fieldset>
        <label for="year">Year:</label>
        <input name="year" id="year" type="number" min="1900" />
    </fieldset>
    <fieldset>
        <label for="artist">Artist: *</label>
        <input name="artist" id="artist" required />
    </fieldset>
    <button>Save</button>
</form>

</body>
</html>
