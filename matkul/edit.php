<?php

session_start();

include '../koneksi.php';

$id = $_GET['id'];

$query = "SELECT * FROM mata_kuliah
          WHERE id_matkul='$id'";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $nama_matkul = $_POST['nama_matkul'];
    $dosen = $_POST['dosen_pengampu'];

    $update = "UPDATE mata_kuliah

               SET

               nama_matkul='$nama_matkul',
               dosen_pengampu='$dosen'

               WHERE id_matkul='$id'";

    mysqli_query($conn, $update);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Mata Kuliah</title>
</head>
<body>

<h2>Edit Mata Kuliah</h2>

<form method="POST">

    <label>Nama Mata Kuliah</label><br>

    <input type="text"
    name="nama_matkul"

    value="<?php echo $data['nama_matkul']; ?>"

    required>

    <br><br>

    <label>Dosen Pengampu</label><br>

    <input type="text"
    name="dosen_pengampu"

    value="<?php echo $data['dosen_pengampu']; ?>"

    required>

    <br><br>

    <button type="submit" name="update">
        Update
    </button>

</form>

</body>
</html>