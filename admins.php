<?php
//purpose of this page is to display all the admins currently created in the database
    ob_start();
    //authentication check
    require_once('auth.php');

    //set the page title
    $page_title = null;
    $page_title = 'Registered Admins';

    //embed the header
    require_once('adminheader.php');

try {
    //connect
    require_once('db.php');
    //prepare the query
    $sql = "SELECT * FROM users";
      
    //run the query and store the results
    $cmd = $conn->prepare($sql);
    $cmd -> execute();
    $admins = $cmd->fetchAll();
      
    echo ' <h1>Registered Administrators</h1>';
    //start the html display table
    echo '
    <div>
        <a href="register.php" title="Add a new administrator">Add a new Admin</a>
    </div>
    <table class="sortable"><thead><th>Username</th><th>Delete</th></thead><tbody>';
    //loop through the data and display the results
    foreach($admins as $admin){
        echo '<tr><td>' . $admin['username'] . '</td>
            <td><a onclick="return confirm(\'Are you sure you want to delete this Admin?\');" href="delete-admin.php?user_id=' . $admin['user_id'].'">Delete</a></td></tr>';
    }
    //close the grid
    echo '</tbody></table>';
    
    //disconnect
    $conn = null;
    }
catch (Exception $e) {
    mail('bryanfox1986@gmail.com', 'Error on Admins page', $e);
    //header('location:error.php');
}
    //embed footer
    require_once('footer.php');
    ob_flush();
?>
