<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// hanya admin & operator yang bisa akses tambah
if ($_SESSION['level'] != "admin" && $_SESSION['level'] != "operator") {
    echo "❌ Anda tidak punya akses ke halaman ini!";
    exit;
}

include "page/header.php";
include "page/navbar.php";
include "page/sidebar.php";
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Hewan</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="hewan.php" class="btn btn-secondary">⬅ Kembali</a>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-header bg-simpan text-white">
          <h3 class="card-title">Form Tambah Hewan</h3>
        </div>

        <form action="" method="POST" id="formTambah">
          <div class="card-body">
            <div class="form-group">
              <label>Nama Hewan</label>
              <input type="text" name="nama_hewan" class="form-control" placeholder="Masukkan Nama Hewan" required>
            </div>
            <div class="form-group">
              <label>Jenis Hewan</label>
              <input type="text" name="jenis_hewan" class="form-control" placeholder="Masukkan Jenis Hewan" required>
            </div>
            <div class="form-group">
              <label>Asal</label>
              <input type="text" name="asal" class="form-control" placeholder="Masukkan Asal" required>
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="number" name="jumlah" class="form-control" placeholder="Masukkan Jumlah" required>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" name="simpan" class="btn btn-simpan">💾 Simpan</button>
            <a href="hewan.php" class="btn btn-batal">❌ Batal</a>
          </div>
        </form>
      </div>
    </section>
  </div>
</div>

<!-- Overlay Loading -->
<div id="loadingOverlay">
  <div class="checkmark-wrapper">
    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
      <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
      <path class="checkmark-check" fill="none" d="M14 27l7 7 16-16"/>
    </svg>
    <p class="success-text">Data berhasil disimpan!</p>
  </div>
</div>

<?php
// proses simpan data
include "koneksi.php";
if (isset($_POST['simpan'])) {
  $nama   = $_POST['nama_hewan'];
  $jenis  = $_POST['jenis_hewan'];
  $asal   = $_POST['asal'];
  $jumlah = $_POST['jumlah'];

  $query = "INSERT INTO hewan (nama_hewan, jenis_hewan, asal, jumlah) 
            VALUES ('$nama','$jenis','$asal','$jumlah')";
  mysqli_query($koneksi, $query);

  echo "<script>
          document.addEventListener('DOMContentLoaded', function(){
            document.getElementById('loadingOverlay').style.display = 'flex';
            setTimeout(function(){
              window.location='hewan.php';
            }, 2500); // delay 2,5 detik lalu redirect
          });
        </script>";
}
?>

<?php include "page/footer.php"; ?>

<style>
.bg-simpan,
.btn-simpan {
    background-color: #2d8ef6ff !important;
    border-color: rgba(61, 158, 255, 1) !important;
    color: #fff !important;
}

.btn-simpan:hover {
    background-color: #4ea6ffff !important;
    border-color: #3a9cffff !important;
}

.btn-batal {
    background-color: #ff3434ff !important;
    border-color: #ff3737e1 !important;
    color: #fff !important;
}

.btn-batal:hover {
    background-color: #ff3636ff !important;
    border-color: #ff3a3aff !important;
}

#loadingOverlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.85);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    animation: fadeIn 0.5s ease forwards;
}

.checkmark-wrapper {
    text-align: center;
    color: #fff;
}

.checkmark {
    width: 100px;
    height: 100px;
    stroke-width: 4;
    stroke: #28a745;
    stroke-miterlimit: 10;
    box-shadow: inset 0px 0px 0px #28a745;
    border-radius: 50%;
    display: block;
    margin: 0 auto 20px;
}

.checkmark-circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 4;
    stroke-miterlimit: 10;
    stroke: #28a745;
    fill: none;
    animation: stroke 0.6s cubic-bezier(.65,.05,.36,1) forwards;
}

.checkmark-check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    stroke: #28a745;
    animation: stroke 0.3s cubic-bezier(.65,.05,.36,1) 0.6s forwards;
}

/* Teks */
.success-text {
    font-size: 20px;
    font-weight: bold;
    opacity: 0;
    transform: translateY(10px);
    animation: fadeUp 0.5s ease 0.9s forwards;
}

/* Animasi */
@keyframes stroke {
    100% { stroke-dashoffset: 0; }
}
@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>

<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dist/js/adminlte.min.js"></script>
<script src="assets/dist/js/demo.js"></script>
</body>
</html>
