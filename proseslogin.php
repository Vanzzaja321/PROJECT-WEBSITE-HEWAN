<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Cek user dari database
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];

    // Tentukan pesan berdasarkan level
    $pesan = "";
    $redirect = "";
    if ($data['level'] == "admin") {
        $pesan = "Selamat datang Admin, siap mengelola sistem hari ini!";
        $redirect = "page/admin.php";
    } elseif ($data['level'] == "operator") {
        $pesan = "Halo Operator, semoga kerjaanmu lancar 🚀";
        $redirect = "page/operator.php";
    } elseif ($data['level'] == "user") {
        $pesan = "Hai User, senang melihatmu kembali! 🎉";
        $redirect = "page/user.php";
    } else {
        $pesan = "Level tidak dikenali.";
        $redirect = "login.php";
    }
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Login Berhasil</title>
        <style>
            body {
                margin: 0;
                padding: 0;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                background: linear-gradient(135deg, #667eea, #764ba2);
                font-family: 'Segoe UI', sans-serif;
                color: #fff;
                text-align: center;
            }
            .loader {
                border: 6px solid rgba(255, 255, 255, 0.3);
                border-top: 6px solid #fff;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                animation: spin 1s linear infinite;
                margin: auto;
            }
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            .message {
                margin-top: 20px;
                font-size: 1.2em;
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 1s forwards;
                animation-delay: 1.2s;
            }
            @keyframes fadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </head>
    <body>
        <div>
            <div class="loader"></div>
            <div class="message"><?php echo $pesan; ?></div>
        </div>
        <script>
            // Redirect otomatis setelah 3 detik
            setTimeout(function() {
                window.location.href = "<?php echo $redirect; ?>";
            }, 3000);
        </script>
    </body>
    </html>
    <?php
} else {
    echo "<script>alert('Login gagal! Username atau Password salah.'); window.location='login.php';</script>";
}
?>
