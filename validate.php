<?php ob_start(); ?>

<!DOCTYPE html>
<html>
    <body>

        <?php
        session_start();
        // store the inputs & hash the password
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
                // connect
                require_once('db.php');

                // write the query
                $sql = "SELECT * FROM users WHERE username = :username";

                // create the command, run the query and store the result
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);

                $cmd->execute();
                $user = $cmd->fetch();
                $_SESSION['user_id'] = $user['user_id'];

                // if count is 1, we found a matching username in the database.  Now check the password
                //if (password_verify($password, $user['password'])) {
                if (password_verify($password, $user['password'])) {
                    // user found
                    header('location:adminmenu.php');
                }
                else {
                    // user not found
                    header('location:login.php?invalid=true');
                    exit();
                }
            //drop the connection
                $conn = null;
            }
        catch (Exception $e) {
                mail('bryanfox1986@gmail.com', 'Fail on Validate Page Error', $e);
                header('location:error.php');
            }
    ?>

    </body>
</html>
<?php ob_flush(); ?>