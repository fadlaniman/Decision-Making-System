<?php
include '../model/connection.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$result = $con->query("SELECT * FROM users where username = '$username'");
$user = $result->fetch_assoc();

if ($user['username'] == $username && $user['password'] == $password){
    $_SESSION['username'] = $username;
    header('location: http://localhost/spk/views/home.php');
}

else{
    header('location: http://localhost/spk/views/login.php');
}






