<?php
    ob_start();
    //set the page title
    $page_title = null;
    $page_title = 'Yikes';
    require_once('header.php');
?>
<main>

     <h1>Sometimes things just break!</h1>

     <p>We're on it!  Our support team has been notified and will get right on it.</p>

</main>
<?php
//embed footer
require_once('footer.php');
ob_flush();
?>