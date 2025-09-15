<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Logout</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(-45deg, #1e3c72, #2a5298, #2575fc, #1b4fb2);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      overflow: hidden;
      font-family: 'Poppins', sans-serif;
      color: #fff;
      position: relative;
    }
    @keyframes gradientBG {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
    }

    /* Gelembung */
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

    /* Box logout */
    .logout-wrapper {
      position: relative;
      border-radius: 25px;
      padding: 6px;
      overflow: hidden;
      z-index: 10;
    }
    .logout-wrapper::before {
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
    @keyframes rotateBorder {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .logout-box {
      position: relative;
      z-index: 2;
      background: rgba(255,255,255,0.95);
      padding: 50px 40px;
      border-radius: 20px;
      width: 450px;
      box-shadow: 0px 10px 40px rgba(0,0,0,0.3);
      text-align: center;
      backdrop-filter: blur(10px);
      color: #222;
    }

    .logout-box h1 {
      font-size: 32px;
      margin: 0 0 15px;
      animation: fadeInDown 1.5s ease forwards;
      opacity: 0;
    }
    .logout-box p {
      font-size: 16px;
      margin: 10px 0 20px;
      animation: fadeInUp 2s ease forwards;
      opacity: 0;
    }

    @keyframes fadeInDown {
      0% {transform: translateY(-30px); opacity: 0;}
      100% {transform: translateY(0); opacity: 1;}
    }
    @keyframes fadeInUp {
      0% {transform: translateY(30px); opacity: 0;}
      100% {transform: translateY(0); opacity: 1;}
    }

    /* Progress bar */
    .progress {
      margin: 20px auto 0;
      width: 250px;
      height: 8px;
      border-radius: 5px;
      background: rgba(0,0,0,0.1);
      overflow: hidden;
      position: relative;
    }
    .progress span {
      display: block;
      height: 100%;
      width: 0;
      background: linear-gradient(90deg, #2575fc, #6a11cb);
      animation: loadBar 3s forwards;
    }
    @keyframes loadBar {
      0% { width: 0; }
      100% { width: 100%; }
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="logout-wrapper">
    <div class="logout-box">
      <h1><i class="fa-solid fa-door-open"></i> Anda Telah Logout</h1>
      <p>Mengarahkan kembali ke halaman login...</p>
      <div class="progress"><span></span></div>
    </div>
  </div>

  <script>
    // efek bubble random
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

      setTimeout(() => {
        bubble.remove();
      }, 10000);
    }
    setInterval(createBubble, 800);

    // redirect otomatis
    setTimeout(() => {
      window.location.href = "login.php";
    }, 3000);
  </script>
</body>
</html>
