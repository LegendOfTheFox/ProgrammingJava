<?php
    ob_start();
    //authentication check
    require_once('auth.php');
    //set the page title
    $page_title = null;
    $page_title = 'Main Menu';
    //embed the header
    require_once('adminheader.php');
?>
        <h1>Administrator Control Panel</h1>
            <section>
                <h2>Welcome to your Control Panel. Follow the links to add New Pages, Upload Images and manage Adminstrators on your site.</h2>
                <article>
                <p>To add new pages or view currently existing pages follow these links:</p>
                    <ul>
                        <li><a href="pages.php" title="View Web Pages">View Pages</a></li>
                        <li><a href="page.php" title="Add a Page">Add a New Page</a></li>
                    </ul>
                    </article>
                <article>
                    <p>To change your websites Logo,upload a Biography picture and upload images to the Gallery follow these links:</p>
                    <ul>
                        <li><a href="logo.php" title="Change Site Logo">Change Info</a></li>
                        <li><a href="image.php" title="Upload Images">Upload a Image</a></li>
                        <li><a href="images.php" title="View all Images">View all Images</a></li>
                        <li><a href="gallery.php" title="View Gallery">View Image Gallery</a></li>
                    </ul>
                </article>
                <article>
                    <p>To add, change or delete Administrators off your website follow these links:</p>
                    <ul>
                        <li><a href="register.php" title="Add Admin">Add Administrator</a></li>
                        <li><a href="admins.php" title="Upload Images">View all Administrators</a></li>
                    </ul>
                </article>
            </section>
<?php
//embed footer
require_once('footer.php');
ob_flush();
?>
        