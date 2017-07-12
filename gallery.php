<?php
    //set the page title
    $page_title = 'Gallery';
    //authentication check
    require_once('auth.php');
    //bring in the header
    require_once('adminheader.php');
try{
    

    //connect
    require_once('db.php');

    //show uploaded images
    $sql = "SELECT photo_id, title, photo FROM tbl_gallery WHERE photo IS NOT NULL";

    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $photos = $cmd->fetchAll();
    echo '<section>';
    echo  '<h1>Uploaded Images</h1><main class="container">' ; 
    //loop through and display each movie wrapped in a div
    foreach ($photos as $photo){
        echo '<div>
        <a href="image.php?photo_id=' . $photo['photo_id'] . '" title="Photo Details">
        <img class="thumbnail" src="images/' . $photo['photo'] . '" title="' . $photo['title'] . '" />
        </a></div>';
    }
    echo '</section>';

    echo  '</main>' ;
    //disconnect from database
    $conn = null;
}
catch (Exception $e) {
    mail('bryanfox1986@gmail.com', 'Error on Gallery Page', $e);
    header('location:error.php');
}

?>

<?php
//require_once('footer.php');
?>