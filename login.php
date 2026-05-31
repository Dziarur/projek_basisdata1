<?php

session_start();

include 'koneksi.php';

$error = '';

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

        $error = "NIM atau Password salah. Silakan coba lagi.";

    }

}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — StudyTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #dbeafe;
            --navy: #1e3a5f;
            --accent: #38bdf8;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-400: #94a3b8;
            --gray-600: #475569;
            --gray-800: #1e293b;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 50%, #38bdf8 100%);
            position: relative;
            overflow-y: auto;
        }

        body::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            top: -200px; right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            bottom: -150px; left: -100px;
            animation: float 6s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 32px 80px rgba(0,0,0,0.25), 0 0 0 1px rgba(255,255,255,0.3);
            width: 100%;
            max-width: 440px;
            padding: 3rem;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand {
            text-align: center;
            margin-bottom: 2.5rem;
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

        .brand p {
            color: var(--gray-400);
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 0.95rem;
            z-index: 2;
        }

        .form-control {
            padding: 0.75rem 1rem 0.75rem 2.75rem;
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

        .btn-login {
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
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(37,99,235,0.45);
        }

        .btn-login:active { transform: translateY(0); }

        .alert-error {
            background: #fef2f2;
            border: 1.5px solid #fecaca;
            color: #dc2626;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
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

        .register-link {
            text-align: center;
            font-size: 0.9rem;
            color: var(--gray-600);
        }

        .register-link a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .register-link a:hover { text-decoration: underline; }

        .particles {
            position: absolute;
            width: 100%; height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            animation: particleFloat linear infinite;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        <div class="brand">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h1>StudyTrack</h1>
            <p>Sistem Manajemen Tugas Mahasiswa</p>
        </div>

        <?php if($error): ?>
        <div class="alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">NIM</label>
                <div class="input-group-custom">
                    <i class="fas fa-id-card input-icon"></i>
                    <input type="text" name="nim" class="form-control"
                           placeholder="Masukkan NIM Anda" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group-custom">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" class="form-control"
                           placeholder="Masukkan password Anda" required>
                </div>
            </div>

            <button type="submit" name="login" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
            </button>

        </form>

        <div class="divider">atau</div>

        <div class="register-link">
            Belum punya akun?
            <a href="register.php">Daftar di sini</a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
