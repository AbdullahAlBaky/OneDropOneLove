<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'donor'){
    header("Location: ../auth.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Donor Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(to right,#ff4b2b,#ff416c);
    color:white;
}

.card{
    border-radius:15px;
    transition:0.3s;
}
.card:hover{
    transform: translateY(-10px);
}

.top-box{
    text-align:center;
    margin-top:50px;
}

.status-btn{
    transition:0.3s;
}
.status-btn:hover{
    transform: scale(1.1);
}
</style>

</head>

<body>

<!-- HEADER -->
<div class="top-box">
    <h2>🩸 Donor Dashboard</h2>
    <p>Welcome, <?= $_SESSION['user'] ?> ❤️</p>
</div>

<!-- CARDS -->
<div class="container mt-5">
<div class="row text-center">

    <div class="col-md-4">
        <div class="card p-4 text-dark">
            <h4>📞 Contact Requests</h4>
            <p>People may contact you for blood</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 text-dark">
            <h4>📍 Your Location</h4>
            <p id="locationText">Detecting...</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 text-dark">
            <h4>🩸 Availability</h4>
            <button id="statusBtn" class="btn btn-success status-btn">Available</button>
        </div>
    </div>

</div>
</div>

<!-- ACTION BUTTONS -->
<div class="text-center mt-5">
    <a href="../request.php" class="btn btn-light m-2">📩 View Requests</a>
    <a href="../logout.php" class="btn btn-dark m-2">Logout</a>
</div>

<!-- JAVASCRIPT -->
<script>

// 🔄 Availability Toggle
let status = true;

document.getElementById("statusBtn").addEventListener("click", function(){
    status = !status;

    if(status){
        this.innerText = "Available";
        this.classList.remove("btn-danger");
        this.classList.add("btn-success");
    }else{
        this.innerText = "Not Available";
        this.classList.remove("btn-success");
        this.classList.add("btn-danger");
    }
});

// 📍 Auto Location Detect
if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition(function(pos){
        document.getElementById("locationText").innerText =
            "Lat: " + pos.coords.latitude + " | Lng: " + pos.coords.longitude;
    });
}else{
    document.getElementById("locationText").innerText = "Location not supported";
}

// 👋 Welcome Alert
setTimeout(()=>{
    alert("Welcome Donor ❤️ Ready to save lives!");
},1000);

</script>

</body>
</html>