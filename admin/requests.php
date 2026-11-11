<?php include 'navbar.php'; include '../db.php'; ?>

<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../auth.php");
    exit();
}
if(isset($_GET['approve'])){
    mysqli_query($conn,"UPDATE requests SET status='approved' WHERE id=".$_GET['approve']);
}
if(isset($_GET['reject'])){
    mysqli_query($conn,"UPDATE requests SET status='rejected' WHERE id=".$_GET['reject']);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Requests</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h3>🩸 Requests</h3>

<table class="table table-bordered">

<tr>
<th>Name</th>
<th>Blood</th>
<th>Location</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
$q = mysqli_query($conn,"SELECT * FROM requests ORDER BY id DESC");
while($r = mysqli_fetch_assoc($q)){
?>

<tr>
<td><?= $r['name'] ?></td>
<td><?= $r['blood_group'] ?></td>
<td><?= $r['location'] ?></td>
<td><?= $r['status'] ?? 'pending' ?></td>

<td>
<a href="?approve=<?= $r['id'] ?>" onclick="return confirmAction('approve')" class="btn btn-success btn-sm">Approve</a>
<a href="?reject=<?= $r['id'] ?>" onclick="return confirmAction('reject')" class="btn btn-danger btn-sm">Reject</a>
</td>

</tr>

<?php } ?>

</table>

<script>
function confirmAction(type){
    return confirm("Are you sure to " + type + " this request?");
}
</script>

</body>
</html>