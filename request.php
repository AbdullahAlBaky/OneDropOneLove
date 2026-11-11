<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #ff4b2b, #ff416c);
        }
        .form-box {
            max-width: 500px;
            margin: auto;
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<div class="form-box">

    <h3 class="text-center text-danger">🩸 Blood Request</h3>
    <p class="text-center">Emergency Request</p>

    
    <form id="requestForm">

        <input type="text" name="name" placeholder="👤 Your Name" class="form-control mb-3" required>

        <select name="blood" class="form-control mb-3" required>
            <option value="">Select Blood</option>
            <option>A+</option>
            <option>A-</option>
            <option>B+</option>
            <option>B-</option>
            <option>O+</option>
            <option>O-</option>
            <option>AB+</option>
            <option>AB-</option>
        </select>

        <input type="text" name="phone" placeholder="📞 Phone" class="form-control mb-3" required>

        <input type="text" name="location" placeholder="📍 Location" class="form-control mb-3" required>

        <textarea name="message" class="form-control mb-3" placeholder="Message"></textarea>

        
        <select name="priority" class="form-control mb-3">
            <option value="Normal">🟢 Normal</option>
            <option value="Urgent">🟡 Urgent</option>
            <option value="Critical">🔴 Critical</option>
        </select>

        <button class="btn btn-danger w-100">🚑 Send Request</button>

    </form>

    
    <div id="result" class="mt-4"></div>

</div>


<script>
document.getElementById("requestForm").addEventListener("submit", function(e){

    e.preventDefault();

    let formData = new FormData(this);

    fetch("fetch_donors.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById("result").innerHTML = data;
    });

});
</script>

</body>
</html>