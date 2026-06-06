<?php

date_default_timezone_set('Asia/Jakarta');

$conn = mysqli_connect(
    getenv('mysql.railway.internal'),
    getenv('root'),
    getenv('uNrlnamrXbFoEmzOfzLWjbqrKhhBdvGN'),
    getenv('railway'),
    getenv('3306')
);


if(!$conn){
    die("Koneksi gagal");
}

?>
