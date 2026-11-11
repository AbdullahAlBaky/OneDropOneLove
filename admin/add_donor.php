<?php
session_start();
include '../db.php';


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../auth.php");
    exit();
}

$msg = "";


if(isset($_POST['add'])){

    $name = $_POST['name'];
    $blood = $_POST['blood'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    
    $check = mysqli_query($conn, "SELECT * FROM donors WHERE phone='$phone'");

    if(mysqli_num_rows($check) > 0){
        $msg = "❌ Donor already exists!";
    }else{
        mysqli_query($conn, "INSERT INTO donors(name,blood_group,phone,location,status)
        VALUES('$name','$blood','$phone','$location','active')");

        $msg = "✅ Donor Added Successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Donor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(to right,#ff416c,#ff4b2b);
}

.card{
    border-radius:15px;
    padding:20px;
    box-shadow:0 0 15px rgba(0,0,0,0.2);
}

.btn{
    transition:0.3s;
}
.btn:hover{
    transform: scale(1.05);
}
</style>

</head>

<body>

<div class="container mt-5">

<div class="col-md-6 mx-auto">

<div class="card">

<h3 class="text-center mb-4">🩸 Add New Donor</h3>

<?php if($msg): ?>
<div class="alert alert-info text-center"><?= $msg ?></div>
<?php endif; ?>

<form method="post" id="donorForm">

<input type="text" name="name" class="form-control mb-3" placeholder="Full Name" required>

<select name="blood" class="form-control mb-3">
<option value="">Select Blood Group</option>
<option>A+</option><option>B+</option><option>O+</option><option>AB+</option>
<option>A-</option><option>B-</option><option>O-</option><option>AB-</option>
</select>

<input type="text" name="phone" id="phone" class="form-control mb-3" placeholder="Phone Number" required>

<input type="text" name="location" class="form-control mb-3" placeholder="Location" required>

<button name="add" class="btn btn-danger w-100">➕ Add Donor</button>

</form>

<div class="text-center mt-3">
<a href="dashboard.php" class="btn btn-dark btn-sm">⬅ Back</a>
</div>

</div>

</div>

</div>

<!-- 🔥 JAVASCRIPT -->
<script>


document.getElementById("donorForm").addEventListener("submit", function(e){

    let phone = document.getElementById("phone").value;

    if(phone.length < 10){
        alert("❌ ফোন নাম্বার ঠিক না!");
        e.preventDefault();
    }

});


<?php if($msg == "✅ Donor Added Successfully!"): ?>
alert("🎉 Donor Added Successfully!");
<?php endif; ?>

</script>

</body>
</html>