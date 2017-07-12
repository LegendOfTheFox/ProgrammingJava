<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Control Panel</title>
        <link rel="stylesheet" href="css/adminstyles.css" />
        <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="loginbar">
                <?php
                //to determine which links to show depending on whether or not we are logged in or not
                if (!empty($_SESSION['user_id'])) {
                ?>
                <a href="adminmenu.php" title="Admin Home Page">Admin Home</a> <a href="index.php" title="View Web Page">View Web Page</a> <a href="admins.php" title="View Admins">View Admins</a> <a href="images.php" title="View Images">View Images</a> <a href="pages.php" title="Web Pages">View Pages</a>  <a href="gallery.php" title="Image Gallery">Image Gallery</a> <a href="register.php" title="Register a user">Register Admin</a> <a href="login.php" title="Logout">Logout</a>
                <?php
                }
                else {
                ?>
                <a href="login.php" title="Login">Login</a>
                <?php
                }
                ?>
            </nav>
        </header>
        <main>
        