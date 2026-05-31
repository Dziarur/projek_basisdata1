<?php

session_start();

include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id_mahasiswa = $_SESSION['id_mahasiswa'];

/*
|--------------------------------------------------------------------------
| QUERY STATISTIK
|--------------------------------------------------------------------------
*/

$total = mysqli_query($conn,
"SELECT * FROM tugas
WHERE id_mahasiswa='$id_mahasiswa'");

$selesai = mysqli_query($conn,
"SELECT * FROM tugas
WHERE status='Selesai'
AND id_mahasiswa='$id_mahasiswa'");

$belum = mysqli_query($conn,
"SELECT * FROM tugas
WHERE status != 'Selesai'
AND id_mahasiswa='$id_mahasiswa'");

/*
|--------------------------------------------------------------------------
| DEADLINE LEWAT
|--------------------------------------------------------------------------
| Semua tugas yang:
| - belum selesai
| - deadline sudah lewat
|--------------------------------------------------------------------------
*/

$deadline_lewat = mysqli_query($conn,
"SELECT * FROM tugas
WHERE deadline < NOW()
AND status != 'Selesai'
AND id_mahasiswa='$id_mahasiswa'");

/*
|--------------------------------------------------------------------------
| DATA TUGAS TERBARU
|--------------------------------------------------------------------------
*/

$latest = mysqli_query($conn,
"SELECT tugas.*, mata_kuliah.nama_matkul
FROM tugas
JOIN mata_kuliah
ON tugas.id_matkul = mata_kuliah.id_matkul
WHERE tugas.id_mahasiswa='$id_mahasiswa'
ORDER BY deadline ASC
LIMIT 8");

/*
|--------------------------------------------------------------------------
| PAGE
|--------------------------------------------------------------------------
*/

$pageTitle = 'Dashboard';

$pageSubtitle =
'Selamat datang kembali, ' .
$_SESSION['nama'];

$activeMenu = 'dashboard';

include 'layout.php';

?>

<!-- HEADER -->
<div class="page-header">

    <div>

        <h4>Dashboard</h4>

        <p>
            Selamat datang,
            <strong>
                <?php
                echo htmlspecialchars($_SESSION['nama']);
                ?>
            </strong>
            — pantau semua tugas Anda di sini.
        </p>

    </div>

    <div style="display:flex; gap:10px;">

        <!-- TAMBAH -->
        <a href="tugas/tambah.php"
           class="btn-primary-custom">

            <i class="fas fa-plus"></i>
            Tambah Tugas

        </a>

        <!-- LOGOUT -->
        <a href="logout.php"
           class="btn-danger-custom"

           onclick="
           return confirm(
           'Apakah yakin ingin logout?'
           )">

            <i class="fas fa-sign-out-alt"></i>
            Logout

        </a>

    </div>

</div>

<!-- STATISTIK -->
<div class="row g-3 mb-4">

    <!-- TOTAL -->
    <div class="col-6 col-md-3">

        <div class="stat-card blue">

            <div class="stat-icon blue">
                <i class="fas fa-clipboard-list"></i>
            </div>

            <div class="stat-value">
                <?php echo mysqli_num_rows($total); ?>
            </div>

            <div class="stat-label">
                TOTAL TUGAS
            </div>

        </div>

    </div>

    <!-- SELESAI -->
    <div class="col-6 col-md-3">

        <div class="stat-card green">

            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>

            <div class="stat-value">
                <?php echo mysqli_num_rows($selesai); ?>
            </div>

            <div class="stat-label">
                SELESAI
            </div>

        </div>

    </div>

    <!-- BELUM -->
    <div class="col-6 col-md-3">

        <div class="stat-card yellow">

            <div class="stat-icon yellow">
                <i class="fas fa-clock"></i>
            </div>

            <div class="stat-value">
                <?php echo mysqli_num_rows($belum); ?>
            </div>

            <div class="stat-label">
                BELUM
            </div>

        </div>

    </div>

    <!-- DEADLINE LEWAT -->
    <div class="col-6 col-md-3">

        <div class="stat-card red">

            <div class="stat-icon red">
                <i class="fas fa-exclamation-triangle"></i>
            </div>

            <div class="stat-value">
                <?php
                echo mysqli_num_rows($deadline_lewat);
                ?>
            </div>

            <div class="stat-label">
                DEADLINE LEWAT
            </div>

        </div>

    </div>

</div>

<!-- PROGRESS -->
<?php

$totalCount =
mysqli_num_rows($total);

$selesaiCount =
mysqli_num_rows($selesai);

$progress =
$totalCount > 0
? round(
($selesaiCount / $totalCount) * 100
)
: 0;

?>

<div class="card mb-4">

    <div class="card-body-custom">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:0.75rem;
        ">

            <div>

                <div style="
                    font-weight:700;
                    font-size:0.9rem;
                    color:var(--gray-800)
                ">
                    Progress Penyelesaian
                </div>

                <div style="
                    font-size:0.78rem;
                    color:var(--gray-400)
                ">

                    <?php echo $selesaiCount; ?>

                    dari

                    <?php echo $totalCount; ?>

                    tugas selesai

                </div>

            </div>

            <div style="
                font-size:1.5rem;
                font-weight:800;
                color:var(--primary)
            ">

                <?php echo $progress; ?>%

            </div>

        </div>

        <!-- BAR -->
        <div style="
            background:var(--gray-100);
            border-radius:50px;
            height:10px;
            overflow:hidden;
        ">

            <div style="
                background: linear-gradient(
                    90deg,
                    var(--primary),
                    var(--accent)
                );

                height:100%;

                width:<?php echo $progress; ?>%;

                border-radius:50px;

                transition: width 1s ease;
            ">
            </div>

        </div>

    </div>

</div>

<!-- TABEL -->
<div class="card">

    <!-- HEADER -->
    <div class="card-header-custom">

        <h5>

            <i class="fas fa-list-ul"
               style="color:var(--primary)">
            </i>

            Daftar Tugas

        </h5>

        <a href="tugas/index.php"
           class="btn-secondary-custom">

            Lihat Semua

        </a>

    </div>

    <!-- KOSONG -->
    <?php if(mysqli_num_rows($latest) == 0): ?>

        <div class="empty-state">

            <i class="fas fa-inbox"></i>

            <h5>Belum Ada Tugas</h5>

            <p>
                Tambahkan tugas pertama Anda sekarang.
            </p>

        </div>

    <?php else: ?>

    <!-- TABLE -->
    <div style="overflow-x:auto;">

        <table class="table-custom">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Nama Tugas</th>
                    <th>Mata Kuliah</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

            <?php

            $no = 1;

            while(
                $data =
                mysqli_fetch_assoc($latest)
            ):

            /*
            |--------------------------------------------------------------------------
            | BADGE STATUS
            |--------------------------------------------------------------------------
            */

            if(
                $data['status']
                == 'Selesai'
            ){

                $badge =
                '<span class="badge-status badge-selesai">
                <i class="fas fa-check-circle"></i>
                Selesai
                </span>';

            }

            elseif(

                $data['status'] != 'Selesai'

                &&

                strtotime(
                    $data['deadline']
                ) < time()

            ){

                $badge =
                '<span class="badge-status badge-lewat">
                <i class="fas fa-exclamation-circle"></i>
                Deadline Lewat
                </span>';

            }

            else {

                $badge =
                '<span class="badge-status badge-belum">
                <i class="fas fa-clock"></i>
                Belum
                </span>';
            }

            /*
            |--------------------------------------------------------------------------
            | FORMAT TANGGAL
            |--------------------------------------------------------------------------
            */

            if(!empty($data['deadline'])){

                $deadline_fmt = date(
                    'd M Y',
                    strtotime(
                        $data['deadline']
                    )
                );

            } else {

                $deadline_fmt = '-';
            }

            ?>

            <tr>

                <!-- NO -->
                <td>
                    <?php echo $no++; ?>
                </td>

                <!-- NAMA -->
                <td>

                    <?php
                    echo htmlspecialchars(
                        $data['nama_tugas']
                    );
                    ?>

                </td>

                <!-- MATKUL -->
                <td>

                    <?php
                    echo htmlspecialchars(
                        $data['nama_matkul']
                    );
                    ?>

                </td>

                <!-- DEADLINE -->
                <td>

                    <?php
                    echo $deadline_fmt;
                    ?>

                </td>

                <!-- STATUS -->
                <td>

                    <?php
                    echo $badge;
                    ?>

                </td>

                <!-- AKSI -->
                <td>

                    <div class="action-group">

                        <!-- EDIT -->
                        <a href="
                        tugas/edit.php?id=
                        <?php
                        echo $data['id_tugas'];
                        ?>
                        "

                        class="btn-warning-custom">

                            <i class="fas fa-pen"></i>

                        </a>

                        <!-- HAPUS -->
                        <button

                        onclick="
                        confirmDelete(
                        'tugas/hapus.php?id=<?php
                        echo $data['id_tugas'];
                        ?>',

                        '<?php
                        echo addslashes(
                            $data['nama_tugas']
                        );
                        ?>'
                        )"

                        class="btn-danger-custom">

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

<!-- DELETE -->
<script>

function confirmDelete(url, tugas){

    let konfirmasi = confirm(

        "Apakah yakin ingin menghapus tugas:\n\n"

        + tugas +

        " ?"

    );

    if(konfirmasi){

        window.location.href = url;
    }
}

</script>

<?php include 'layout_footer.php'; ?>