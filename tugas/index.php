<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
}

$id_mahasiswa = $_SESSION['id_mahasiswa'];

$query = "SELECT tugas.*, mata_kuliah.nama_matkul

          FROM tugas

          JOIN mata_kuliah

          ON tugas.id_matkul = mata_kuliah.id_matkul

          WHERE tugas.id_mahasiswa='$id_mahasiswa'

          ORDER BY deadline ASC";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Tugas</title>
</head>
<body>

<h2>Data Tugas</h2>

<a href="tambah.php">
    Tambah Tugas
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>

    <th>No</th>
    <th>Nama Tugas</th>
    <th>Mata Kuliah</th>
    <th>Deadline</th>
    <th>Status</th>
    <th>Aksi</th>

</tr>

<?php

$no = 1;

while($data = mysqli_fetch_assoc($result)){

?>

<tr>

    <td><?php echo $no++; ?></td>

    <td>
        <?php echo $data['nama_tugas']; ?>
    </td>

    <td>
        <?php echo $data['nama_matkul']; ?>
    </td>

    <td>
        <?php echo $data['deadline']; ?>
    </td>

    <td>
        <?php

        $today = date('Y-m-d');

        if($data['status'] == 'Selesai'){

            echo "<td style='background:green;color:white'>
                    Selesai
                </td>";

        }

        elseif($data['deadline'] < $today){

            echo "<td style='background:red;color:white'>
                    Deadline Lewat
                </td>";

        }

        else{

            echo "<td style='background:yellow'>
                    Belum Selesai
                </td>";

        }

        ?>    
    </td>

    <td>

        <a href="edit.php?id=<?php echo $data['id_tugas']; ?>">
            Edit
        </a>

        |

        <a href="hapus.php?id=<?php echo $data['id_tugas']; ?>">
            Hapus
        </a>

    </td>

</tr>

<?php } ?>

</table>

</body>
</html>