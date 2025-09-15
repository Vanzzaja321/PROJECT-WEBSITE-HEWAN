<?php
session_start();

// Cek login & level
if (!isset($_SESSION['level']) || !in_array($_SESSION['level'], ['admin','operator'])) {
    header("Location: index.php");
    exit;
}

include 'page/header.php';
?>
<!-- Akhir Header -->

<!-- Navbar -->
<?php include 'page/navbar.php'; ?>
<!--Akhir Navbar  -->

<!-- sidebar -->
<?php include 'page/sidebar.php'; ?>
<!-- Akhir Sidebar -->
 
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kategori Hewan</title>
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">

<div class="content-wrapper">
  <section class="content-header">
    <h1>🐾 Kategori Hewan</h1>
  </section>

  <section class="content">
    <ul class="list-group">
      <li class="list-group-item">Mamalia</li>
      <li class="list-group-item">Burung</li>
      <li class="list-group-item">Reptil</li>
      <li class="list-group-item">Ikan</li>
      <li class="list-group-item">Amfibi</li>
    </ul>
  </section>
</div>

<?php include 'page/footer.php'; ?>

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dist/js/adminlte.min.js"></script>
<script src="assets/dist/js/demo.js"></script>
</body>
</html>
