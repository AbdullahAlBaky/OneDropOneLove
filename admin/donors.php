<?php include 'navbar.php'; include '../db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Donors</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h3>🩸 Donor List</h3>

<input type="text" id="search" class="form-control mb-3" placeholder="🔍 Search...">

<table class="table table-bordered" id="table">
<tr>
<th>Name</th>
<th>Blood</th>
<th>Phone</th>
<th>Location</th>
</tr>

<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../auth.php");
    exit();
}
$q = mysqli_query($conn,"SELECT * FROM donors");
while($d = mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $d['name'] ?></td>
<td><?= $d['blood_group'] ?></td>
<td><?= $d['phone'] ?></td>
<td><?= $d['location'] ?></td>
</tr>
<?php } ?>

</table>

<script>
document.getElementById("search").addEventListener("keyup", function(){
    let val = this.value.toLowerCase();
    document.querySelectorAll("#table tr").forEach((row,i)=>{
        if(i==0) return;
        row.style.display = row.innerText.toLowerCase().includes(val) ? "" : "none";
    });
});
</script>

</body>
</html>