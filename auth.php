<?php
session_start();
include 'db.php';

$msg = "";

// LOGIN
if (isset($_POST['login'])) {

    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE username='$user'";
    $res = mysqli_query($conn, $query);

    if ($res && mysqli_num_rows($res) > 0) {

        $row = mysqli_fetch_assoc($res);

        // PASSWORD CHECK (plain)
        if ($pass == $row['password']) {

            $_SESSION['user'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // 🔥 ROLE BASED REDIRECT
            if($row['role'] == 'admin'){
        header("Location: /blood-donation-php/admin/admin_dashboard.php");
    }
    elseif($row['role'] == 'donor'){
        header("Location: /blood-donation-php/donor/donor_dashboard.php");
    }
    else{
        header("Location: /blood-donation-php/dashboard.php");
    }

            exit();

        } else {
            $msg = "❌ Wrong Password!";
        }

    } else {
        $msg = "❌ User not found!";
    }
}

// REGISTER
if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);
    $role = $_POST['role'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");

    if (mysqli_num_rows($check) > 0) {
        $msg = "❌ Username already exists!";
    } else {

        mysqli_query($conn, "INSERT INTO users (name, username, password, role)
        VALUES ('$name','$user','$pass','$role')");

        $msg = "✅ Registered! Now login.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Auth</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h2 class="text-center">Login / Register</h2>

<?php if($msg): ?>
<div class="alert alert-info"><?= $msg ?></div>
<?php endif; ?>

<div class="row">

<!-- REGISTER -->
<div class="col-md-6">
<h4>Register</h4>
<form method="post">

<input type="text" name="name" class="form-control mb-2" placeholder="Name" required>

<input type="text" name="username" class="form-control mb-2" placeholder="Username" required>

<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

<select name="role" class="form-control mb-2">
<option value="user">User</option>
<option value="admin">Admin</option>
<option value="donor">Donor</option> <!-- ✅ NEW -->
</select>

<button name="register" class="btn btn-success w-100">Register</button>

</form>
</div>

<!-- LOGIN -->
<div class="col-md-6">
<h4>Login</h4>
<form method="post">

<input type="text" name="username" class="form-control mb-2" placeholder="Username" required>

<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

<button name="login" class="btn btn-danger w-100">Login</button>

</form>
</div>

</div>

</body>
</html>