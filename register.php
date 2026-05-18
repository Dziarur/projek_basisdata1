<?php

include 'koneksi.php';

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $password = $_POST['password'];

    $query = "INSERT INTO mahasiswa
    (nama_mahasiswa, nim, jurusan, password)

    VALUES

    ('$nama', '$nim', '$jurusan', '$password')";

    mysqli_query($conn, $query);

    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register Mahasiswa</h2>

<form method="POST">

    <label>Nama</label><br>
    <input type="text" name="nama" required>
    <br><br>

    <label>NIM</label><br>
    <input type="text" name="nim" required>
    <br><br>

    <label>Jurusan</label><br>
    <input type="text" name="jurusan" required>
    <br><br>

    <label>Password</label><br>
    <input type="password" name="password" required>
    <br><br>

    <button type="submit" name="register">
        Register
    </button>

</form>

</body>
</html>