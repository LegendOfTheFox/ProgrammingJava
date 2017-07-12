<?php
    ob_start();
    //auth check
    require_once('auth.php');

    $page_title = null;
    $page_title = 'Saving your Page';
    try{
        require_once('header.php');

        // save form inputs into variables
        $title = $_POST['title'];
        $content = $_POST['content'];
        $page_type = $_POST['page_type'];
        $page_id = $_POST['page_id'];
        $extracontent = $_POST['extracontent'];
        
        $photo = null;

        // create a variable to indicate if the form data is ok to save or not
        $ok = true;

        // check each value
        if (empty($title)) {
            // notify the user
            echo 'Title is required<br />';

            // change $ok to false so we know not to save
            $ok = false;
        }

        if (empty($content)) {
            // notify the user
            echo 'Some content is required!<br />';

            // change $ok to false so we know not to save
            $ok = false;
        }

        // check the $ok variable and save the data if $ok is still true
        if ($ok == true) {

                //connection line to database
            require_once('db.php');

             if (empty($page_id)) {
                 // set up the SQL INSERT command
            $sql = "INSERT INTO tbl_pages (title, content, page_type, extracontent) VALUES (:title, :content, :page_type, :extracontent)";
             }
            else {
                // set up the SQL UPDATE command to modify the existing page
                 $sql = "UPDATE tbl_pages SET title = :title, content = :content, page_type = :page_type, extracontent = :extracontent WHERE page_id = :page_id";
            }
            // create a command object and fill the parameters with the form values
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
            $cmd->bindParam(':content', $content, PDO::PARAM_STR, 3000);
            $cmd->bindParam(':page_type', $page_type, PDO::PARAM_STR, 30);
            $cmd->bindParam(':extracontent', $extracontent, PDO::PARAM_STR, 2000);

             // fill the page_id if we have one
            if (!empty($page_id)) {
                $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
            }
            // execute the command
            $cmd->execute();
            // disconnect from the database
            $conn = null;
            // show confirmation
            echo "Page Saved";
        }

                //redirect the user
        header('location:pages.php');

        require_once('footer.php');
    }
catch (Exception $e) {
    mail('bryanfox1986@gmail.com', 'Save Page Error', $e);
    header('location:error.php');
}
    ob_flush();
    ?>


