<?php
    ob_start();
    //authentication check
    require_once('auth.php');
    //set the page title
    $page_title = null;
    $page_title = 'Photo Details';
    require_once('header.php');
try{
    if (empty($_GET['photo_id']) == false) {
        $photo_id = $_GET['photo_id'];

        // connect
        require_once('db.php');

        // write the sql query
        $sql = "SELECT * FROM tbl_gallery WHERE photo_id = :photo_id";

        // execute the query and store the results
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':photo_id', $photo_id, PDO::PARAM_INT);
        $cmd->execute();
        $images = $cmd->fetchAll();

        // populate the fields for the selected movie from the query result
        foreach ($images as $image) {
            $title = $image['title'];
            $info = $image['info'];
            $photo = $image['photo'];
        }

        // disconnect
        $conn = null;
        }
    }
catch (Exception $e) {
    mail('bryanfox1986@gmail.com', 'Image Error', $e);
    header('location:error.php');
}
    
?>
        
<div class="container">
    <h1>Photo Details</h1>
    <form method="post" action="save-image.php" enctype="multipart/form-data">
        <fieldset>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo $title; ?>" required/>
        </fieldset>
        <fieldset>
            <label for="info">Info:</label>
            <textarea id="info" name="info" cols="90" rows="5" value="<?php echo $info; ?>"></textarea>
        </fieldset>
        <fieldset>
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" />
        </fieldset>
        <?php if(!empty($photo)){ ?>
            <div>
                <img src="images/<?php echo $photo; ?>" alt="book poster" />
            </div>
        <?php } ?>
        <input name="photo_id" type="hidden" value="<?php echo $photo_id; ?>" />
        <button type="submit">Submit</button>
    </form>
</div>
<?php
//embed footer
require_once('footer.php');
ob_flush();
?>