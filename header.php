<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="default.php" class="navbar-brand">COMP1006 - Music Library</a></li>
        <li><a href="albums.php">Albums</a></li>

        <?php
        // check if user is logged in
        session_start();

        if (empty($_SESSION['userId'])) {
            // public links
            echo '<li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>';
        }
        else {
            // private link
            echo '<li><a href="logout.php">Logout</a></li>';
        }
        ?>
    </ul>

    <?php
    if (!empty($_SESSION['userId'])) {
        echo '<div class="navbar-text pull-right">' . $_SESSION['username'] . '</div>';
    }

    ?>
</nav>
