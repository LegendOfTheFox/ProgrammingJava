<?php
//<!--interupt the page loading so it can be redirected-->
    ob_start();
    //auth check
    require_once('auth.php');

    // capture the selected page_id from the url and store it in a variable with the same name
    $page_id = $_GET['page_id'];
    try{
                // connect
        require_once('db.php');

        // set up the SQL command
        $sql = "DELETE FROM tbl_pages WHERE page_id = :page_id";

        // create a command object so we can populate the page_id value, the run the deletion
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $cmd->execute();

        //disconnect
        $conn = null;

        //redirect the user
        header('location:pages.php');

        require_once('footer.php');
        }
    catch (Exception $e) {
        mail('bryanfox1986@gmail.com', 'Delete Page Error', $e);
        header('location:error.php');
    }
    
ob_flush(); ?><!-- Release the buffer -->