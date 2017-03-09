<?php
// access the existing session
session_start();

if (empty($_SESSION['userId'])) {
    header('location:login.php');
    exit();
}
?>
