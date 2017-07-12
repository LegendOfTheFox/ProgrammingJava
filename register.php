<?php
$page_title = null;
$page_title = 'User Registration';
require_once('adminheader.php'); ?>
        <h1>Create a new account</h1>
        <form method="post" action="save-registration.php">
            <fieldset>
                <label for="username">Email:*</label>
                <input name="username" id="username" required type="email"/>
            </fieldset>
            <fieldset>
                <label for="password">Password:*</label>
                <input name="password" id="password" required type="password"/>
            </fieldset>
            <fieldset>
                <label for="confirm">Confirm Password:*</label>
                <input name="confirm" id="confirm" required type="password"/>
            </fieldset>
<!--            <div class="g-recaptcha" data-sitekey="6LfHLyMUAAAAAEsoyjBTaQjvGkyrmUcQtcDe6Etl"></div>-->
            <button >Submit</button>
        </form>
    </body>
</html>
<?php require_once('footer.php'); ?>