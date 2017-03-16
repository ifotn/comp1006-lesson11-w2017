<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Upload Details</title>
</head>
<body>

<?php
// print_r shows all the elements in an array
print_r($_FILES['anyFile']);

// file name
$name = $_FILES['anyFile']['name'];
echo "$name<br />";

// type
$type = $_FILES['anyFile']['type'];
echo "$type<br />";

// tmp_name
$tmp_name = $_FILES['anyFile']['tmp_name'];
echo "$tmp_name<br />";

// generate unique file name.  uniqid is a built-in PHP function we can use to generate a unique value
$name = uniqid("", true) . "-$name";

// copy from the temp directory to the uploads folder.  move_uploaded_file is also a built-in PHP function
move_uploaded_file($tmp_name, "uploads/$name");

?>

</body>
</html>
