<?php

session_start();

include '../koneksi.php';

if(isset($_POST['simpan'])){

    $nama_matkul = $_POST['nama_matkul'];
    $dosen = $_POST['dosen_pengampu'];

    $query = "INSERT INTO mata_kuliah
              (nama_matkul, dosen_pengampu)

              VALUES

              ('$nama_matkul', '$dosen')";

    mysqli_query($conn, $query);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mata Kuliah</title>
</head>
<body>

<h2>Tambah Mata Kuliah</h2>

<form method="POST">

    <label>Nama Mata Kuliah</label><br>

    <input type="text"
    name="nama_matkul" required>

    <br><br>

    <label>Dosen Pengampu</label><br>

    <input type="text"
    name="dosen_pengampu" required>

    <br><br>

    <button type="submit" name="simpan">
        Simpan
    </button>

</form>

</body>
</html>