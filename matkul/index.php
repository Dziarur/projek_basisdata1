<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
}

$query = "SELECT * FROM mata_kuliah";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mata Kuliah</title>
</head>
<body>

<h2>Data Mata Kuliah</h2>

<a href="tambah.php">
    Tambah Mata Kuliah
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
    <th>No</th>
    <th>Nama Mata Kuliah</th>
    <th>Dosen Pengampu</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;

while($data = mysqli_fetch_assoc($result)){
?>

<tr>

    <td><?php echo $no++; ?></td>

    <td>
        <?php echo $data['nama_matkul']; ?>
    </td>

    <td>
        <?php echo $data['dosen_pengampu']; ?>
    </td>

    <td>

        <a href="edit.php?id=<?php echo $data['id_matkul']; ?>">
            Edit
        </a>

        |

        <a href="hapus.php?id=<?php echo $data['id_matkul']; ?>">
            Hapus
        </a>

    </td>

</tr>

<?php } ?>

</table>

</body>
</html>