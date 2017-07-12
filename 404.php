<?php
    ob_start();
    //set the page title
    $page_title = null;
    $page_title = ' Page Not Found';
    require_once('header.php');
?>
<main>

     <h1>Something went terribly wrong!</h1>

     <p>Your page can not be found, perhaps try again soon.</p>

</main>
<?php
//embed footer
require_once('footer.php');
ob_flush();
?>