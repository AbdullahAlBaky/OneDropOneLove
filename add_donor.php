<?php
session_start();
include 'db.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: auth.php");
    exit();
}

$msg = "";

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $blood = $_POST['blood'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    mysqli_query($conn,"INSERT INTO donors(name,blood_group,phone,location,status)
    VALUES('$name','$blood','$phone','$location','active')");

    $msg = "✅ Donor Added Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Donor</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(to right,#ff4b2b,#ff416c);
}

.form-box{
    max-width:500px;
    margin:auto;
    margin-top:80px;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 0 20px rgba(0,0,0,0.2);
    animation: fadeIn 0.8s ease;
}

button:hover{
    transform: scale(1.05);
    transition:0.3s;
}

@keyframes fadeIn{
    from{opacity:0; transform: translateY(30px);}
    to{opacity:1; transform: translateY(0);}
}
</style>
</head>

<body>

<div class="form-box">

<h3 class="text-center text-danger">🩸 Add Donor</h3>

<?php if($msg): ?>
<div class="alert alert-success"><?= $msg ?></div>
<?php endif; ?>

<form method="post" id="form">

<input name="name" id="name" class="form-control mb-3" placeholder="👤 Name" required>

<select name="blood" class="form-control mb-3">
<option value="">🩸 Select Blood</option>
<option>A+</option><option>B+</option><option>O+</option><option>AB+</option>
<option>A-</option><option>B-</option><option>O-</option><option>AB-</option>
</select>

<input name="phone" id="phone" class="form-control mb-3" placeholder="📞 Phone" required>

<input name="location" id="location" class="form-control mb-3" placeholder="📍 Location" required>

<button class="btn btn-danger w-100">➕ Add Donor</button>

</form>

</div>

<!-- JS VALIDATION -->
<script>
document.getElementById("form").addEventListener("submit", function(e){

    let name = document.getElementById("name").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let location = document.getElementById("location").value.trim();

    if(name === "" || phone === "" || location === ""){
        alert("❌ All fields required!");
        e.preventDefault();
        return;
    }

    // phone validation
    if(phone.length < 10){
        alert("❌ Invalid phone number!");
        e.preventDefault();
        return;
    }

    alert("✅ Donor Added Successfully!");
});
</script>

</body>
</html>