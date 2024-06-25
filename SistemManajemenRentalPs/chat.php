<?php
include 'db.php'; // Memasukkan file koneksi ke database

// Fungsi untuk membersihkan input dari XSS (Cross-Site Scripting)
function clean_input($input) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags(trim($input))));
}

// Proses pengiriman pesan
if (isset($_POST['submit'])) {
    $pengirim = clean_input($_POST['pengirim']);
    $penerima = clean_input($_POST['penerima']);
    $pesan = clean_input($_POST['pesan']);
    $role_pengirim = 'user'; // Asumsikan pengirim adalah user

    // Memasukkan pesan ke dalam database
    $query_insert = "INSERT INTO tb_chat (pengirim, penerima, pesan, role) VALUES ('$pengirim', '$penerima', '$pesan', '$role_pengirim')";
    $result = mysqli_query($conn, $query_insert);
    if ($result) {
        $pesan_status = "Pesan berhasil dikirim.";
    } else {
        $pesan_status = "Gagal mengirim pesan: " . mysqli_error($conn);
    }
}

// Ambil semua pesan antara user dan admin dari database untuk ditampilkan
$query_pesan = "SELECT * FROM tb_chat WHERE (pengirim = 'user' AND penerima = 'admin') OR (pengirim = 'admin' AND penerima = 'user') ORDER BY waktu ASC";
$result_pesan = mysqli_query($conn, $query_pesan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSphere - Chat</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .pesan {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>
   <!-- header -->
	<header class="header">
		<div class="container d-flex justify-content-between align-items-center">
			<h1><a href="index.php">PSphere</a></h1>
			<ul class="nav">
				<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
				<li class="nav-item"><a href="modul.php" class="nav-link">Modul</a></li>
				<li class="nav-item"><a href="chat.php" class="nav-link">Chat</a></li>
			</ul>
		</div>
	</header>

    <div class="container mt-5">
        <h2>Chat PSphere</h2>

        <!-- Form untuk mengirim pesan -->
        <form method="post" action="">
            <div class="form-group">
                <label for="pengirim">Pengirim:</label>
                <input type="text" class="form-control" id="pengirim" name="pengirim" value="user" readonly>
            </div>
            <div class="form-group">
                <label for="penerima">Penerima:</label>
                <input type="text" class="form-control" id="penerima" name="penerima" value="admin" readonly>
            </div>
            <div class="form-group">
                <label for="pesan">Pesan:</label>
                <textarea class="form-control" id="pesan" name="pesan" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Kirim Pesan</button>
        </form>

        <br>

        <!-- Pesan yang telah dikirim -->
        <div class="daftar-pesan">
            <?php
            if (isset($pesan_status)) {
                echo '<div class="alert alert-info" role="alert">' . $pesan_status . '</div>';
            }

            // Menampilkan semua pesan antara user dan admin dari database
            if (mysqli_num_rows($result_pesan) > 0) {
                while ($pesan = mysqli_fetch_assoc($result_pesan)) {
                    echo '<div class="pesan">';
                    echo '<strong>' . htmlspecialchars($pesan['pengirim']) . '</strong> kepada <strong>' . htmlspecialchars($pesan['penerima']) . '</strong>: ' . htmlspecialchars($pesan['pesan']);
                    echo '<span class="text-muted" style="font-size: 12px; float: right;">' . date('d M Y H:i', strtotime($pesan['waktu'])) . '</span>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-muted">Belum ada pesan antara user dan admin.</p>';
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
