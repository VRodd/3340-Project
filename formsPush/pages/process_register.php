<?php
//start open session for user persistence
session_start();
include '../db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //start sanitize form inputs for safety
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; 
    $confirm = $_POST['confirm'];

    //start verify that both password fields match
    if ($password !== $confirm) {
        die("Passwords do not match! <a href='register.php'>Try again</a>");
    }

    //start ensure email is not already registered
    $check = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($check->num_rows > 0) {
        die("Email already exists. <a href='login.php'>Log in here</a>");
    }

    //start insert new record into the users table
    $sql = "INSERT INTO users (name, email, password, status) VALUES ('$name', '$email', '$password', 'active')";

    if ($conn->query($sql) === TRUE) {
        //start store user details in session and redirect home
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        
        header("Location: ../index.php");
        exit();
    } else {
        //start output database error if insertion fails
        echo "Database error: " . $conn->error;
    }
}
?>