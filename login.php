<?php
session_start();
include "koneksi.php";

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level    = $_POST['level'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND level='$level'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['level']    = $row['level'];

        $pesan = "";
        $redirect = "";
        if ($row['level'] == 'admin') {
            $pesan = "Selamat datang Admin 👑, siap mengelola sistem hari ini!";
            $redirect = "index.php";
        } elseif ($row['level'] == 'operator') {
            $pesan = "Halo Operator ⚙️, semoga kerjaanmu lancar 🚀";
            $redirect = "operator.php";
        } elseif ($row['level'] == 'user') {
            $pesan = "Hai User 🙌, senang melihatmu kembali! 🎉";
            $redirect = "user.php";
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
              background: linear-gradient(-45deg, #1e3c72, #2a5298, #2575fc, #1b4fb2);
              background-size: 400% 400%;
              animation: gradientBG 15s ease infinite;
              font-family: 'Poppins', sans-serif;
              color: #fff;
              text-align: center;
              overflow: hidden;
            }
            @keyframes gradientBG {
              0% {background-position: 0% 50%;}
              50% {background-position: 100% 50%;}
              100% {background-position: 0% 50%;}
            }
            .loader {
              border: 6px solid rgba(255, 255, 255, 0.3);
              border-top: 6px solid #fff;
              border-radius: 50%;
              width: 70px;
              height: 70px;
              animation: spin 1s linear infinite;
              margin: auto;
            }
            @keyframes spin {
              0% { transform: rotate(0deg); }
              100% { transform: rotate(360deg); }
            }
            .message {
              margin-top: 20px;
              font-size: 1.3em;
              opacity: 0;
              transform: translateY(20px);
              animation: fadeInUp 1s forwards;
              animation-delay: 1s;
            }
            @keyframes fadeInUp {
              to { opacity: 1; transform: translateY(0); }
            }
            .bubble {
              position: absolute;
              bottom: -100px;
              background: rgba(255, 255, 255, 0.2);
              border-radius: 50%;
              pointer-events: none;
              animation: rise linear forwards;
              box-shadow: 0 0 15px rgba(255, 255, 255, 0.4);
            }
            @keyframes rise {
              from { transform: translateY(0) scale(1); opacity: 1; }
              to { transform: translateY(-120vh) scale(1.3); opacity: 0; }
            }
          </style>
        </head>
        <body>
          <div>
            <div class="loader"></div>
            <div class="message"><?= $pesan ?></div>
          </div>
          <script>
            function createBubble() {
              const bubble = document.createElement("div");
              const size = Math.random() * 40 + 10;
              const left = Math.random() * window.innerWidth;
              bubble.classList.add("bubble");
              bubble.style.width = `${size}px`;
              bubble.style.height = `${size}px`;
              bubble.style.left = `${left}px`;
              bubble.style.animationDuration = `${Math.random() * 5 + 5}s`;
              document.body.appendChild(bubble);
              setTimeout(() => { bubble.remove(); }, 10000);
            }
            setInterval(createBubble, 800);

            setTimeout(function() {
              window.location.href = "<?= $redirect ?>";
            }, 3000);
          </script>
        </body>
        </html>
        <?php
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Multi User</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      height: 100vh;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(-45deg, #1e3c72, #2a5298, #2575fc, #1b4fb2);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      position: relative;
    }
    @keyframes gradientBG {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
    }
    .bubble {
      position: absolute;
      bottom: -100px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      pointer-events: none;
      animation: rise linear forwards;
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.4);
    }
    @keyframes rise {
      from { transform: translateY(0) scale(1); opacity: 1; }
      to { transform: translateY(-120vh) scale(1.3); opacity: 0; }
    }
    .login-wrapper {
      position: relative;
      border-radius: 25px;
      padding: 6px;
      overflow: hidden;
      z-index: 10;
    }
    .login-wrapper::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: conic-gradient(#2575fc, #1e60d4, #1b4fb2, #1e60d4, #2575fc);
      animation: rotateBorder 6s linear infinite;
      z-index: 1;
    }
    .login-wrapper.error::before {
      background: conic-gradient(#e53935, #b71c1c, #d32f2f, #c62828, #e53935);
    }
    @keyframes rotateBorder {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .login-box {
      position: relative;
      z-index: 2;
      background: rgba(255,255,255,0.95);
      padding: 50px 40px;
      border-radius: 20px;
      width: 450px;
      box-shadow: 0px 10px 40px rgba(0,0,0,0.3);
      text-align: center;
      backdrop-filter: blur(10px);
      transition: all 0.3s ease;
    }
    .login-box.shake {
      animation: shakeBox 0.3s ease;
    }
    @keyframes shakeBox {
      0%, 100% { transform: translateX(0); }
      20%, 60% { transform: translateX(-8px); }
      40%, 80% { transform: translateX(8px); }
    }
    .title {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 8px;
      color: #222;
    }
    .subtitle {
      font-size: 14px;
      color: #555;
      margin-bottom: 25px;
      line-height: 1.4;
    }
    .role-title {
      margin-top: 25px;
      margin-bottom: 15px;
      font-size: 15px;
      color: #333;
      font-weight: 600;
      text-align: center;
      letter-spacing: 0.5px;
    }
    .error-box {
      background: #ffe0e0;
      color: #b00020;
      border: 1px solid #f5c2c7;
      border-radius: 8px;
      padding: 10px;
      margin-bottom: 15px;
      font-size: 14px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .error-box i { cursor: pointer; }
    .input-group {
      display: flex;
      align-items: center;
      margin: 12px 0;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 12px;
      background: #f9f9f9;
      position: relative;
    }
    .input-group input {
      border: none;
      outline: none;
      flex: 1;
      background: transparent;
      font-size: 14px;
    }
    .input-group i { margin-right: 10px; color: #666; }
    .toggle-password {
      position: absolute;
      right: 12px;
      cursor: pointer;
      color: #666;
    }
    .toggle-password:hover { color: #2575fc; }
    .level-options {
      display: flex;
      justify-content: space-between;
      margin: 20px 0;
    }
    .level {
      flex: 1;
      margin: 0 5px;
      padding: 15px;
      border: 2px solid transparent;
      border-radius: 15px;
      cursor: pointer;
      transition: all 0.4s ease;
      text-align: center;
      font-size: 14px;
      user-select: none;
      background: #f0f0f0;
    }
    .level i {
      font-size: 28px;
      display: block;
      margin-bottom: 8px;
    }
    .level[data-value="admin"] i { color: #e53935; animation: pulse 2s infinite; }
    .level[data-value="operator"] i { color: #ff9800; animation: spin 2s linear infinite; }
    .level[data-value="user"] i { color: #4caf50; animation: bounce 2s infinite; }
    @keyframes pulse { 0%,100%{transform:scale(1);}50%{transform:scale(1.2);} }
    @keyframes spin { 0%{transform:rotate(0);}100%{transform:rotate(360deg);} }
    @keyframes bounce {0%,100%{transform:translateY(0);}50%{transform:translateY(-8px);} }
    .level.active {
      border-color: #2575fc;
      background: #e6f0ff;
      color: #2575fc;
      font-weight: bold;
      transform: scale(1.05);
      box-shadow: 0 0 15px rgba(37,117,252,0.4);
    }
    button {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #2575fc, #6a11cb);
      color: #fff;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.3s;
      font-weight: bold;
      font-size: 15px;
    }
    button:hover {
      transform: translateY(-2px) scale(1.02);
      box-shadow: 0px 6px 20px rgba(37,117,252,0.5);
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="login-wrapper <?= !empty($error) ? 'error' : '' ?>">
    <div class="login-box <?= !empty($error) ? 'shake' : '' ?>">
      <h1 class="title">Selamat Datang 👋</h1>
      <p class="subtitle">Silakan masuk ke akun Anda untuk melanjutkan</p>

      <?php if (!empty($error)) { ?>
        <div class="error-box" id="errorBox">
          <span><?= $error ?></span>
          <i class="fa-solid fa-xmark" id="closeError"></i>
        </div>
      <?php } ?>

      <form method="post" action="" autocomplete="off">
        <div class="input-group">
          <i class="fa-solid fa-user"></i>
          <input type="text" name="username" placeholder="Username" autocomplete="off" required>
        </div>

        <div class="input-group">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="password" id="password" placeholder="Password" autocomplete="new-password" required>
          <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
        </div>

        <input type="hidden" name="level" id="levelInput">

        <h4 class="role-title">Pilih Role Akses Anda</h4>

        <div class="level-options">
          <div class="level" data-value="admin">
            <i class="fa-solid fa-crown"></i> Admin
          </div>
          <div class="level" data-value="operator">
            <i class="fa-solid fa-gear"></i> Operator
          </div>
          <div class="level" data-value="user">
            <i class="fa-solid fa-user"></i> User
          </div>
        </div>

        <button type="submit" name="login">Masuk</button>
      </form>
    </div>
  </div>

  <script>
    const levels = document.querySelectorAll(".level");
    const levelInput = document.getElementById("levelInput");
    levels.forEach(level => {
      level.addEventListener("click", () => {
        levels.forEach(l => l.classList.remove("active"));
        level.classList.add("active");
        levelInput.value = level.dataset.value;
      });
    });

    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");
    togglePassword.addEventListener("click", () => {
      const type = passwordInput.type === "password" ? "text" : "password";
      passwordInput.type = type;
      togglePassword.classList.toggle("fa-eye-slash");
    });

    function createBubble() {
      const bubble = document.createElement("div");
      const size = Math.random() * 30 + 10;
      const left = Math.random() * window.innerWidth;
      bubble.classList.add("bubble");
      bubble.style.width = `${size}px`;
      bubble.style.height = `${size}px`;
      bubble.style.left = `${left}px`;
      bubble.style.animationDuration = `${Math.random() * 2 + 5}s`;
      document.body.appendChild(bubble);
      setTimeout(() => { bubble.remove(); }, 10000);
    }
    setInterval(createBubble, 800);

    const closeError = document.getElementById("closeError");
    if (closeError) {
      closeError.addEventListener("click", () => {
        document.getElementById("errorBox").remove();
        document.querySelector(".login-wrapper").classList.remove("error");
        document.querySelector(".login-box").classList.remove("shake");
      });
    }
  </script>
</body>
</html>
