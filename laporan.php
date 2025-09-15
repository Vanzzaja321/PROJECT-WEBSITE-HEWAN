<?php
session_start();
include "koneksi.php";

// Hanya admin
if ($_SESSION['level'] != 'admin') {
    header("Location: index.php");
    exit;
}
include 'page/header.php';
?>
<!-- Akhir Header -->


<!-- Navbar -->
<?php
include 'page/navbar.php';
?>
<!--Akhir Navbar  -->

<!-- sidebar -->
<?php
include 'page/sidebar.php';

// Hitung data hewan
$total = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM hewan"))['jml'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan & Statistik</title>
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">

<div class="content-wrapper">
  <section class="content-header">
    <h1>📊 Laporan & Statistik</h1>
  </section>

  <section class="content">
    <div class="alert alert-info">
      Total Data Hewan: <b><?= $total; ?></b>
    </div>
  </section>
</div>

<?php
include 'page/footer.php';
?>


<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dist/js/adminlte.min.js"></script>
<script src="assets/dist/js/demo.js"></script>
</body>
</html>

