<!-- layout.php - included by dashboard pages -->
<!-- Usage: $pageTitle, $activeMenu must be set before including -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle.' — StudyTrack' : 'StudyTrack'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #dbeafe;
            --primary-xlight: #eff6ff;
            --navy: #1e3a5f;
            --accent: #38bdf8;
            --sidebar-bg: #0f172a;
            --sidebar-w: 260px;
            --navbar-h: 66px;
            --success: #10b981;
            --success-light: #d1fae5;
            --danger: #ef4444;
            --danger-light: #fee2e2;
            --warning: #f59e0b;
            --warning-light: #fef3c7;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.07), 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.08), 0 1px 4px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 32px rgba(0,0,0,0.1), 0 2px 8px rgba(0,0,0,0.06);
            --radius: 16px;
            --radius-sm: 10px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--gray-50);
            color: var(--gray-800);
            margin: 0;
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            left: 0; top: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow: hidden;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .sidebar-brand {
            padding: 1.5rem 1.5rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            text-decoration: none;
        }

        .brand-logo {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(37,99,235,0.4);
        }

        .brand-logo i { color: white; font-size: 1.1rem; }

        .brand-text h2 {
            font-size: 1.05rem;
            font-weight: 800;
            color: white;
            margin: 0;
            letter-spacing: -0.3px;
        }

        .brand-text span {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.4);
            font-weight: 500;
        }

        .sidebar-user {
            padding: 1rem 1.25rem;
            margin: 0.75rem 0.75rem 0;
            background: rgba(255,255,255,0.05);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            color: white;
            flex-shrink: 0;
        }

        .user-info { overflow: hidden; }

        .user-info .name {
            font-size: 0.82rem;
            font-weight: 700;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.3;
        }

        .user-info .role {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.4);
        }

        .sidebar-nav {
            padding: 1rem 0.75rem;
            flex: 1;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            color: rgba(255,255,255,0.25);
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.5rem 0.75rem 0.5rem;
            margin-top: 0.5rem;
        }

        .nav-item {
            margin-bottom: 2px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 0.875rem;
            border-radius: 10px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.15s;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.85);
        }

        .nav-link.active {
            background: rgba(37,99,235,0.2);
            color: #60a5fa;
            font-weight: 600;
        }

        .nav-link.active .nav-icon {
            color: var(--accent);
        }

        .nav-icon {
            width: 20px;
            text-align: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 0.75rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 0.875rem;
            border-radius: 10px;
            color: rgba(239,68,68,0.7);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.15s;
            width: 100%;
        }

        .logout-btn:hover {
            background: rgba(239,68,68,0.1);
            color: #f87171;
        }

        /* ===== MAIN LAYOUT ===== */
        .main-wrap {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== NAVBAR ===== */
        .topbar {
            height: var(--navbar-h);
            background: white;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
            gap: 1rem;
            box-shadow: var(--shadow-sm);
        }

        .topbar-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--gray-600);
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0.4rem;
        }

        .topbar-breadcrumb {
            flex: 1;
        }

        .topbar-breadcrumb h3 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
        }

        .topbar-breadcrumb p {
            font-size: 0.78rem;
            color: var(--gray-400);
            margin: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .topbar-date {
            font-size: 0.8rem;
            color: var(--gray-500);
            background: var(--gray-100);
            padding: 0.35rem 0.75rem;
            border-radius: 8px;
            font-weight: 500;
        }

        /* ===== PAGE CONTENT ===== */
        .page-content {
            padding: 2rem;
            flex: 1;
        }

        /* ===== CARDS ===== */
        .card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .card-header-custom {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .card-header-custom h5 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body-custom {
            padding: 1.5rem;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            right: 0;
            height: 3px;
            border-radius: 16px 16px 0 0;
        }

        .stat-card.blue::before { background: var(--primary); }
        .stat-card.green::before { background: var(--success); }
        .stat-card.yellow::before { background: var(--warning); }
        .stat-card.red::before { background: var(--danger); }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .stat-icon.blue { background: var(--primary-xlight); color: var(--primary); }
        .stat-icon.green { background: var(--success-light); color: var(--success); }
        .stat-icon.yellow { background: var(--warning-light); color: var(--warning); }
        .stat-icon.red { background: var(--danger-light); color: var(--danger); }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--gray-800);
            line-height: 1;
            margin-bottom: 0.3rem;
        }

        .stat-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ===== TABLE ===== */
        .table-custom {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        .table-custom thead th {
            padding: 0.875rem 1rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-500);
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
            white-space: nowrap;
        }

        .table-custom tbody td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid var(--gray-100);
            color: var(--gray-700);
            vertical-align: middle;
        }

        .table-custom tbody tr:last-child td { border-bottom: none; }

        .table-custom tbody tr:hover { background: var(--gray-50); }

        /* ===== BADGES ===== */
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-selesai {
            background: var(--success-light);
            color: #065f46;
        }

        .badge-belum {
            background: var(--warning-light);
            color: #92400e;
        }

        .badge-lewat {
            background: var(--danger-light);
            color: #991b1b;
        }

        /* ===== BUTTONS ===== */
        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(37,99,235,0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(37,99,235,0.4);
            color: white;
        }

        .btn-warning-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.85rem;
            background: var(--warning-light);
            color: #92400e;
            border: none;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
        }

        .btn-warning-custom:hover {
            background: #fde68a;
            color: #92400e;
        }

        .btn-danger-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.85rem;
            background: var(--danger-light);
            color: #991b1b;
            border: none;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
        }

        .btn-danger-custom:hover {
            background: #fecaca;
            color: #991b1b;
        }

        .btn-success-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(16,185,129,0.3);
        }

        .btn-success-custom:hover {
            transform: translateY(-1px);
            color: white;
        }

        .btn-secondary-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            background: var(--gray-100);
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
        }

        .btn-secondary-custom:hover {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        /* ===== FORMS ===== */
        .form-label-custom {
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control-custom {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: inherit;
            color: var(--gray-800);
            background: var(--gray-50);
            transition: all 0.2s;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(37,99,235,0.08);
        }

        .form-group { margin-bottom: 1.25rem; }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--gray-400);
        }

        .empty-state i { font-size: 3rem; margin-bottom: 1rem; display: block; }
        .empty-state h5 { font-size: 1rem; font-weight: 600; color: var(--gray-500); margin-bottom: 0.5rem; }
        .empty-state p { font-size: 0.85rem; }

        /* ===== ROW NUMBER ===== */
        .row-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px; height: 26px;
            background: var(--gray-100);
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--gray-500);
        }

        /* ===== ACTION BUTTONS GROUP ===== */
        .action-group {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-wrap {
                margin-left: 0;
            }

            .topbar-toggle {
                display: flex;
            }

            .page-content {
                padding: 1rem;
            }
        }

        /* ===== OVERLAY ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .sidebar-overlay.show { display: block; }

        /* ===== PAGE HEADER ===== */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
            gap: 1rem;
        }

        .page-header h4 {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--gray-800);
            margin: 0;
        }

        .page-header p {
            font-size: 0.82rem;
            color: var(--gray-400);
            margin: 0.2rem 0 0;
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="overlay" onclick="closeSidebar()"></div>

<div class="sidebar" id="sidebar">

    <a class="sidebar-brand" href="<?php echo isset($isSubdir) ? '../index.php' : 'index.php'; ?>">
        <div class="brand-logo">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="brand-text">
            <h2>StudyTrack</h2>
            <span>Manajemen Tugas</span>
        </div>
    </a>

    <?php
    $name = isset($_SESSION['nama_mahasiswa']) ? $_SESSION['nama_mahasiswa'] : 'Mahasiswa';
    $initials = strtoupper(substr($name, 0, 1));
    if(strpos($name, ' ') !== false) {
        $parts = explode(' ', $name);
        $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[count($parts)-1], 0, 1));
    }
    ?>

    <div class="sidebar-user">
        <div class="user-avatar"><?php echo $initials; ?></div>
        <div class="user-info">
            <div class="name"><?php echo htmlspecialchars($name); ?></div>
            <div class="role">Mahasiswa</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>

        <?php
        $base = isset($isSubdir) ? '../' : '';
        $active = isset($activeMenu) ? $activeMenu : '';
        ?>

        <div class="nav-item">
            <a href="<?php echo $base; ?>index.php"
               class="nav-link <?php echo $active == 'dashboard' ? 'active' : ''; ?>">
                <i class="fas fa-th-large nav-icon"></i>
                Dashboard
            </a>
        </div>

        <div class="nav-section-label" style="margin-top:1rem">Akademik</div>

        <div class="nav-item">
            <a href="<?php echo $base; ?>matkul/index.php"
               class="nav-link <?php echo $active == 'matkul' ? 'active' : ''; ?>">
                <i class="fas fa-book nav-icon"></i>
                Mata Kuliah
            </a>
        </div>

        <div class="nav-item">
            <a href="<?php echo $base; ?>tugas/index.php"
               class="nav-link <?php echo $active == 'tugas' ? 'active' : ''; ?>">
                <i class="fas fa-tasks nav-icon"></i>
                Tugas
            </a>
        </div>

    </nav>

    <div class="sidebar-footer">
        <a href="<?php echo $base; ?>logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            Logout
        </a>
    </div>
</div>

<div class="main-wrap">
    <div class="topbar">
        <button class="topbar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <div class="topbar-breadcrumb">
            <h3><?php echo isset($pageTitle) ? $pageTitle : 'Dashboard'; ?></h3>
            <p><?php echo isset($pageSubtitle) ? $pageSubtitle : 'StudyTrack — Sistem Manajemen Tugas'; ?></p>
        </div>
        <div class="topbar-right">
            <div class="topbar-date">
                <i class="fas fa-calendar-alt me-1"></i>
                <?php echo date('d M Y'); ?>
            </div>
        </div>
    </div>

    <div class="page-content">
