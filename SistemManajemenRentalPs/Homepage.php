<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>Dashboard Rental PS</title>

    <style>
        

        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            font-family: 'Quicksand', sans-serif;
        }
      


        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .background img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(50%);
        }

        .dashboard {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
            color: transparent; /* Warna teks transparan */
            text-align: center;
            background-image: linear-gradient(to right, #ff7e5f, #feb47b, #ffeb99, #a3e1d4, #75b9e2, #ff7e5f); /* Gradien warna teks */
            -webkit-background-clip: text; /* Untuk menerapkan gradien ke teks */
            background-clip: text; /* Untuk menerapkan gradien ke teks */
        }

        .content {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .content h1 {
            margin: 0 0 20px;
            font-size: 3em;
            color: #00BFFF; /* Warna teks putih */
            font-family: 'GameFont', sans-serif; /* Menggunakan font GameFont yang diimpor */
            font-weight: bold; /* Menjadikan teks "Selamat Datang di PSphere" menjadi bold */
            animation: animateTyping 4s steps(40) both; /* Animasi teks bergerak mengetik */
        }

        .content p {
            font-size: 18px;
            margin: 20px 0; /* Mengatur jarak atas dan bawah dari paragraf */
            color: #f3f3f3; /* Ubah warna teks paragraf agar lebih menarik */
            
            line-height: 1.6; /* Mengatur jarak antara baris pada paragraf */
        }

        .content .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .content .buttons a {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-weight: bold; /* Menjadikan teks pada tombol menjadi bold */
        }

        .content .buttons a:hover {
            background-color: #0056b3;
        }

        @keyframes animateTyping {
            from {
                width: 0;
            }
            to {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="background">
        <img src="./img/bgpls1.jpg" alt="Background Image">
    </div>
    <div class="dashboard">
        <div class="content">
            <h1>Selamat Datang di PSphere</h1>
            <p>Temukan pengalaman bermain game terbaik dengan PlayStation kami. <br>Sewa sekarang dan nikmati berbagai permainan menarik!</p>
            <div class="buttons">
                <a href="index.php">Jelajahi Sekarang</a>
                <a href="login.php">Login Admin</a>
            </div>
        </div>
    </div>
</body>
</html>
