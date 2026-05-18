<?php

session_start();

include 'koneksi.php';

if(isset($_POST['login'])){

    $nim = $_POST['nim'];
    $password = $_POST['password'];

    $query = "SELECT * FROM mahasiswa
              WHERE nim='$nim'
              AND password='$password'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){

        $data = mysqli_fetch_assoc($result);

        $_SESSION['login'] = true;
        $_SESSION['id_mahasiswa'] = $data['id_mahasiswa'];
        $_SESSION['nama_mahasiswa'] = $data['nama_mahasiswa'];

        header("Location: index.php");

    } else {

        echo "NIM atau Password salah";

    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login Mahasiswa</h2>

<form method="POST">

    <label>NIM</label><br>
    <input type="text" name="nim" required>
    <br><br>

    <label>Password</label><br>
    <input type="password" name="password" required>
    <br><br>

    <button type="submit" name="login">
        Login
    </button>

</form>

<p>
    Belum punya akun?
    <a href="register.php">Register</a>
</p>

</body>
</html>