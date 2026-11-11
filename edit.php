<?php
include 'db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM donors WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if ($_POST) {
    $name = $_POST['name'];
    $blood = $_POST['blood'];

    mysqli_query($conn, "UPDATE donors SET name='$name', blood_group='$blood' WHERE id=$id");

    header("Location: donors.php");
}
?>

<form method="post">
    Name: <input type="text" name="name" value="<?= $data['name']; ?>"><br>
    Blood: <input type="text" name="blood" value="<?= $data['blood_group']; ?>"><br>
    <button>Update</button>
</form>