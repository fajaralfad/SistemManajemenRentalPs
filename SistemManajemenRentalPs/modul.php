<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modul Pengguna - PSphere</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
	<header class="header">
		<div class="container d-flex justify-content-between align-items-center">
			<h1><a href="dashboard.php">PSphere</a></h1>
			<ul class="nav">
				<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
				<li class="nav-item"><a href="modul.php" class="nav-link">Modul</a></li>
				<li class="nav-item"><a href="chat.php" class="nav-link">Chat</a></li>
			</ul>
		</div>
	</header>

    <!-- Modul Pengguna -->
    <div class="section">
        <div class="container mb-5 mt-5">
            <h3>Modul Pengguna</h3>
            <div class="accordion" id="modulAccordion">
                <!-- Modul 1: Cara Menggunakan Sistem -->
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Cara Menggunakan Sistem
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#modulAccordion">
                        <div class="card-body">
                            <ol>
                                <li>Login ke sistem menggunakan akun yang sudah terdaftar.</li>
                                <li>Pilih kategori produk yang ingin disewa.</li>
                                <li>Gunakan fitur pencarian untuk menemukan produk yang diinginkan.</li>
                                <li>Klik pada produk untuk melihat detail dan opsi penyewaan.</li>
                                <li>Pilih durasi sewa dan metode pembayaran.</li>
                                <li>Konfirmasi penyewaan dan selesaikan pembayaran.</li>
                                <li>Ambil produk di lokasi yang sudah ditentukan atau tunggu pengiriman.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Modul 2: Prosedur Penyewaan -->
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Prosedur Penyewaan
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#modulAccordion">
                        <div class="card-body">
                            <ol>
                                <li>Pilih produk yang ingin disewa.</li>
                                <li>Periksa ketersediaan produk untuk tanggal yang diinginkan.</li>
                                <li>Pilih durasi penyewaan yang sesuai dengan kebutuhan Anda.</li>
                                <li>Isi informasi penyewa dengan benar dan lengkap.</li>
                                <li>Review pesanan dan konfirmasi penyewaan.</li>
                                <li>Lakukan pembayaran sesuai dengan metode yang dipilih.</li>
                                <li>Simpan bukti pembayaran sebagai referensi.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Modul 3: FAQ -->
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                FAQ (Frequently Asked Questions)
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#modulAccordion">
                        <div class="card-body">
                            <ul>
                                <li><strong>Q:</strong> Bagaimana cara membuat akun baru?<br><strong>A:</strong> Klik tombol daftar di halaman utama, isi formulir pendaftaran, dan ikuti instruksi untuk mengaktifkan akun Anda.</li>
                                <li><strong>Q:</strong> Apa metode pembayaran yang diterima?<br><strong>A:</strong> Kami menerima pembayaran melalui transfer bank, kartu kredit, dan e-wallet.</li>
                                <li><strong>Q:</strong> Bagaimana cara memperpanjang masa sewa?<br><strong>A:</strong> Anda dapat memperpanjang masa sewa melalui akun Anda di sistem dengan memilih produk yang disewa dan memilih opsi perpanjangan.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <small>&copy; 2024 PSphere. All Rights Reserved.</small>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
