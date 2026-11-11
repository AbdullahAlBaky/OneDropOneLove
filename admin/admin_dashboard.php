<?php include 'navbar.php'; include '../db.php'; ?>

<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../auth.php");
    exit();
}

$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM donors"))['t'];
$requests = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM requests"))['t'];

$data = [];
$q = mysqli_query($conn,"SELECT blood_group, COUNT(*) as t FROM donors GROUP BY blood_group");
while($r = mysqli_fetch_assoc($q)){
    $data[$r['blood_group']] = $r['t'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="container mt-4">

<h3>📊 Admin Dashboard</h3>

<div class="row">

<div class="col-md-6">
<div class="card p-3 bg-danger text-white">
<h5>Total Donors</h5>
<h2><?= $total ?></h2>
</div>
</div>

<div class="col-md-6">
<div class="card p-3 bg-dark text-white">
<h5>Total Requests</h5>
<h2><?= $requests ?></h2>
</div>
</div>

</div>

<div class="card p-3 mt-4">
<canvas id="chart"></canvas>
</div>

<script>
let labels = <?php echo json_encode(array_keys($data)); ?>;
let values = <?php echo json_encode(array_values($data)); ?>;

new Chart(document.getElementById("chart"), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Donors',
            data: values,
            backgroundColor: ['red','blue','green','orange']
        }]
    }
});
</script>

</body>
</html>