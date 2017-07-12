<?php
$page_title = null;
$page_title = 'Login';
require_once('adminheader.php');
?>
<h1>Log In</h1>
        <form method="post" action="validate.php">
            <fieldset>
                <label for="username" class="col-sm-2">Username:</label>
                <input name="username" id="username" required />
            </fieldset>
            <fieldset>
                <label for="password" class="col-sm-2">Password:</label>
                <input name="password" id="password" type="password" required />
            </fieldset>
            <button>Login</button>
        </form>
    </body>
</html>
<?php require_once('footer.php'); ?>