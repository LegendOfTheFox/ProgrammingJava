<?php
//<!--interupt the page loading so it can be redirected-->
    ob_start();
    //auth check
    require_once('auth.php');

    // capture the selected page_id from the url and store it in a variable with the same name
    $user_id = $_GET['user_id'];
    try{
        // connect
        require_once('db.php');

        // set up the SQL command
        $sql = "DELETE FROM users WHERE user_id = :user_id";

        // create a command object so we can populate the user_id value, the run the deletion
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $cmd->execute();

        //disconnect
        $conn = null;

        //redirect the user
        header('location:admins.php');
        }
    catch (Exception $e) {
        mail('bryanfox1986@gmail.com', 'Delete Admin Error', $e);
        header('location:error.php');
    }
    
ob_flush(); ?><!-- Release the buffer -->