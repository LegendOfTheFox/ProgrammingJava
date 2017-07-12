<?php  ob_start(); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
<!--        this is how we get the unique page name in the title-->
        <title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="css/styles.css" />
        <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="js/sorttable.js"></script>
    </head>
    <body>
            <header>
                <nav class="loginbar">
                    <?php
                    if (!empty($_SESSION['user_id'])) {
                    
                    echo '<a href="adminmenu.php" title="Admin Home Page">Admin</a>';
                    
                        }else{
                        echo '<a href="login.php" title="login">Login</a>';
                    }
                    ?>
                    
                    <img src="images/logo.png" alt="website logo" height=50px />
                </nav>
                <nav class="navbar">
                    <?php
                    //we need to connect to the database and parse out all the user related pages and display them
                    require_once('db.php');
                    //prepare the query
                    $sql = "SELECT * FROM tbl_pages";
                    //run the query and store the results
                    $cmd = $conn->prepare($sql);
                    $cmd -> execute();
                    $pages = $cmd->fetchAll();
                    
               // echo '<ul>';
                    foreach($pages as $page){
                      //  echo '<li>';
                        echo  '<a href="index.php?page_id=' . $page['page_id'] . '"> ' . $page['title'] . ' </a>';
                      //  echo '</li>';
                    }
                   
                   // echo '</ul>';
                    ?>
                </nav>
            </header>
        <main>
        