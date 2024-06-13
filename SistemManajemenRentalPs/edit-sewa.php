<?php
session_start();
include 'db.php'; // Sesuaikan dengan file koneksi database Anda

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
    exit;
}

// Ambil data sewa berdasarkan ID
$sewa_id = $_GET['id'];
$sewa_query = mysqli_query($conn, "SELECT * FROM tb_sewa WHERE sewa_id = '$sewa_id' ");
if (mysqli_num_rows($sewa_query) == 0) {
    echo '<script>window.location="data-sewa.php"</script>';
    exit;
}
$s = mysqli_fetch_assoc($sewa_query);

// Proses form jika tombol Edit diklik
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $jam_sewa = $_POST['jam_sewa'];
    $no_hp = $_POST['no_hp'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $tanggal_sewa = $_POST['tanggal_sewa'];

    // Lakukan update data sewa di database
    $update = mysqli_query($conn, "UPDATE tb_sewa SET 
                            nama = '$nama',
                            jam_sewa = '$jam_sewa',
                            no_hp = '$no_hp',
                            metode_pembayaran = '$metode_pembayaran',
                            tanggal_sewa = '$tanggal_sewa'
                            WHERE sewa_id = '$sewa_id' ");
    if ($update) {
        echo '<script>alert("Edit data berhasil")</script>';
        echo '<script>window.location="data-sewa.php"</script>';
        exit; // Exit PHP script after redirection
    } else {
        echo 'gagal ' . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PSphere - Edit Data Sewa</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <h1><a href="dashboard.php">PSphere</a></h1>
            <ul class="nav">
                <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="profil.php" class="nav-link">Profile</a></li>
                <li class="nav-item"><a href="data-kategori.php" class="nav-link">Data Kategori</a></li>
                <li class="nav-item"><a href="data-produk.php" class="nav-link">Data Produk</a></li>
                <li class="nav-item"><a href="keluar.php" class="nav-link">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section my-5">
        <div class="container">
            <h3>Edit Data Sewa</h3>
            <div class="box">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama Pelanggan</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $s['nama'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_sewa">Hari</label>
                        <input type="text" name="jam_sewa" class="form-control" value="<?php echo $s['jam_sewa'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="<?php echo $s['no_hp'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <input type="text" name="metode_pembayaran" class="form-control" value="<?php echo $s['metode_pembayaran'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_sewa">Tanggal Sewa</label>
                        <input type="date" name="tanggal_sewa" class="form-control" value="<?php echo $s['tanggal_sewa'] ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </form>
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