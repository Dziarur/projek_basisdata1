<?php

include 'koneksi.php';

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $password = $_POST['password'];

    $query = "INSERT INTO mahasiswa
    (nama_mahasiswa, nim, jurusan, password)

    VALUES

    ('$nama', '$nim', '$jurusan', '$password')";

    mysqli_query($conn, $query);

    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — StudyTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --navy: #1e3a5f;
            --accent: #38bdf8;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-400: #94a3b8;
            --gray-600: #475569;
            --gray-800: #1e293b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 55%, #38bdf8 100%);
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            top: -150px; left: -100px;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .register-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .register-card {
            background: rgba(255,255,255,0.97);
            border-radius: 24px;
            box-shadow: 0 32px 80px rgba(0,0,0,0.25);
            width: 100%;
            max-width: 480px;
            padding: 3rem;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            box-shadow: 0 8px 24px rgba(37,99,235,0.35);
        }

        .brand-icon i { color: white; font-size: 1.6rem; }

        .brand h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--gray-800);
            letter-spacing: -0.5px;
        }

        .brand p { color: var(--gray-400); font-size: 0.9rem; }

        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.4rem;
        }

        .input-wrap {
            position: relative;
            margin-bottom: 1.1rem;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 0.9rem;
            z-index: 2;
        }

        .form-control {
            padding: 0.75rem 1rem 0.75rem 2.7rem;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: inherit;
            color: var(--gray-800);
            background: var(--gray-50);
            transition: all 0.2s;
            width: 100%;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(37,99,235,0.1);
        }

        .btn-register {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 16px rgba(37,99,235,0.35);
            margin-top: 0.5rem;
        }

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(37,99,235,0.45);
        }

        .divider {
            text-align: center;
            margin: 1.25rem 0;
            position: relative;
            color: var(--gray-400);
            font-size: 0.85rem;
        }

        .divider::before, .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: var(--gray-200);
        }

        .divider::before { left: 0; }
        .divider::after { right: 0; }

        .login-link {
            text-align: center;
            font-size: 0.9rem;
            color: var(--gray-600);
        }

        .login-link a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .login-link a:hover { text-decoration: underline; }

        .step-hint {
            background: var(--gray-50);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.82rem;
            color: var(--gray-600);
            border-left: 3px solid var(--primary);
        }
    </style>
</head>
<body>

<div class="register-wrapper">
    <div class="register-card">

        <div class="brand">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h1>Buat Akun Baru</h1>
            <p>Daftarkan diri Anda ke StudyTrack</p>
        </div>

        <div class="step-hint">
            <i class="fas fa-info-circle me-1" style="color:var(--primary)"></i>
            Isi semua data dengan benar. NIM akan digunakan untuk login.
        </div>

        <form method="POST">

            <div class="mb-1">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-wrap">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="nama" class="form-control"
                           placeholder="Masukkan nama lengkap" required>
                </div>
            </div>

            <div class="mb-1">
                <label class="form-label">NIM</label>
                <div class="input-wrap">
                    <i class="fas fa-id-card input-icon"></i>
                    <input type="text" name="nim" class="form-control"
                           placeholder="Masukkan NIM Anda" required>
                </div>
            </div>

            <div class="mb-1">
                <label class="form-label">Jurusan</label>
                <div class="input-wrap">
                    <i class="fas fa-university input-icon"></i>
                    <input type="text" name="jurusan" class="form-control"
                           placeholder="Contoh: Teknik Informatika" required>
                </div>
            </div>

            <div class="mb-1">
                <label class="form-label">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" class="form-control"
                           placeholder="Buat password Anda" required>
                </div>
            </div>

            <button type="submit" name="register" class="btn-register">
                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
            </button>

        </form>

        <div class="divider">atau</div>

        <div class="login-link">
            Sudah punya akun?
            <a href="login.php">Masuk di sini</a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
