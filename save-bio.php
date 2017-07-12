<?php
    ob_start();
    //auth check
    require_once('auth.php');

    $page_title = null;
    $page_title = 'Saving your Bio Photo';
    try{
        require_once('adminheader.php');
                // name
        $name = $_FILES['upload']['name'];
        echo "Name $name<br >";
        // size
        $size = $_FILES['upload']['size'];
        echo "Size $size<br />";
        // type
        $type = $_FILES['upload']['type'];
        echo "Type $type<br />";
        // get the temp location
        $tmp_name = $_FILES['upload']['tmp_name'];
        echo "Tmp Name $tmp_name<br />";
        // copy file to the uploads folder where it will stay permanently
        move_uploaded_file($tmp_name, "images/bio.jpeg");
        }

                //redirect the user
     //  header('location:logo.php');
catch (Exception $e) {
    mail('bryanfox1986@gmail.com', 'Save Logo Error', $e);
    header('location:error.php');
}
  require_once('footer.php');
    ob_flush();
    ?>


