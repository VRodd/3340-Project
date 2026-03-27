<?php
//start enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //start sanitize the email input
    $email = $conn->real_escape_string($_POST['subscriber_email']);

    //start insert email into the database table
    $sql = "INSERT INTO email (email) VALUES ('$email')";

    if ($conn->query($sql) === TRUE) {
        //start redirect back to homepage on success
        header("Location: index.php?subscribed=success");
        exit();
    } else {
        //start stop execution and show database error
        die("Database Error: " . $conn->error);
    }
} else {
    //start handle direct access without post data
    echo "No data received. Please use the form on the homepage.";
}
?>