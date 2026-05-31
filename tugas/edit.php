<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM tugas WHERE id_tugas='$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$query_matkul = "SELECT * FROM mata_kuliah";
$result_matkul = mysqli_query($conn, $query_matkul);

if(isset($_POST['update'])){

    $nama_tugas = $_POST['nama_tugas'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $id_matkul = $_POST['id_matkul'];

    $update = "UPDATE tugas
               SET
               nama_tugas='$nama_tugas',
               deadline='$deadline',
               status='$status',
               id_matkul='$id_matkul'
               WHERE id_tugas='$id'";

    mysqli_query($conn, $update);

    header("Location: index.php");
    exit;
}

$pageTitle = 'Edit Tugas';
$pageSubtitle = 'Ubah informasi tugas';
$activeMenu = 'tugas';
$isSubdir = true;

include '../layout.php';
?>

<div class="page-header">
    <div>
        <h4>Edit Tugas</h4>
        <p>Perbarui informasi tugas kuliah</p>
    </div>
    <a href="index.php" class="btn-secondary-custom">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-7">
        <div class="card">
            <div class="card-header-custom">
                <h5><i class="fas fa-edit" style="color:var(--warning)"></i> Edit Tugas</h5>
                <span style="font-size:0.78rem; background:var(--warning-light); color:#92400e; padding:0.25rem 0.7rem; border-radius:6px; font-weight:600;">
                    Mode Edit
                </span>
            </div>
            <div class="card-body-custom">
                <form method="POST">

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="fas fa-file-alt me-1" style="color:var(--primary)"></i>
                            Nama Tugas
                        </label>
                        <input type="text" name="nama_tugas" class="form-control-custom"
                               value="<?php echo htmlspecialchars($data['nama_tugas']); ?>"
                               placeholder="Nama tugas" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="fas fa-book me-1" style="color:var(--primary)"></i>
                            Mata Kuliah
                        </label>
                        <select name="id_matkul" class="form-control-custom">
                            <?php
                            while($matkul = mysqli_fetch_assoc($result_matkul)){
                            ?>
                            <option value="<?php echo $matkul['id_matkul']; ?>"
                                <?php if($matkul['id_matkul'] == $data['id_matkul']) echo 'selected'; ?>>
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
                        <input type="date"
                               name="deadline"
                               class="form-control-custom"

                               value="<?php
                               echo date(
                               'Y-m-d',
                               strtotime($data['deadline'])
                               );
                               ?>"

                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="fas fa-flag me-1" style="color:var(--primary)"></i>
                            Status Tugas
                        </label>
                        <div style="display:flex; gap:0.75rem; flex-wrap:wrap; margin-top:0.25rem;">
                            <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; padding:0.75rem 1.25rem; border:2px solid var(--gray-200); border-radius:10px; flex:1; min-width:140px; transition:all 0.15s;" id="label-belum">
                                <input type="radio" name="status" value="Belum Selesai"
                                       <?php if($data['status'] == 'Belum Selesai') echo 'checked'; ?>
                                       onchange="updateRadioStyle()"
                                       style="accent-color:var(--warning)">
                                <span style="font-weight:600; font-size:0.875rem;">
                                    <i class="fas fa-clock me-1" style="color:var(--warning)"></i>
                                    Belum Selesai
                                </span>
                            </label>
                            <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; padding:0.75rem 1.25rem; border:2px solid var(--gray-200); border-radius:10px; flex:1; min-width:140px; transition:all 0.15s;" id="label-selesai">
                                <input type="radio" name="status" value="Selesai"
                                       <?php if($data['status'] == 'Selesai') echo 'checked'; ?>
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
