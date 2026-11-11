<?php
include 'db.php';


$name = mysqli_real_escape_string($conn, $_POST['name']);
$blood = mysqli_real_escape_string($conn, $_POST['blood']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$msg = mysqli_real_escape_string($conn, $_POST['message']);
$priority = mysqli_real_escape_string($conn, $_POST['priority']);


if(empty($name) || empty($blood) || empty($phone) || empty($location)){
    echo "<div class='alert alert-danger'>❌ All fields are required!</div>";
    exit();
}

// 📩 EMAIL ALERT
$to = "admin@gmail.com"; // change করো
$subject = "New Blood Request";

$message = "New request from $name\n
Blood: $blood\n
Location: $location\n
Phone: $phone\n
Priority: $priority";

$headers = "From: noreply@blood.com";


@mail($to, $subject, $message, $headers);


mysqli_query($conn, "INSERT INTO requests 
(name, blood_group, phone, location, message, priority)
VALUES ('$name','$blood','$phone','$location','$msg','$priority')");

// ✅ SUCCESS MESSAGE
echo "<div class='alert alert-success'>✅ Request Sent Successfully!</div>";


if($priority == "Critical"){
    echo "<div class='alert alert-danger'>🚨 CRITICAL REQUEST! Immediate attention needed!</div>";
}


$match = [];

if($blood == "A+") $match = ["A+","A-","O+","O-"];
elseif($blood == "B+") $match = ["B+","B-","O+","O-"];
elseif($blood == "O+") $match = ["O+","O-"];
elseif($blood == "AB+") $match = ["A+","B+","O+","AB+","A-","B-","O-","AB-"];
elseif($blood == "A-") $match = ["A-","O-"];
elseif($blood == "B-") $match = ["B-","O-"];
elseif($blood == "O-") $match = ["O-"];
elseif($blood == "AB-") $match = ["A-","B-","AB-","O-"];

$in = "'" . implode("','", $match) . "'";


$q = mysqli_query($conn, "
SELECT * FROM donors 
WHERE blood_group IN ($in) 
AND status='active'
ORDER BY id DESC
");


echo "<h5 class='text-center mt-3'>🩸 Matching Donors</h5>";

// ❌ IF NO DONOR
if(mysqli_num_rows($q) == 0){
    echo "<div class='alert alert-warning text-center'>❌ No donors found</div>";
}

// ✅ LOOP
while($d = mysqli_fetch_assoc($q)){
?>

<div class="card p-2 mb-2 <?= ($d['location']==$location) ? 'border border-success' : '' ?>">
    <b><?= htmlspecialchars($d['name']) ?></b><br>
    🩸 <?= $d['blood_group'] ?><br>

    📞 <a href="tel:<?= $d['phone'] ?>" class="btn btn-success btn-sm">
        Call Now
    </a><br>

    📍 <?= htmlspecialchars($d['location']) ?>
</div>

<?php } ?>