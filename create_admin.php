<?php
include 'db.php';

$username = "admin";
$password = password_hash("1234", PASSWORD_DEFAULT);

mysqli_query($conn, "INSERT INTO admins (username, password) VALUES ('$username','$password')");

echo "Admin Created!";
?>