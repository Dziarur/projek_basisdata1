<?php

session_start();

include '../koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM mata_kuliah
          WHERE id_matkul='$id'";

mysqli_query($conn, $query);

header("Location: index.php");

?>