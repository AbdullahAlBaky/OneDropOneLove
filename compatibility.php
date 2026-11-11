<!DOCTYPE html>
<html>
<head>
    <title>Blood Compatibility</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="text-center">🩸 Blood Compatibility Checker</h2>

<form method="post" class="card p-4 mt-4">

    <select name="blood" class="form-control mb-3" required>
        <option value="">Select Blood Group</option>
        <option>A+</option><option>A-</option>
        <option>B+</option><option>B-</option>
        <option>O+</option><option>O-</option>
        <option>AB+</option><option>AB-</option>
    </select>

    <button class="btn btn-danger">Check Compatibility</button>

</form>

<?php
include 'navbar.php';
include 'sidebar.php';
if ($_POST) {
    $blood = $_POST['blood'];

    $data = [
        "A+" => ["donate" => "A+, AB+", "receive" => "A+, A-, O+, O-"],
        "A-" => ["donate" => "A+, A-, AB+, AB-", "receive" => "A-, O-"],
        "B+" => ["donate" => "B+, AB+", "receive" => "B+, B-, O+, O-"],
        "B-" => ["donate" => "B+, B-, AB+, AB-", "receive" => "B-, O-"],
        "O+" => ["donate" => "A+, B+, O+, AB+", "receive" => "O+, O-"],
        "O-" => ["donate" => "All Blood Groups", "receive" => "O-"],
        "AB+" => ["donate" => "AB+", "receive" => "All Blood Groups"],
        "AB-" => ["donate" => "AB+, AB-", "receive" => "A-, B-, AB-, O-"]
    ];

    echo "<div class='card p-3 mt-4'>";
    echo "<h4>Result for $blood</h4>";
    echo "<p><strong>Can Donate To:</strong> ".$data[$blood]['donate']."</p>";
    echo "<p><strong>Can Receive From:</strong> ".$data[$blood]['receive']."</p>";
    echo "</div>";
}
?>

</body>
</html>