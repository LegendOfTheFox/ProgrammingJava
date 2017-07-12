<?php
    ob_start();
    //authentication check
    require_once('auth.php');
    //set the page title
    $page_title = null;
    $page_title = 'Page Details';
    require_once('adminheader.php');
try{
    if (empty($_GET['page_id']) == false) {
        $page_id = $_GET['page_id'];

        // connect
        require_once('db.php');

        // write the sql query
        $sql = "SELECT * FROM tbl_pages WHERE page_id = :page_id";

        // execute the query and store the results
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $cmd->execute();
        $pages = $cmd->fetchAll();

        // populate the fields for the selected page from the query result
        foreach ($pages as $page) {
            $title = $page['title'];
            $content = $page['content'];
            $page_type = $page['page_type'];
            $extracontent = $page['extracontent'];
        }

        // disconnect
        $conn = null;
        }
    }
catch (Exception $e) {
    mail('bryanfox1986@gmail.com', 'COMP1006 Web App Error', $e);
    header('location:error.php');
}
?>
        
<div class="container">
    <h1>Page Details</h1>
    <form method="post" action="save-page.php" enctype="multipart/form-data">
        <fieldset>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo $title; ?>" required/>
        </fieldset>
        <fieldset>
            <label for="content">Content:</label>
            <textarea id="content" name="content" cols="90" rows="5" value="<?php echo $content; ?>"></textarea>
        </fieldset>
        <fieldset>
            <label for="extracontent" >Extra Content:</label>
            <textarea id="extracontent" name="extracontent" cols="90" rows="5" value="<?php echo $extracontent; ?>"></textarea>
        </fieldset>
        <fieldset>
            <label for="page_type">Type: </label>
            <select name="page_type" id="page_type">
                <option value="choose">choose</option>
                <option value="regular">Regular</option>
                <option value="gallery">Gallery</option>
                <option value="bio">Biography</option>
            </select>
        </fieldset>
        <input name="page_id" type="hidden" value="<?php echo $page_id; ?>" />
        <button type="submit">Submit</button>
    </form>
</div>
<?php
//embed footer
require_once('footer.php');
ob_flush();
?>