<?php
session_start();

// 🔒 LOGIN CHECK
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'user'){
    header("Location: auth.php");
    exit();
}

include 'db.php';
include 'navbar.php';
include 'sidebar.php';

// chart data
$bloodData = [];
$q = mysqli_query($conn, "SELECT blood_group, COUNT(*) as total FROM donors GROUP BY blood_group");
while($row = mysqli_fetch_assoc($q)){
    $bloodData[$row['blood_group']] = $row['total'];
}

// counts
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM donors"))['t'];
$available = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM donors WHERE status='active'"))['t'];
$requests = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM requests"))['t'];
$pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM requests WHERE status='pending'"))['t'];

// today request
$today = date("Y-m-d");
$today_q = mysqli_query($conn, "SELECT COUNT(*) as t FROM requests WHERE DATE(created_at)='$today'");
$today_req = $today_q ? mysqli_fetch_assoc($today_q)['t'] : 0;

$percent = $total > 0 ? round(($available/$total)*100) : 0;

// notification
$pending_req = $pending;
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.card {
    border-radius: 15px;
    transition: 0.3s;
}
.card:hover {
    transform: scale(1.05);
}
.bg-gradient1 { background: linear-gradient(45deg,#36d1dc,#5b86e5); color:white; }
.bg-gradient2 { background: linear-gradient(45deg,#11998e,#38ef7d); color:white; }
.bg-gradient3 { background: linear-gradient(45deg,#f7971e,#ffd200); color:black; }
.bg-gradient4 { background: linear-gradient(45deg,#ff416c,#ff4b2b); color:white; }
</style>

</head>

<body class="container mt-4">

<!-- NOTIFICATION -->
<?php if($pending_req > 0): ?>
<div class="alert alert-warning text-center">
🔔 <?= $pending_req ?> New Blood Request Pending!
</div>
<?php endif; ?>

<h2 class="text-center mb-4">📊 Smart Dashboard</h2>

<!-- CARDS -->
<div class="row text-center">

<div class="col-md-3">
<div class="card bg-gradient1 p-3">
<h5>Total Donors</h5>
<h2><?= $total ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card bg-gradient2 p-3">
<h5>Available</h5>
<h2><?= $available ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card bg-gradient3 p-3">
<h5>Total Requests</h5>
<h2><?= $requests ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card bg-gradient4 p-3">
<h5>Pending</h5>
<h2><?= $pending ?></h2>
</div>
</div>

</div>

<br>

<!-- Progress -->
<div class="card p-3 mb-4">
<h5>🟢 Availability Rate</h5>
<div class="progress">
  <div class="progress-bar bg-success" style="width: <?= $percent ?>%">
    <?= $percent ?>%
  </div>
</div>
</div>

<!-- Today -->
<div class="card p-3 mb-4">
<h5>📅 Today’s Requests</h5>
<h3><?= $today_req ?></h3>
</div>

<!-- CHARTS -->
<div class="row">

<div class="col-md-6">
<div class="card p-4">
<h5 class="text-center">Blood Distribution</h5>
<canvas id="chart"></canvas>
</div>
</div>

<div class="col-md-6">
<div class="card p-4">
<h5 class="text-center">Donor Statistics</h5>
<canvas id="barChart"></canvas>
</div>
</div>

</div>

<!-- BLOOD COMPATIBILITY -->
<div class="card p-4 mt-4">
<h4 class="text-center mb-4">🩸 Blood Type Compatibility</h4>

<div class="row text-center">

<?php
$bloods = [
"O-" => "8 types",
"O+" => "4 types",
"A-" => "4 types",
"A+" => "2 types",
"B-" => "4 types",
"B+" => "2 types",
"AB-" => "2 types",
"AB+" => "1 type"
];

foreach($bloods as $type => $count){
?>

<div class="col-md-3 mb-3">
<div class="p-3 border rounded shadow-sm" style="background:#fff5f5;">
<h3 style="color:red;"><?= $type ?></h3>
<p>Can donate to</p>
<strong><?= $count ?></strong>
</div>
</div>

<?php } ?>

</div>

<div class="alert alert-primary mt-3">
<b>O-</b> is universal donor. <b>AB+</b> is universal recipient.
</div>

<!-- 💬 CHAT BUTTON -->
<div id="chatBtn">💬</div>

<!-- 💬 CHATBOX -->
<div id="chatBox">
    <div id="chatHeader">
        🤖 Blood Assistant
        <span onclick="toggleChat()" style="float:right;cursor:pointer;">✖</span>
    </div>

    <div id="chatBody"></div>

    <div class="chatInputBox">
    <input type="text" id="userInput" placeholder="Ask something...">
    <button onclick="sendMsg()">➤</button>
</div>
</div>
<style>
#chatBtn{
    position:fixed;
    bottom:20px;
    right:20px;
    background:#ff416c;
    color:white;
    width:60px;
    height:60px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    cursor:pointer;
    font-size:22px;
    z-index:9999;
}

#chatBox{
    display:none;
    position:fixed;
    bottom:90px;
    right:20px;
    width:320px;
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 0 15px rgba(0,0,0,0.3);
    z-index:9999;
}

#chatHeader{
    background:#ff416c;
    color:white;
    padding:10px;
    font-weight:bold;
}

#chatBody{
    height:250px;
    overflow-y:auto;
    padding:10px;
}

#userInput{
    flex:1;
    border:none;
    padding:10px;
    outline:none;
}

.chatInputBox{
    display:flex;
}
</style>
<!-- JS -->
<script>
// Doughnut chart
new Chart(document.getElementById("chart"), {
    type: 'doughnut',
    data: {
        labels: ['A+','B+','O+','AB+'],
        datasets: [{
            data: [10,5,8,3],
            backgroundColor: ['red','blue','green','orange']
        }]
    }
});

// Bar chart (dynamic)
let labels = <?php echo json_encode(array_keys($bloodData)); ?>;
let values = <?php echo json_encode(array_values($bloodData)); ?>;

new Chart(document.getElementById("barChart"), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Donors',
            data: values,
            backgroundColor: ['red','blue','green','orange','purple','cyan']
        }]
    }
});

