<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

$query = "SELECT * FROM mata_kuliah";
$result = mysqli_query($conn, $query);

$pageTitle = 'Mata Kuliah';
$pageSubtitle = 'Kelola daftar mata kuliah Anda';
$activeMenu = 'matkul';
$isSubdir = true;

include '../layout.php';
?>

<div class="page-header">
    <div>
        <h4>Mata Kuliah</h4>
        <p>Kelola daftar mata kuliah semester ini</p>
    </div>
    <a href="tambah.php" class="btn-primary-custom">
        <i class="fas fa-plus"></i> Tambah Mata Kuliah
    </a>
</div>

<div class="card">
    <div class="card-header-custom">
        <h5><i class="fas fa-book" style="color:var(--primary)"></i> Daftar Mata Kuliah</h5>
        <span style="font-size:0.8rem; color:var(--gray-400)">
            <?php
            $count = mysqli_num_rows($result);
            echo $count . ' mata kuliah';
            mysqli_data_seek($result, 0);
            ?>
        </span>
    </div>

    <?php if(mysqli_num_rows($result) == 0): ?>
    <div class="empty-state">
        <i class="fas fa-book-open"></i>
        <h5>Belum ada mata kuliah</h5>
        <p>Tambahkan mata kuliah untuk mulai mengelola tugas.</p>
        <a href="tambah.php" class="btn-primary-custom mt-2">
            <i class="fas fa-plus"></i> Tambah Sekarang
        </a>
    </div>
    <?php else: ?>
    <div style="overflow-x:auto;">
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width:60px">No</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Dosen Pengampu</th>
                    <th style="width:140px">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            while($data = mysqli_fetch_assoc($result)):
            ?>
            <tr>
                <td><span class="row-num"><?php echo $no++; ?></span></td>
                <td>
                    <div style="font-weight:700; color:var(--gray-800)"><?php echo htmlspecialchars($data['nama_matkul']); ?></div>
                </td>
                <td>
                    <div style="display:flex; align-items:center; gap:0.5rem;">
                        <i class="fas fa-chalkboard-teacher" style="color:var(--gray-400); font-size:0.8rem;"></i>
                        <span style="color:var(--gray-600)"><?php echo htmlspecialchars($data['dosen_pengampu']); ?></span>
                    </div>
                </td>
                <td>
                    <div class="action-group">
                        <a href="edit.php?id=<?php echo $data['id_matkul']; ?>" class="btn-warning-custom">
                            <i class="fas fa-pen"></i> Edit
                        </a>
                        <button onclick="confirmDelete('hapus.php?id=<?php echo $data['id_matkul']; ?>', '<?php echo addslashes($data['nama_matkul']); ?>')" class="btn-danger-custom">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<?php include '../layout_footer.php'; ?>
