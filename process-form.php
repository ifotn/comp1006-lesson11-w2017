<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Processing Form...</title>
</head>
<body>

<?php
// create 2 variables and store the 2 form inputs in them
$name = $_POST['name'];
$email = $_POST['email'];

// this is the C# / Java equivalent
// String name = name.Text;
// String email = email.Text;

// display the variables
echo 'Name: ' . $name . '<br />';
echo 'Email: ' . $email . '<br />';

?>


</body>
</html>
