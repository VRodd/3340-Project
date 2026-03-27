<?php
//start define database connection credentials
$host = "localhost";
$db   = "tavesb_store";
$user = "tavesb_store";
$pass = "6jmPY2kc5Y5D7mxaTLzz";

//start establish connection to the database
$conn = new mysqli($host, $user, $pass, $db);

//start check for any connection errors and stop
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>