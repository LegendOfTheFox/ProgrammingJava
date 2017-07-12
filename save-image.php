<?php
    ob_start();
    //auth check
    require_once('auth.php');

    $page_title = null;
    $page_title = 'Saving your Photo';
    try{
        require_once('header.php');

        // save form inputs into variables
        $title = $_POST['title'];
        $info = $_POST['info'];
        //$photo_id = $_POST['photo_id'];
        
        $photo = null;

        
        //process photo upload if there is one
        if (!empty($_FILES['photo'])){
            $photo = $_FILES['photo']['name'];

            if ($_FILES['photo']['type'] != 'image/jpeg'){
                echo 'Invalid photo<br />';
                $ok = false;
            }
            else {
                //valid photo
                echo 'Valid Photo';
                session_start();
                $final_name = session_id() . '_' . $photo;
                $tmp_name = $_FILES['photo']['tmp_name'];
                move_uploaded_file($tmp_name, "images/$final_name");
            }
        }

        // create a variable to indicate if the form data is ok to save or not
        $ok = true;

        // check each value
        if (empty($title)) {
            // notify the user
            echo 'Title is required<br />';

            // change $ok to false so we know not to save
            $ok = false;
        }

        if (empty($info)) {
            // notify the user
            echo 'Some info is required!<br />';

            // change $ok to false so we know not to save
            $ok = false;
        }

        // check the $ok variable and save the data if $ok is still true
        if ($ok == true) {

                //connection line to database
            require_once('db.php');

             if (empty($photo_id)) {
                 // set up the SQL INSERT command
            $sql = "INSERT INTO tbl_gallery (title, info, photo) VALUES (:title, :info, :photo)";
             }
            else {
                // set up the SQL UPDATE command to modify the existing page
                 $sql = "UPDATE tbl_gallery SET title = :title, info = :info, photo = :photo WHERE photo_id = :photo_id";
            }
            // create a command object and fill the parameters with the form values
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':title', $title, PDO::PARAM_STR, 25);
            $cmd->bindParam(':info', $info, PDO::PARAM_STR, 300);
            $cmd->bindParam(':photo', $final_name, PDO::PARAM_STR, 100);

             // fill the page_id if we have one
            if (!empty($photo_id)) {
                $cmd->bindParam(':photo_id', $photo_id, PDO::PARAM_INT);
            }
            // execute the command
            $cmd->execute();
            // disconnect from the database
            $conn = null;
            // show confirmation
            echo $final_name;
            echo "Photo Saved";
        }

                //redirect the user
       header('location:images.php');

        require_once('footer.php');
    }
catch (Exception $e) {
    mail('bryanfox1986@gmail.com', 'Save Photo Error', $e);
    header('location:error.php');
}
    ob_flush();
    ?>


