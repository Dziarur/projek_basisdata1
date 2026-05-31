<?php

session_start();

include '../koneksi.php';

if(isset($_POST['simpan'])){

    $nama_matkul = $_POST['nama_matkul'];
    $dosen = $_POST['dosen_pengampu'];

    $query = "INSERT INTO mata_kuliah
              (nama_matkul, dosen_pengampu)
              VALUES
              ('$nama_matkul', '$dosen')";

    mysqli_query($conn, $query);

    header("Location: index.php");
    exit;
}

$pageTitle = 'Tambah Mata Kuliah';
$pageSubtitle = 'Tambah mata kuliah baru';
$activeMenu = 'matkul';
$isSubdir = true;

include '../layout.php';
?>

<div class="page-header">
    <div>
        <h4>Tambah Mata Kuliah</h4>
        <p>Isi form di bawah untuk menambahkan mata kuliah baru</p>
    </div>
    <a href="index.php" class="btn-secondary-custom">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-md-7 col-lg-6">
        <div class="card">
            <div class="card-header-custom">
                <h5><i class="fas fa-plus-circle" style="color:var(--primary)"></i> Form Mata Kuliah Baru</h5>
            </div>
            <div class="card-body-custom">
                <form method="POST">

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="fas fa-book me-1" style="color:var(--primary)"></i>
                            Nama Mata Kuliah
                        </label>
                        <input type="text" name="nama_matkul" class="form-control-custom"
                               placeholder="Contoh: Pemrograman Web" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="fas fa-chalkboard-teacher me-1" style="color:var(--primary)"></i>
                            Dosen Pengampu
                        </label>
                        <input type="text" name="dosen_pengampu" class="form-control-custom"
                               placeholder="Contoh: Dr. Ahmad Fauzi, M.Kom" required>
                    </div>

                    <div style="display:flex; gap:0.75rem; margin-top:1.5rem;">
                        <button type="submit" name="simpan" class="btn-primary-custom" style="flex:1; justify-content:center; padding:0.75rem;">
                            <i class="fas fa-save"></i> Simpan Mata Kuliah
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
