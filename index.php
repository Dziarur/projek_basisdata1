<?php

session_start();

include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
}

$id_mahasiswa = $_SESSION['id_mahasiswa'];

$total = mysqli_query($conn,

"SELECT * FROM tugas
 WHERE id_mahasiswa='$id_mahasiswa'");

$selesai = mysqli_query($conn,

"SELECT * FROM tugas

 WHERE status='Selesai'

 AND id_mahasiswa='$id_mahasiswa'");

$belum = mysqli_query($conn,

"SELECT * FROM tugas

 WHERE status='Belum Selesai'

 AND id_mahasiswa='$id_mahasiswa'");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>
    Dashboard
</h1>

<h3>
    Selamat Datang,
    <?php echo $_SESSION['nama_mahasiswa']; ?>
</h3>

<hr>

<h2>Statistik Tugas</h2>

<p>
    Total Tugas :
    <?php echo mysqli_num_rows($total); ?>
</p>

<p>
    Tugas Selesai :
    <?php echo mysqli_num_rows($selesai); ?>
</p>

<p>
    Belum Selesai :
    <?php echo mysqli_num_rows($belum); ?>
</p>

<hr>

<a href="matkul/index.php">
    Kelola Mata Kuliah
</a>

<br><br>

<a href="tugas/index.php">
    Kelola Tugas
</a>

<br><br>

<a href="logout.php">
    Logout
</a>

</body>
</html>