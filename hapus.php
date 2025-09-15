<?php
include "koneksi.php"; 
$id = $_GET['id'] ?? 0;

// Proses hapus
$hapus = mysqli_query($koneksi, "DELETE FROM hewan WHERE id_hewan='$id'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Data</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
<?php if ($hapus) { ?>
    Swal.fire({
        title: 'Terhapus!',
        text: 'Data hewan berhasil dihapus.',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location = 'hewan.php';
    });
<?php } else { ?>
    Swal.fire({
        title: 'Gagal!',
        text: 'Data gagal dihapus, coba lagi.',
        icon: 'error',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location = 'hewan.php';
    });
<?php } ?>
</script>
</body>
</html>
