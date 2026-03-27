<?php
//start initialize the session to access data
session_start();

//start clear all session variables and destroy
$_SESSION = array();
session_destroy();

//start return the user to the homepage
header("Location: ../index.php");
exit();
?>