// Notification popup
if(<?= $pending_req ?> > 0){
    alert("🔔 <?= $pending_req ?> new blood request pending!");
}
</script>
<script>

function toggleChat(){
    let box = document.getElementById("chatBox");

    if(box.style.display === "block"){
        box.style.display = "none";
    } else {
        box.style.display = "block";
    }
}

document.getElementById("chatBtn").onclick = toggleChat;

// Enter key send
document.addEventListener("DOMContentLoaded", function(){

    document.getElementById("chatBtn").onclick = toggleChat;

    document.getElementById("userInput").addEventListener("keypress", function(e){
        if(e.key === "Enter"){
            sendMsg();
        }
    });

});

function sendMsg(){

    let input = document.getElementById("userInput");
    let msg = input.value.trim();

    if(msg === "") return;

    let chat = document.getElementById("chatBody");

    chat.innerHTML += `<div><b>You:</b> ${msg}</div>`;

    let reply = getReply(msg);

    setTimeout(()=>{
        chat.innerHTML += `<div><b>Bot:</b> ${reply}</div>`;
        chat.scrollTop = chat.scrollHeight;
    },400);

    input.value = "";
}

// 🧠 SMART LOGIC
function getReply(msg){

    msg = msg.toLowerCase();

    if(msg.includes("blood group")){
        return "Available groups: A+, B+, O+, AB+, A-, B-, O-, AB- 🩸";
    }

    if(msg.includes("request")){
        return "Go to Request page to send blood request 🚑";
    }

    if(msg.includes("donor")){
        return "You can search donors from dashboard 🔍";
    }

    if(msg.includes("location")){
        return "Make sure to enter correct location for better matching 📍";
    }

    if(msg.includes("urgent") || msg.includes("critical")){
        return "🚨 Please mark request as CRITICAL for fast response!";
    }

    if(msg.includes("hello") || msg.includes("hi")){
        return "Hello 👋 I am your Blood Assistant. How can I help?";
    }

    if(msg.includes("thank")){
        return "❤️ Always here to help!";
    }

    // default smart reply
    return "🤖 I can help with donor search, blood request, and system usage!";
}

</script>

<?php include 'footer.php'; ?>

</body>
</html>