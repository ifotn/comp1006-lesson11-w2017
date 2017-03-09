<?php
// connect
$conn = new PDO('mysql:host=localhost;dbname=gcrfreeman', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
