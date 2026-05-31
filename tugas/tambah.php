<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

$id_mahasiswa = $_SESSION['id_mahasiswa'];

$query_matkul = "SELECT * FROM mata_kuliah";
$result_matkul = mysqli_query($conn, $query_matkul);

if(isset($_POST['simpan'])){

    $nama_tugas = $_POST['nama_tugas'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $id_matkul = $_POST['id_matkul'];

    $query = "INSERT INTO tugas
              (nama_tugas,
               deadline,
               status,
               id_mahasiswa,
               id_matkul)
              VALUES
              ('$nama_tugas',
               '$deadline',
               '$status',
               '$id_mahasiswa',
               '$id_matkul')";

    mysqli_query($conn, $query);

    header("Location: index.php");
    exit;
}

$pageTitle = 'Tambah Tugas';
$pageSubtitle = 'Tambah tugas baru';
$activeMenu = 'tugas';
$isSubdir = true;

include '../layout.php';
?>

<div class="page-header">
    <div>
        <h4>Tambah Tugas Baru</h4>
        <p>Isi form di bawah untuk menambahkan tugas baru</p>
    </div>
    <a href="index.php" class="btn-secondary-custom">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-7">
        <div class="card">
            <div class="card-header-custom">
                <h5><i class="fas fa-plus-circle" style="color:var(--primary)"></i> Form Tugas Baru</h5>
            </div>
            <div class="card-body-custom">
                <form method="POST">

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="fas fa-file-alt me-1" style="color:var(--primary)"></i>
                            Nama Tugas
                        </label>
                        <input type="text" name="nama_tugas" class="form-control-custom"
                               placeholder="Contoh: Tugas Makalah Rekayasa Perangkat Lunak" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="fas fa-book me-1" style="color:var(--primary)"></i>
                            Mata Kuliah
                        </label>
                        <select name="id_matkul" class="form-control-custom" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            <?php
                            while($matkul = mysqli_fetch_assoc($result_matkul)){
                            ?>
                            <option value="<?php echo $matkul['id_matkul']; ?>">
                                <?php echo htmlspecialchars($matkul['nama_matkul']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="fas fa-calendar-alt me-1" style="color:var(--primary)"></i>
                            Deadline
                        </label>
                        <input type="date" name="deadline" class="form-control-custom"
                               min="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="fas fa-flag me-1" style="color:var(--primary)"></i>
                            Status Tugas
                        </label>
                        <div style="display:flex; gap:0.75rem; flex-wrap:wrap; margin-top:0.25rem;">
                            <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; padding:0.75rem 1.25rem; border:2px solid var(--gray-200); border-radius:10px; flex:1; min-width:140px; transition:all 0.15s;" id="label-belum">
                                <input type="radio" name="status" value="Belum Selesai" checked
                                       onchange="updateRadioStyle()"
                                       style="accent-color:var(--warning)">
                                <span style="font-weight:600; font-size:0.875rem;">
                                    <i class="fas fa-clock me-1" style="color:var(--warning)"></i>
                                    Belum Selesai
                                </span>
                            </label>
                            <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; padding:0.75rem 1.25rem; border:2px solid var(--gray-200); border-radius:10px; flex:1; min-width:140px; transition:all 0.15s;" id="label-selesai">
                                <input type="radio" name="status" value="Selesai"
                                       onchange="updateRadioStyle()"
                                       style="accent-color:var(--success)">
                                <span style="font-weight:600; font-size:0.875rem;">
                                    <i class="fas fa-check-circle me-1" style="color:var(--success)"></i>
                                    Selesai
                                </span>
                            </label>
                        </div>
                    </div>

                    <div style="display:flex; gap:0.75rem; margin-top:1.5rem;">
                        <button type="submit" name="simpan" class="btn-primary-custom" style="flex:1; justify-content:center; padding:0.75rem;">
                            <i class="fas fa-save"></i> Simpan Tugas
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

<script>
function updateRadioStyle() {
    const belum = document.querySelector('input[value="Belum Selesai"]');
    const selesai = document.querySelector('input[value="Selesai"]');
    const labelBelum = document.getElementById('label-belum');
    const labelSelesai = document.getElementById('label-selesai');

    if(belum.checked) {
        labelBelum.style.borderColor = 'var(--warning)';
        labelBelum.style.background = 'var(--warning-light)';
        labelSelesai.style.borderColor = 'var(--gray-200)';
        labelSelesai.style.background = 'transparent';
    } else {
        labelSelesai.style.borderColor = 'var(--success)';
        labelSelesai.style.background = 'var(--success-light)';
        labelBelum.style.borderColor = 'var(--gray-200)';
        labelBelum.style.background = 'transparent';
    }
}
updateRadioStyle();
</script>

<?php include '../layout_footer.php'; ?>
