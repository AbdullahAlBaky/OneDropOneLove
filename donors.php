<?php
session_start();
include 'db.php';
include 'navbar.php';
include 'sidebar.php';

// search + filter
$where = "";

if (isset($_GET['search']) && $_GET['search'] != "") {
    $s = $_GET['search'];
    $where .= " (name LIKE '%$s%' OR phone LIKE '%$s%' OR blood_group LIKE '%$s%') ";
}

if (isset($_GET['blood']) && $_GET['blood'] != "") {
    $b = $_GET['blood'];
    if ($where != "") $where .= " AND ";
    $where .= " blood_group='$b' ";
}

$query = "SELECT * FROM donors";
if ($where != "") {
    $query .= " WHERE $where";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Donors</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2 class="mb-3">📋 Donor List</h2>

<!-- Search + Filter -->
<form method="get" class="row mb-3">
    <div class="col-md-6">
        <input type="text" name="search" placeholder="Search name / phone / blood" 
        class="form-control" value="<?= $_GET['search'] ?? '' ?>">
    </div>

    <div class="col-md-4">
        <select name="blood" class="form-control">
            <option value="">All Blood</option>
            <option>A+</option><option>A-</option>
            <option>B+</option><option>B-</option>
            <option>O+</option><option>O-</option>
            <option>AB+</option><option>AB-</option>
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-danger w-100">Search</button>
    </div>
</form>

<!-- Table -->
<div class="card p-3">
    <input type="text" id="search" class="form-control mb-3" placeholder="🔍 Search donor...">
<table class="table table-bordered table-hover text-center">

<tr class="table-dark">
    <th>ID</th>
    <th>Name</th>
    <th>Blood</th>
    <th>Phone</th>
    <th>Status</th>
    <th>Last Donation</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>

<tr>
    <td><?= $row['id']; ?></td>
    <td><?= $row['name']; ?></td>
    <td><strong><?= $row['blood_group']; ?></strong></td>
    <td><?= $row['phone']; ?></td>

    <!-- Status -->
    <td>
        <?php if($row['status'] == 'active'): ?>
            <span class="badge bg-success">Available</span>
        <?php else: ?>
            <span class="badge bg-danger">Busy</span>
        <?php endif; ?>
    </td>

    <!-- Last Donation -->
    <td><?= $row['last_donation']; ?></td>

    <!-- Actions -->
    <td>
        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="?delete=<?= $r['id'] ?>" 
onclick="return confirm('Are you sure?')" 
class="btn btn-danger btn-sm">Delete</a>
        onclick="return confirm('Delete this donor?')">Delete</a>
    </td>
</tr>

<?php endwhile; ?>

</table>
</div>

<?php include 'footer.php'; ?>
<script>
document.getElementById("search").addEventListener("keyup", function() {

    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("table tr");

    rows.forEach((row, index) => {
        if(index === 0) return;

        let text = row.innerText.toLowerCase();

        if(text.includes(value)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });

});
</script>
<script>
document.getElementById("bloodFilter").addEventListener("change", function() {

    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("table tr");

    rows.forEach((row, index) => {
        if(index === 0) return;

        let text = row.innerText.toLowerCase();

        if(value === "" || text.includes(value)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });

});
</script>
</body>
</html>