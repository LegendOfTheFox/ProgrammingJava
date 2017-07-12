<?php ob_start();
//access the existing session
session_start();
//remove all sessions vriables
session_unset();
//destroy the user session
session_destroy();
//redirect the login
header('location:login.php');
ob_flush();
?>