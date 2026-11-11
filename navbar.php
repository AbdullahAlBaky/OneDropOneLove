<?php
include 'db.php';


$pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM requests WHERE status='pending'"))['t'];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">🩸 One Drop One Love</a>

    <div class="d-flex align-items-center gap-2">

      <a href="dashboard.php" class="btn btn-light btn-sm">Dashboard</a>
      <a href="donors.php" class="btn btn-light btn-sm">Donors</a>
      <a href="add_donor.php" class="btn btn-light btn-sm">Add Donor</a>
      <a href="compatibility.php" class="btn btn-light btn-sm">Compatibility</a>
      <a href="faq.php" class="btn btn-light btn-sm">FAQ</a>

      
      <div style="position:relative; cursor:pointer;" onclick="toggleNotif()">

        <span style="font-size:20px;">🔔</span>
        🔔 <span id="notif">0</span>

        <?php if($pending > 0): ?>
        <span style="
            position:absolute;
            top:-5px;
            right:-10px;
            background:black;
            color:white;
            border-radius:50%;
            padding:2px 6px;
            font-size:12px;
        ">
            <?= $pending ?>
        </span>
        <?php endif; ?>

      </div>

      <!-- REQUEST BUTTON -->
      <a href="requests.php" class="btn btn-light btn-sm">Requests</a>

      <a href="logout.php" class="btn btn-dark btn-sm">Logout</a>
    </div>
  </div>
</nav>


<div id="notifBox" style="
display:none;
position:absolute;
right:20px;
top:70px;
width:300px;
background:white;
box-shadow:0 0 10px rgba(0,0,0,0.2);
border-radius:10px;
padding:10px;
z-index:999;
">

<h6>🔔 Notifications</h6>

<?php
$n = mysqli_query($conn, "SELECT * FROM requests WHERE status='pending' ORDER BY id DESC LIMIT 5");

while($r = mysqli_fetch_assoc($n)){
?>

<div style="border-bottom:1px solid #eee; padding:5px;">
🩸 <?= $r['blood_group'] ?> needed<br>
<small><?= $r['location'] ?></small>
</div>

<?php } ?>

</div>


 
<script>
function toggleNotif(){
    let box = document.getElementById("notifBox");
    box.style.display = (box.style.display === "block") ? "none" : "block";
}
</script>