<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
}

$id_mahasiswa = $_SESSION['id_mahasiswa'];

$query_matkul = "SELECT * FROM mata_kuliah";

$result_matkul = mysqli_query($conn, $query_matkul);

if(isset($_POST['simpan'])){

    $nama_tugas = $_POST['nama_tugas'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $id_matkul = $_POST['id_matkul'];

    $query = "INSERT INTO tugas

              (nama_tugas,
               deadline,
               status,
               id_mahasiswa,
               id_matkul)

              VALUES

              ('$nama_tugas',
               '$deadline',
               '$status',
               '$id_mahasiswa',
               '$id_matkul')";

    mysqli_query($conn, $query);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tugas</title>
</head>
<body>

<h2>Tambah Tugas</h2>

<form method="POST">

    <label>Nama Tugas</label><br>

    <input type="text"
    name="nama_tugas"
    required>

    <br><br>

    <label>Mata Kuliah</label><br>

    <select name="id_matkul" required>

        <option value="">
            -- Pilih Mata Kuliah --
        </option>

        <?php
        while($matkul = mysqli_fetch_assoc($result_matkul)){
        ?>

        <option value="<?php echo $matkul['id_matkul']; ?>">

            <?php echo $matkul['nama_matkul']; ?>

        </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Deadline</label><br>

    <input type="date"
    name="deadline"
    required>

    <br><br>

    <label>Status</label><br>

    <select name="status">

        <option value="Belum Selesai">
            Belum Selesai
        </option>

        <option value="Selesai">
            Selesai
        </option>

    </select>

    <br><br>

    <button type="submit" name="simpan">
        Simpan
    </button>

</form>

</body>
</html>