<?php
//purpose of this page is to display all pages currently created in the database
    ob_start();
    //authentication check
    require_once('auth.php');

    //set the page title
    $page_title = null;
    $page_title = 'Page Editor';

    //embed the header
    require_once('adminheader.php');

    //check if the user entered keywords for serarching
    $keywords = null;

    if (!empty($_GET['keywords'])) {
    $keywords = $_GET['keywords'];
    }

try {
    //connect
    require_once('db.php');
    //prepare the query
    $sql = "SELECT * FROM tbl_pages";
    
    $word_list = null;
    // check if the user entered keywords for searching
    if (!empty($keywords)) {
         // start the WHERE clause MAKING SURE to include spaces around the word WHERE
         $sql .= " WHERE ";

         // split the keywords into an array of individual words
        $word_list = explode(" ", $keywords);

         // start a counter so we know which element in the array we are at
        $counter = 0;
        //get the search type from the form any or all?
        $search_type = $_GET['search_type'];
        // loop through the word list and add each word to the where clause individually
         foreach($word_list as $word) {

             $word_list[$counter] = "%" . $word . "%";
             // for the first word OMIT the word OR
             if ($counter == 0) {
             $sql .= " title LIKE ?";
             }
             else {
             $sql .= " $search_type title LIKE ?";
             }
             //increment the counter
            $counter++;
         }
    }
    
    //run the query and store the results
    $cmd = $conn->prepare($sql);
    $cmd -> execute($word_list);
    $pages = $cmd->fetchAll();
      
    echo ' <h1>Registered Pages</h1>';
    
    //start the html display table
    echo '
    <div>
        <a href="page.php" title="Create a new page">Add a new page</a>
    </div>
    <div>
        <form method="get" action="pages.php" value="<? php echo $keywords; ?>">
            <label for="keywords">Enter Keywords to Search:</label>
            <input name="keywords" />
            <select name="search_type">
                <option value="OR">Any Keyword</option>
                <option value="AND">All Keywords</option>
            </select>
            <button type="submit" class="btn btn-success">Search</button>
        </form>
    </div>
    <table class="sortable"><thead><th>Title</th><th>Type</th><th>Edit</th><th>Delete</th></thead><tbody>';
    //loop through the data and display the results
    foreach($pages as $page){
        echo '<tr><td>' . $page['title'] . '</td>
            <td>' . $page['page_type'] . '</td>
            <td><a href="page.php?page_id=' . $page['page_id'] . '">Edit</a>
            <td><a onclick="return confirm(\'Are you sure you want to delete this page?\');" href="delete-page.php?page_id=' . $page['page_id'].'">Delete</a></td></tr>';
    }
    //close the grid
    echo '</tbody></table>';
    
    //disconnect
    $conn = null;
    }
catch (Exception $e) {
    mail('bryanfox1986@gmail.com', 'Error on View Pages', $e);
    header('location:error.php');
}
    //embed footer
    require_once('footer.php');
    ob_flush();
?>
