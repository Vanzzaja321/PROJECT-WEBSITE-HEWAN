<?php
session_start();
include "koneksi.php";

// Cek login & level (hanya admin & operator yang bisa edit)
if (!isset($_SESSION['username']) || !in_array($_SESSION['level'], ['admin','operator'])) {
    header("Location: hewan.php");
    exit();
}

// Ambil ID dari URL dan validasi
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header("Location: hewan.php");
    exit();
}

// Ambil data hewan berdasarkan ID
$result = $koneksi->query("SELECT * FROM hewan WHERE id_hewan=$id");
if ($result->num_rows == 0) {
    header("Location: hewan.php");
    exit();
}
$data = $result->fetch_assoc();

$success = false; // flag berhasil update

// Proses update saat form disubmit
if (isset($_POST['simpan'])) {
    $nama_hewan  = $koneksi->real_escape_string($_POST['nama_hewan']);
    $jenis_hewan = $koneksi->real_escape_string($_POST['jenis_hewan']);
    $asal        = $koneksi->real_escape_string($_POST['asal']);
    $jumlah      = intval($_POST['jumlah']);

    $query = "UPDATE hewan SET 
                nama_hewan='$nama_hewan', 
                jenis_hewan='$jenis_hewan', 
                asal='$asal',
                jumlah=$jumlah
              WHERE id_hewan=$id";

    if ($koneksi->query($query)) {
        $success = true; // tandai berhasil
    } else {
        $error = "Gagal update: " . $koneksi->error;
    }
}
?>

<?php include "page/header.php"; ?>
<?php include "page/navbar.php"; ?>
<?php include "page/sidebar.php"; ?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Hewan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="hewan.php">Data Hewan</a></li>
              <li class="breadcrumb-item active">Edit Hewan</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if (isset($error)) { ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>

        <div class="card">
          <div class="card-header bg-edit text-white">
            <h3 class="card-title">Form Edit Hewan</h3>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <label for="nama_hewan">Nama Hewan</label>
                <input type="text" name="nama_hewan" id="nama_hewan" class="form-control" 
                       value="<?= htmlspecialchars($data['nama_hewan']) ?>" required>
              </div>
              <div class="form-group">
                <label for="jenis_hewan">Jenis Hewan</label>
                <input type="text" name="jenis_hewan" id="jenis_hewan" class="form-control" 
                       value="<?= htmlspecialchars($data['jenis_hewan']) ?>" required>
              </div>
              <div class="form-group">
                <label for="asal">Asal</label>
                <input type="text" name="asal" id="asal" class="form-control" 
                       value="<?= htmlspecialchars($data['asal']) ?>" required>
              </div>
              <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" 
                       value="<?= htmlspecialchars($data['jumlah']) ?>" required>
              </div>
              <button type="submit" name="simpan" class="btn btn-edit">💾 Simpan</button>
              <a href="hewan.php" class="btn btn-batal">🔙 Batal</a>
            </form>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>

<?php include "page/footer.php"; ?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($success): ?>
<script>
Swal.fire({
    html: `
      <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;">
        <svg class="swal2-success-ring" width="100" height="100" viewBox="0 0 120 120">
          <circle cx="60" cy="60" r="50" fill="none" stroke="#28a745" stroke-width="8" stroke-linecap="round" 
            stroke-dasharray="314" stroke-dashoffset="314">
            <animate attributeName="stroke-dashoffset" from="314" to="0" dur="1s" fill="freeze" />
          </circle>
          <polyline points="40,65 55,80 85,45" fill="none" stroke="#28a745" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"
            stroke-dasharray="80" stroke-dashoffset="80">
            <animate attributeName="stroke-dashoffset" from="80" to="0" dur="0.6s" begin="1s" fill="freeze" />
          </polyline>
        </svg>
        <h2 style="margin-top:15px;color:#28a745;font-weight:bold;">Data Berhasil Diedit!</h2>
        <p style="color:#333;">Perubahan sudah tersimpan.</p>
      </div>
    `,
    showConfirmButton: false,
    timer: 2500,
    backdrop: `rgba(0,0,0,0.4)`
}).then(() => {
    window.location.href = "hewan.php";
});
</script>
<?php endif; ?>

<style>
.bg-edit {
    background-color: #0066cc !important;
    border-color: #005bb5 !important;
    color: #fff !important;
}

.btn-edit {
    background-color: #0066cc !important;
    border-color: #005bb5 !important;
    color: #fff !important;
}
.btn-edit:hover {
    background-color: #004c99 !important;
    border-color: #003d80 !important;
}

.btn-batal {
    background-color: #ff2929ff !important;
    border-color: #ff7979ff !important;
    color: #fff !important;
}
.btn-batal:hover {
    background-color: #ff2828ff !important;
    border-color: #ff7070ff !important;
}
</style>

<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dist/js/adminlte.min.js"></script>
<script src="assets/dist/js/demo.js"></script>
</body>
</html>
