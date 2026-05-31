<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

$id_mahasiswa = $_SESSION['id_mahasiswa'];

$query = "SELECT tugas.*, mata_kuliah.nama_matkul
          FROM tugas
          JOIN mata_kuliah
          ON tugas.id_matkul = mata_kuliah.id_matkul
          WHERE tugas.id_mahasiswa='$id_mahasiswa'
          ORDER BY deadline ASC";

$result = mysqli_query($conn, $query);

$pageTitle = 'Tugas';
$pageSubtitle = 'Kelola semua tugas kuliah Anda';
$activeMenu = 'tugas';
$isSubdir = true;

include '../layout.php';
?>

<div class="page-header">
    <div>
        <h4>Daftar Tugas</h4>
        <p>Semua tugas kuliah diurutkan berdasarkan deadline terdekat</p>
    </div>
    <a href="tambah.php" class="btn-primary-custom">
        <i class="fas fa-plus"></i> Tambah Tugas
    </a>
</div>

<!-- Legend -->
<div style="display:flex; flex-wrap:wrap; gap:0.5rem; margin-bottom:1.25rem;">
    <span class="badge-status badge-selesai"><i class="fas fa-check-circle"></i> Selesai</span>
    <span class="badge-status badge-belum"><i class="fas fa-clock"></i> Belum Selesai</span>
    <span class="badge-status badge-lewat"><i class="fas fa-exclamation-circle"></i> Deadline Lewat</span>
    <span style="font-size:0.78rem; color:var(--gray-400); margin-left:0.5rem; align-self:center;">— Keterangan warna status</span>
</div>

<div class="card">
    <div class="card-header-custom">
        <h5><i class="fas fa-tasks" style="color:var(--primary)"></i> Tabel Tugas</h5>
        <span style="font-size:0.8rem; color:var(--gray-400)">
            <?php
            $count = mysqli_num_rows($result);
            echo $count . ' tugas ditemukan';
            mysqli_data_seek($result, 0);
            ?>
        </span>
    </div>

    <?php if(mysqli_num_rows($result) == 0): ?>
    <div class="empty-state">
        <i class="fas fa-inbox"></i>
        <h5>Belum ada tugas</h5>
        <p>Tambahkan tugas pertama Anda sekarang dan mulai melacak progress kuliah.</p>
        <a href="tambah.php" class="btn-primary-custom mt-2">
            <i class="fas fa-plus"></i> Tambah Tugas
        </a>
    </div>
    <?php else: ?>
    <div style="overflow-x:auto;">
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width:60px">No</th>
                    <th>Nama Tugas</th>
                    <th>Mata Kuliah</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th style="width:150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            while($data = mysqli_fetch_assoc($result)):
                $today = date('Y-m-d');
                $deadline_fmt = date('d M Y', strtotime($data['deadline']));

                if($data['status'] == 'Selesai'){
                    $badge = '<span class="badge-status badge-selesai"><i class="fas fa-check-circle"></i> Selesai</span>';
                    $rowStyle = '';
                } elseif($data['deadline'] < $today){
                    $badge = '<span class="badge-status badge-lewat"><i class="fas fa-exclamation-circle"></i> Deadline Lewat</span>';
                    $rowStyle = 'background: #fff5f5;';
                } else {
                    $badge = '<span class="badge-status badge-belum"><i class="fas fa-clock"></i> Belum Selesai</span>';
                    $rowStyle = '';
                }

                // Days remaining
                $deadline_ts = strtotime($data['deadline']);
                $today_ts = strtotime($today);
                $diff = ($deadline_ts - $today_ts) / 86400;
            ?>
            <tr style="<?php echo $rowStyle; ?>">
                <td><span class="row-num"><?php echo $no++; ?></span></td>
                <td>
                    <div style="font-weight:700; color:var(--gray-800); margin-bottom:2px;">
                        <?php echo htmlspecialchars($data['nama_tugas']); ?>
                    </div>
                    <?php if($data['status'] != 'Selesai' && $diff >= 0 && $diff <= 3): ?>
                    <div style="font-size:0.72rem; color:var(--danger); font-weight:600;">
                        <i class="fas fa-fire"></i> Deadline dalam <?php echo (int)$diff; ?> hari!
                    </div>
                    <?php endif; ?>
                </td>
                <td>
                    <span style="background:var(--primary-xlight); color:var(--primary); padding:0.25rem 0.6rem; border-radius:6px; font-size:0.78rem; font-weight:600;">
                        <?php echo htmlspecialchars($data['nama_matkul']); ?>
                    </span>
                </td>
                <td>
                    <div style="display:flex; align-items:center; gap:0.4rem;">
                        <i class="fas fa-calendar-day" style="color:var(--gray-400); font-size:0.8rem;"></i>
                        <span style="color:var(--gray-600); font-size:0.875rem;"><?php echo $deadline_fmt; ?></span>
                    </div>
                </td>
                <td><?php echo $badge; ?></td>
                <td>
                    <div class="action-group">
                        <a href="edit.php?id=<?php echo $data['id_tugas']; ?>" class="btn-warning-custom">
                            <i class="fas fa-pen"></i> Edit
                        </a>
                        <button onclick="confirmDelete('hapus.php?id=<?php echo $data['id_tugas']; ?>', '<?php echo addslashes($data['nama_tugas']); ?>')" class="btn-danger-custom">
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
