<?php
session_start();
include 'db.php';

$error = "";
$user = trim($_POST['username']);
$pass = trim($_POST['password']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM admins WHERE username='$user'");
    $row = mysqli_fetch_assoc($result);

    // 🔥 TEMP FIX (if password not hashed)
    if ($row && ($pass == $row['password'] || password_verify($pass, $row['password']))) {

        $_SESSION['admin'] = $row['username'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>