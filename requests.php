<?php
session_start();
include 'db.php';
include 'navbar.php';
include 'sidebar.php';


if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    mysqli_query($conn, "UPDATE requests SET status='completed' WHERE id=$id");
}

$requests = mysqli_query($conn, "SELECT * FROM requests ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2>📩 Blood Requests</h2>

<?php while($req = mysqli_fetch_assoc($requests)): ?>

<div class="card p-3 mb-3">

    <h5><?= $req['name']; ?> (<?= $req['blood_group']; ?>)</h5>
    <p>📞 <?= $req['phone']; ?> | 📍 <?= $req['location']; ?></p>

    
    <p>
        Status: 
        <?php if($req['status'] == 'pending'): ?>
            <span class="text-warning">Pending</span>
        <?php else: ?>
            <span class="text-success">Completed</span>
        <?php endif; ?>
    </p>

    
    <?php if($req['status'] == 'pending'): ?>
        <a href="requests.php?complete=<?= $req['id']; ?>" class="btn btn-success btn-sm">
            Mark as Completed
        </a>
    <?php endif; ?>

</div>

<?php endwhile; ?>

<?php include 'footer.php'; ?>

</body>
</html>