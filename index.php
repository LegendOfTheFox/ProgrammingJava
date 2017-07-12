<?php
ob_start();
//set the page title
$page_title = null;
$page_title = 'Main';
//pull in the header
require_once('header.php');
//connect to the database and pull the first database entry

//connect
require_once('db.php');
//prepare the query

//if no page_id exists just load the first entry in the database for now
if (empty($_GET['page_id']) != false) {
    $sql = "SELECT * FROM tbl_pages WHERE page_id = 1";
    //run the query and store the results
    $cmd = $conn->prepare($sql);
    $cmd -> execute();
    $pages = $cmd->fetch();
    echo '<section>';
    echo '<h1>' . $pages['title'] . "</h1>";
    echo $pages['content'];
    echo '/<section>';
} else{
   
    $page_id = $_GET['page_id'];
    $sql = "SELECT * FROM tbl_pages WHERE page_id = $page_id";
    //run the query and store the results
    $cmd = $conn->prepare($sql);
    $cmd -> execute();
    $pages = $cmd->fetch();
    //later on make this modular for different page types being parsed and displayed
    //wrap this in a if statement to control it or loop through
    if($pages['page_type'] == "regular"){
        echo '<section>';
        echo '<h1>' . $pages['title'] . "</h1>";
        ?>
        <p>
        <?php echo $pages['content']; ?>
        </p>
        <?php
        echo '</section>';
    }
    
    if($pages['page_type'] == "gallery"){
        echo '<section>';
        echo '<h1>' . $pages['title'] . "</h1>";
        ?>
        <p>
        <?php echo $pages['content']; ?>
        </p>
        <?php
        echo '<br />';
            //show uploaded images
        $sql = "SELECT photo_id, title, photo FROM tbl_gallery WHERE photo IS NOT NULL";

        $cmd = $conn->prepare($sql);
        $cmd->execute();
        $photos = $cmd->fetchAll();
        //loop through and display each movie wrapped in a div
        foreach ($photos as $photo){
            echo '<img class="thumbnail" src="images/' . $photo['photo'] . '" title="' . $photo['title'] . '" height="300" />';
        }
        echo'</section>';
        
    }
    
     if($pages['page_type'] == "bio"){
         echo '<section>';
         echo '<h1>' . $pages['title'] . "</h1>";
         
         echo '<p>';
         echo '<aside>';
         echo '<img src="images/bio.jpeg" alt="BioPicture" width="75%"/>';
         echo $pages['extracontent'];
         echo '</aside>';
         echo '</p>';
         
         echo '<p>';
         echo $pages['content'];
         echo '</p>';
         
         echo'</section>';
    }
    
//    echo '<section>';
//    echo '<h1>' . $pages['title'] . "</h1>";
//    echo $pages['content'];
//    echo '</section>';
    
}

require_once('footer.php');
ob_flush();
?>