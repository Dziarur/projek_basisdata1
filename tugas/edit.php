<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
}

$id = $_GET['id'];

$query = "SELECT * FROM tugas
          WHERE id_tugas='$id'";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

$query_matkul = "SELECT * FROM mata_kuliah";

$result_matkul = mysqli_query($conn, $query_matkul);

if(isset($_POST['update'])){

    $nama_tugas = $_POST['nama_tugas'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $id_matkul = $_POST['id_matkul'];

    $update = "UPDATE tugas

               SET

               nama_tugas='$nama_tugas',
               deadline='$deadline',
               status='$status',
               id_matkul='$id_matkul'

               WHERE id_tugas='$id'";

    mysqli_query($conn, $update);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tugas</title>
</head>
<body>

<h2>Edit Tugas</h2>

<form method="POST">

    <label>Nama Tugas</label><br>

    <input type="text"
    name="nama_tugas"

    value="<?php echo $data['nama_tugas']; ?>"

    required>

    <br><br>

    <label>Mata Kuliah</label><br>

    <select name="id_matkul">

        <?php
        while($matkul = mysqli_fetch_assoc($result_matkul)){
        ?>

        <option

        value="<?php echo $matkul['id_matkul']; ?>"

        <?php
        if($matkul['id_matkul'] == $data['id_matkul']){
            echo "selected";
        }
        ?>

        >

        <?php echo $matkul['nama_matkul']; ?>

        </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Deadline</label><br>

    <input type="date"
    name="deadline"

    value="<?php echo $data['deadline']; ?>"

    required>

    <br><br>

    <label>Status</label><br>

    <select name="status">

        <option value="Belum Selesai"

        <?php
        if($data['status'] == 'Belum Selesai'){
            echo "selected";
        }
        ?>

        >

        Belum Selesai

        </option>

        <option value="Selesai"

        <?php
        if($data['status'] == 'Selesai'){
            echo "selected";
        }
        ?>

        >

        Selesai

        </option>

    </select>

    <br><br>

    <button type="submit" name="update">
        Update
    </button>

</form>

</body>
</html>