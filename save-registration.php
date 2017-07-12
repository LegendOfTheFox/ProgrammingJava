<?php
ob_start();

$page_title = null;
$page_title = 'Saving your Registration';

try {
        require_once('header.php');

        //get the form inputs
        $username = $_POST['username'];
        $password = $_POST{'password'};
        $confirm = $_POST['confirm'];
        $ok = true;

        //validate the inputs
        if (empty($username)){
            echo 'Username is required<br />';
            $ok = false;
        }
    
        //check if this username has been used already
        require_once('db.php');
        //prepare the query
        $sql = "SELECT user_id FROM users";
        //run the query and store the results
        $cmd = $conn->prepare($sql);
        $cmd -> execute();
        $admins = $cmd->fetchAll();
    
    //check against all the usernames in the database to see if the new one is already being used
        foreach($admins as $admin){
            if($admin['user_id'] = $username){
                $ok = false;
            }
        }
        if ($ok = false){
            echo 'This Username already exists!<br />';
        }

        if (empty($password)){
            echo 'Password is required<br />';
            $ok = false;
        }

        if ($password != $confirm){
            echo 'Password do not match<br />';
            $ok = false;
        }

    //set up values checking Recaptcha
    $secret = "6LfHLyMUAAAAAGIHgopyVXyXitJnh-R-xNbgxcN3";
    $response = $_POST['g-recaptcha-response'];
    
    //setup url request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    
    //set up an array to hold the two values
    $post_data = array();
    $post_data['secret'] = $secret;
    $post_data['response'] = $response;
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    
    //execute the curl request
    $result = curl_exec($ch);
    curl_close($ch);
    
    // convert the response from a json object to an array so we can read it
    $result_array = json_decode($result, true);
    
    //check if the success value is true or false
    if ($result_array['success'] == false){
        echo 'Are you human?';
        $ok = false;
    }
    
    //proceed if the inputs are complete
        if ($ok){
            //hash the password
            $password = password_hash($password, PASSWORD_DEFAULT);
            // set up and execute the insert
            require_once('db.php');
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR,50);
            $cmd->bindParam(':password', $password, PDO::PARAM_STR,255);
            $cmd->execute();
            //disconnect
            $conn = null;
            //show a message to the user
            echo 'Registration Saved';
        }

        require_once('footer.php');
    }
    catch (Exception $e) {
        mail('bryanfox1986@gmail.com', 'Save Registration Error', $e);
        header('location:error.php');
    }
    ob_flush();
?>
        
        
 