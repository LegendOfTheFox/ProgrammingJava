<?php
//purpose of this page is to display all pages currently created in the database
    ob_start();
    //authentication check
    require_once('auth.php');

    //set the page title
    $page_title = null;
    $page_title = 'Image Gallery';

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
    $sql = "SELECT * FROM tbl_gallery";
    
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
    $photos = $cmd->fetchAll();
      
    echo ' <h1>Uploaded Images</h1>';
    //start the html display table
    echo '
    <div>
        <a href="image.php" title="Add a new photo">Add a new photo</a>
    </div>
    <div>
        <form method="get" action="images.php" value="<? php echo $keywords; ?>">
            <label for="keywords">Enter Keywords to Search:</label>
            <input name="keywords" />
            <select name="search_type">
                <option value="OR">Any Keyword</option>
                <option value="AND">All Keywords</option>
            </select>
            <button type="submit">Search</button>
        </form>
    </div>
    <table><thead><th>Title</th><th>Info</th><th>Edit</th><th>Delete</th></thead><tbody>';
    //loop through the data and display the results
    foreach($photos as $photo){
        echo '<tr><td>' . $photo['title'] . '</td>
            <td>' . $photo['info_type'] . '</td>
            <td><a href="image.php?photo_id=' . $photo['photo_id'] . '">Edit</a>
            <td><a onclick="return confirm(\'Are you sure you want to delete this page?\');" href="delete-photo.php?photo_id=' . $photo['photo_id'].'">Delete</a></td></tr>';
    }
    //close the grid
    echo '</tbody></table>';
    
    //disconnect
    $conn = null;
    }
catch (Exception $e) {
    mail('bryanfox1986@gmail.com', 'Error on Images page', $e);
    header('location:error.php');
}
    //embed footer
    require_once('footer.php');
    ob_flush();
?>
