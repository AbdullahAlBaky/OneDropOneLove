<?php
session_start();

// ✅ FIXED SESSION CHECK
if(!isset($_SESSION['user']) || $_SESSION['role'] != 'admin'){
    header("Location: ../auth.php");
    exit();
}

include '../db.php';

// pending count
$pending = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM requests WHERE status='pending'"))['t'];
?>

<nav class="navbar navbar-dark bg-dark p-3">
    <span class="text-white">👑 Admin Panel</span>

    <div class="d-flex align-items-center gap-2">

        <a href="dashboard.php" class="btn btn-light btn-sm">Dashboard</a>
        <a href="donors.php" class="btn btn-light btn-sm">Donors</a>
        <a href="requests.php" class="btn btn-light btn-sm">Requests</a>
        <a href="add_donor.php" class="btn btn-success btn-sm">+ Add Donor</a>

        <!-- 🔔 Notification Bell -->
        <div style="position:relative; cursor:pointer;" onclick="toggleNotif()">
            🔔
            <span id="notif"
            style="position:absolute;top:-5px;right:-10px;background:red;color:white;border-radius:50%;padding:2px 6px;font-size:12px;">
                <?= $pending ?>
            </span>
        </div>

        <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<!-- 🔔 Dropdown -->
<div id="notifBox" style="display:none;position:absolute;right:20px;top:70px;width:300px;background:white;padding:10px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.2);">

<h6>Notifications</h6>

<?php
$q = mysqli_query($conn,"SELECT * FROM requests WHERE status='pending' ORDER BY id DESC LIMIT 5");
while($r = mysqli_fetch_assoc($q)){
?>
<div style="border-bottom:1px solid #eee;padding:5px;">
🩸 <?= $r['blood_group'] ?> - <?= $r['location'] ?>
</div>
<?php } ?>

</div>

<!-- 🔊 SOUND -->
<audio id="alertSound" src="../alert.mp3"></audio>

<script>
// 🔔 dropdown toggle
function toggleNotif(){
    let box = document.getElementById("notifBox");
    box.style.display = (box.style.display === "block") ? "none" : "block";
}

// 🔥 LIVE NOTIFICATION
let lastCount = <?= $pending ?>;

setInterval(() => {

    fetch("../check_requests.php")
    .then(res => res.text())
    .then(count => {

        let bell = document.getElementById("notif");
        bell.innerText = count;

        // 🔊 + 🔴 blink
        if(count > lastCount){

            document.getElementById("alertSound").play();

            bell.style.background = "yellow";

            setTimeout(()=>{
                bell.style.background = "red";
            }, 500);
        }

        lastCount = count;

    });

}, 5000);
</script>