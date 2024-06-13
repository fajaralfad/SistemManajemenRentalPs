<?php
// Pastikan file db.php sudah menyediakan koneksi ke database
include 'db.php';

// Ambil data produk jika ada
$product_id = isset($_GET['id']) ? $_GET['id'] : null;
if ($product_id) {
    $query = "SELECT * FROM tb_product WHERE product_id = '$product_id'";
    $produk = mysqli_query($conn, $query);
    if ($produk && mysqli_num_rows($produk) > 0) {
        $p = mysqli_fetch_object($produk);
    } else {
        // Handle case where product is not found
        $p = null;
    }
} else {
    $p = null;
}

// Proses form jika ada POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $product_id = $_POST['product_id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jam = $_POST['jam'];
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $pembayaran = $_POST['pembayaran'];
    $tanggal_sewa = $_POST['tanggal_sewa']; // Tanggal sewa diambil dari input form
    $total_harga = $_POST['total_harga']; // Total harga dari input form

    // Validasi data (contoh sederhana, sesuaikan dengan kebutuhan)
    if (empty($nama) || empty($jam) || empty($no_hp) || empty($pembayaran) || empty($tanggal_sewa) || empty($total_harga)) {
        // Jika ada data yang kosong, beri pesan error
        echo '<script>alert("Harap isi semua kolom!")</script>';
        echo '<script>window.location="sewa.php?id=' . $product_id . '"</script>';
        exit;
    }

    // Query untuk memasukkan data ke dalam database
    $query = "INSERT INTO tb_sewa (product_id, nama, jam_sewa, no_hp, metode_pembayaran, tanggal_sewa, total_harga)
                  VALUES ('$product_id', '$nama', '$jam', '$no_hp', '$pembayaran', '$tanggal_sewa', '$total_harga')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Jika query berhasil dijalankan
        echo '<script>alert("Berhasil menyewa produk!")</script>';
        echo '<script>window.location="index.php"</script>';
    } else {
        // Jika terjadi error pada query
        echo '<script>alert("Gagal menyewa produk. Silakan coba lagi!")</script>';
        echo '<script>window.location="sewa.php?id=' . $product_id . '"</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSphere - Sewa Produk</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
    <script>
        function updateTotalPrice() {
            var jam = document.getElementById('jam').value;
            var pricePerHour = <?php echo $p ? $p->product_price : 0; ?>;
            var totalPrice = jam * pricePerHour;
            document.getElementById('total_harga').value = totalPrice;
        }
    </script>
</head>

<body>
    <!-- header -->
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <h1><a href="index.php">PSphere</a></h1>
        </div>
    </header>

    <!-- form sewa -->
    <div class="section">
        <div class="container mt-3">
            <h3 class="mb-3">Form Sewa Produk</h3>
            <div class="box">
                <form action="sewa.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $p ? $p->product_id : ''; ?>">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="jam">Sewa Berapa Hari</label>
                        <input type="number" name="jam" id="jam" class="form-control" placeholder="Masukkan Jumlah Sewa Perhari" required oninput="updateTotalPrice()">
                    </div>
                    <div class="form-group">
                        <label for="no_hp">Nomor HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Masukkan Nomor HP Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_sewa">Tanggal Sewa</label>
                        <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pembayaran">Pembayaran</label>
                        <select name="pembayaran" id="pembayaran" class="form-control" required>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="E-Wallet">E-Wallet</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total_harga">Total Harga</label>
                        <input type="text" id="total_harga" name="total_harga" class="form-control" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Sewa</button>
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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>