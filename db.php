<?php
// connect

// local
//$conn = new PDO('mysql:host=localhost;dbname=gcrfreeman', 'root', '');

// live - dreamhost
$conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gcrfreeman', 'gcrfreeman', 'x');

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
