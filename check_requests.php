<?php
include 'db.php';

$q = mysqli_query($conn, "SELECT COUNT(*) as t FROM requests WHERE status='pending'");
$row = mysqli_fetch_assoc($q);

echo $row['t'];
?>