<!DOCTYPE html>
<html>
<head>
<title>Blood Donation System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    scroll-behavior: smooth;
}


.navbar {
    position: sticky;
    top: 0;
    z-index: 1000;
}


.hero {
    background: linear-gradient(to right,#ff4b2b,#ff416c);
    color:white;
    padding:120px 20px;
    text-align:center;
    animation: fadeIn 1s ease-in;
}


.section {
    padding:60px 20px;
}


.card {
    border-radius:15px;
    transition:0.3s;
}
.card:hover {
    transform: translateY(-10px);
}


.btn {
    transition:0.3s;
}
.btn:hover {
    transform: scale(1.1);
}


@keyframes fadeIn {
    from {opacity:0;}
    to {opacity:1;}
}

.animate {
    opacity: 0;
    transform: translateY(50px);
    transition: all 0.8s ease;
}

.animate.show {
    opacity: 1;
    transform: translateY(0);
}
</style>

</head>

<body>


<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">🩸 One Drop One Love</span>
    <div>
        <a href="auth.php" class="btn btn-danger btn-sm">Login</a>
        <a href="request.php" class="btn btn-light btn-sm">Request</a>
    </div>
</nav>


<div class="hero">
    <h1>🩸 Save Lives with Blood Donation</h1>
    <p>Fast, reliable and easy donor finding system</p>

    <a href="auth.php" class="btn btn-light m-2">Get Started</a>
    <a href="request.php" class="btn btn-dark m-2">Request Blood</a>
</div>


<div class="section container text-center">
    <h2>⚡ Powerful Features</h2>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card p-3">
                <h4>🩸 Donor Management</h4>
                <p>Manage and filter donors easily.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h4>📩 Request System</h4>
                <p>Send emergency requests instantly.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h4>📊 Smart Dashboard</h4>
                <p>View live statistics and data.</p>
            </div>
        </div>

    </div>
</div>


<div class="section bg-light text-center">
    <h2>🧠 How It Works</h2>

    <div class="row mt-4">

        <div class="col-md-4">
            <h4>1️⃣ Register</h4>
            <p>Create your account</p>
        </div>

        <div class="col-md-4">
            <h4>2️⃣ Find Donor</h4>
            <p>Search by blood group</p>
        </div>

        <div class="col-md-4">
            <h4>3️⃣ Save Life</h4>
            <p>Contact and help people</p>
        </div>

    </div>
</div>


<div class="section container text-center">
    <h2>🩸 Blood Compatibility</h2>

    <table class="table table-bordered mt-4">
        <tr class="table-danger">
            <th>Blood</th>
            <th>Donate To</th>
            <th>Receive From</th>
        </tr>

        <tr><td>A+</td><td>A+, AB+</td><td>A+, A-, O+, O-</td></tr>
        <tr><td>B+</td><td>B+, AB+</td><td>B+, B-, O+, O-</td></tr>
        <tr><td>O+</td><td>A+, B+, O+, AB+</td><td>O+, O-</td></tr>
        <tr><td>O-</td><td>All</td><td>O-</td></tr>
        <tr><td>AB+</td><td>AB+</td><td>All</td></tr>
    </table>
</div>

<!-- CTA -->
<div class="hero">
    <h2>🚑 Need Blood Urgently?</h2>
    <a href="request.php" class="btn btn-light">Request Now</a>
</div>
<div class="col-md-4 animate">
    <h4>1️⃣ Register</h4>
    <p>Create your account</p>
</div>

<div class="col-md-4 animate">
    <h4>2️⃣ Find Donor</h4>
    <p>Search by blood group</p>
</div>

<div class="col-md-4 animate">
    <h4>3️⃣ Save Life</h4>
    <p>Contact and help people</p>
</div>


<footer class="bg-dark text-white text-center p-3">
    <p>© 2026 One Drop One Love | Made by Urbi,Abdullah,Abir,Lobaina,Avishek</p>
</footer>


</body>
</html>