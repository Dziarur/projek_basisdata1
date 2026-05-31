<?php

session_start();

include '../koneksi.php';

$id = $_GET['id'];

$query = "SELECT * FROM mata_kuliah WHERE id_matkul='$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $nama_matkul = $_POST['nama_matkul'];
    $dosen = $_POST['dosen_pengampu'];

    $update = "UPDATE mata_kuliah
               SET
               nama_matkul='$nama_matkul',
               dosen_pengampu='$dosen'
               WHERE id_matkul='$id'";

    mysqli_query($conn, $update);

    header("Location: index.php");
    exit;
}

$pageTitle = 'Edit Mata Kuliah';
$pageSubtitle = 'Ubah informasi mata kuliah';
$activeMenu = 'matkul';
$isSubdir = true;

include '../layout.php';
?>

<div class="page-header">
    <div>
        <h4>Edit Mata Kuliah</h4>
        <p>Perbarui informasi mata kuliah</p>
    </div>
    <a href="index.php" class="btn-secondary-custom">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-md-7 col-lg-6">
        <div class="card">
            <div class="card-header-custom">
                <h5><i class="fas fa-edit" style="color:var(--warning)"></i> Edit Mata Kuliah</h5>
                <span style="font-size:0.78rem; background:var(--warning-light); color:#92400e; padding:0.25rem 0.7rem; border-radius:6px; font-weight:600;">
                    ID: <?php echo $id; ?>
                </span>
            </div>
            <div class="card-body-custom">
                <form method="POST">

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="fas fa-book me-1" style="color:var(--primary)"></i>
                            Nama Mata Kuliah
                        </label>
                        <input type="text" name="nama_matkul" class="form-control-custom"
                               value="<?php echo htmlspecialchars($data['nama_matkul']); ?>"
                               placeholder="Contoh: Pemrograman Web" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="fas fa-chalkboard-teacher me-1" style="color:var(--primary)"></i>
                            Dosen Pengampu
                        </label>
                        <input type="text" name="dosen_pengampu" class="form-control-custom"
                               value="<?php echo htmlspecialchars($data['dosen_pengampu']); ?>"
                               placeholder="Nama dosen pengampu" required>
                    </div>

                    <div style="display:flex; gap:0.75rem; margin-top:1.5rem;">
                        <button type="submit" name="update" class="btn-success-custom" style="flex:1; justify-content:center; padding:0.75rem;">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="index.php" class="btn-secondary-custom" style="padding:0.75rem 1.25rem;">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../layout_footer.php'; ?>
