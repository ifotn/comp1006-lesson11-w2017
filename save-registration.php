<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Registration</title>
</head>
<body>

<?php
// save user inputs to variables
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validate inputs
if (empty($username)) {
    echo 'Username is required<br />';
    $ok = false;
}

if (empty($password) || (strlen($password) < 8)) {
    echo 'Password is invalid<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords do not match<br />';
    $ok = false;
}

// recaptcha validation
$secret = '6LcPmgQTAAAAAD2XQXfomdwCcyxkQ-x7mJLoGQqz';
$response = $_POST['g-recaptcha-response'];

// use the PHP curl library to make a hidden call to google's api
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

// create an array that holds the values we need to send to Google
$postData = array();
$postData['secret'] = $secret;
$postData['response'] = $response;
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

// run the curl request and save the response from google
$result = curl_exec($ch);
curl_close($ch);

$resultJson = json_decode($result, true);

//echo $resultJson['success'];

if ($resultJson['success'] != 1) {
    echo 'Are you human?<br />';
    $ok = false;
}
/*else {
    $ok = 'Captcha ok';
    echo $ok;
}*/

//echo $result;

if ($ok) {

    // connect
    require_once ('db.php');

    // set up sql insert
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

    // hash the password!!!
    $password = password_hash($password, PASSWORD_DEFAULT);

    // execute the save
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
    $cmd->execute();

    // disconnect
    $conn = null;

    echo 'Registration Saved. <a href="login.php">Login</a>';
}
?>
</body>
</html>
