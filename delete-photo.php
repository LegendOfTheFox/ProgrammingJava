<?php
//<!--interupt the page loading so it can be redirected-->
    ob_start();
    //auth check
    require_once('auth.php');

    // capture the selected photo_id from the url and store it in a variable with the same name
    $photo_id = $_GET['photo_id'];
    try{
                // connect
        require_once('db.php');

        // set up the SQL command
        $sql = "DELETE FROM tbl_gallery WHERE photo_id = :photo_id";

        // create a command object so we can populate the photo_id value, the run the deletion
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':photo_id', $photo_id, PDO::PARAM_INT);
        $cmd->execute();

        //disconnect
        $conn = null;

        //redirect the user
        header('location:images.php');

        require_once('footer.php');
        }
    catch (Exception $e) {
        mail('bryanfox1986@gmail.com', 'Delete Photo Error', $e);
        header('location:error.php');
    }
    
ob_flush(); ?><!-- Release the buffer -->