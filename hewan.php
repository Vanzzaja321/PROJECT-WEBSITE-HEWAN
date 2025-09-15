<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include "koneksi.php";
?>

<?php include "page/header.php"; ?> 
<?php include "page/navbar.php"; ?> 
<?php include "page/sidebar.php"; ?> 

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Hewan</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
      <div class="card">

        <div class="card-header">
          <h3 class="card-title">Daftar Hewan</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>

        <div class="card-body">

          <!-- Tombol tambah hanya admin -->
          <?php if ($_SESSION['level'] == "admin") { ?>
            <div style="margin-bottom:15px;">
              <a href="tambah.php" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Hewan
              </a>
            </div>
          <?php } ?>

          <!-- Tabel Data Hewan -->
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Hewan</th>
                <th>Jenis Hewan</th>
                <th>Asal</th>
                <th>Jumlah</th>
                <?php if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "operator") { ?>
                  <th>Aksi</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php
                $sqlt = mysqli_query($koneksi, "SELECT * FROM hewan");
                $no = 1;
                while($dat = mysqli_fetch_assoc($sqlt)) {
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $dat['nama_hewan']; ?></td>
                <td><?= $dat['jenis_hewan']; ?></td>
                <td><?= $dat['asal']; ?></td>
                <td><?= $dat['jumlah']; ?></td>
                <td>
                  <!-- Edit: admin & operator -->
                  <?php if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "operator") { ?>
                    <a href="edit.php?id=<?= $dat['id_hewan'] ?>" class="btn btn-warning btn-sm">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                  <?php } ?>

                  <!-- Hapus: hanya admin -->
                  <?php if ($_SESSION['level'] == "admin") { ?>
                    <a href="hapus.php?id=<?= $dat['id_hewan']; ?>" 
                       class="btn btn-danger btn-sm btn-hapus">
                      <i class="fas fa-trash-alt"></i> Hapus
                    </a>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>

        <div class="card-footer">
        </div>
      </div>
    </section>
  </div>
</div>

<?php include "page/footer.php"; ?>
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dist/js/adminlte.min.js"></script>
<script src="assets/dist/js/demo.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const hapusButtons = document.querySelectorAll('.btn-hapus');

    hapusButtons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault(); // cegah langsung ke hapus.php
            const link = this.getAttribute('href');

            Swal.fire({
                title: 'Yakin Menghapus?',
                text: "Data hewan ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
                cancelButtonText: '<i class="fas fa-times"></i> Batal',
                reverseButtons: true,
                showClass: { popup: 'animate__animated animate__fadeInDown' },
                hideClass: { popup: 'animate__animated animate__fadeOutUp' }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link; // baru proses hapus
                }
            });
        });
    });
});
</script>
<!-- Animate.css biar popup lebih keren -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</body>
</html>
