<?php
    ob_start();
    //authentication check
    require_once('auth.php');
    //set the page title
    $page_title = null;
    $page_title = 'Upload a site logo';
    require_once('adminheader.php');
?>

<div>
    <h1>Upload your Logo</h1>
    <form method="post" action="save-logo.php" enctype="multipart/form-data">
        <fieldset>
            <label for="logo">Logo:</label>
            <input type="file" id="upload" name="upload" />
        </fieldset>
        <button type="submit">Submit</button>
    </form>
    <h1>Upload your Biography Photo</h1>
    <form method="post" action="save-bio.php" enctype="multipart/form-data">
        <fieldset>
            <label for="logo">Photo:</label>
            <input type="file" id="upload" name="upload" />
        </fieldset>
        <button type="submit">Submit</button>
    </form>
</div>


<?php
//embed footer
require_once('footer.php');
ob_flush();
?>