<?php

session_start();

include '../koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM tugas
          WHERE id_tugas='$id'";

mysqli_query($conn, $query);

header("Location: index.php");

?>