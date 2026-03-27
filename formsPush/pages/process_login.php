<?php
//start initialize session to store user data
session_start();
include '../db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //start sanitize user inputs for security
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    //start query database for matching user credentials
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        
        //start save user name and email to session
        $_SESSION['name'] = $user_data['name']; 
        $_SESSION['email'] = $user_data['email']; 
        
        //start redirect to homepage on successful login
        header("Location: ../index.php"); 
        exit();
    } else {
        //start return to login page with error status
        header("Location: login.php?error=invalid");
        exit();
    }
}
?>