<?php
session_start();
include 'db.php'; // Sesuaikan dengan file koneksi database Anda

// Periksa status login
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
    exit;
}

// Proses pencarian
$search = "";
$where_clause = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $where_clause = "WHERE nama LIKE '%$search%'";
}

$query = "SELECT * FROM tb_sewa $where_clause ORDER BY sewa_id DESC";
$result = mysqli_query($conn, $query);

// Proses update status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sewa_id = $_POST['sewa_id'];
    $status = $_POST['status'];

    $update_query = "UPDATE tb_sewa SET status = '$status' WHERE sewa_id = $sewa_id";
    mysqli_query($conn, $update_query);
    header('Location: ' . $_SERVER['PHP_SELF']); // Redirect to refresh the page
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Sewa - PSphere</title>
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
				<li class="nav-item"><a href="data-kategori.php" class="nav-link">Data Kategori</a></li>
				<li class="nav-item"><a href="data-produk.php" class="nav-link">Data Produk</a></li>
				<li class="nav-item"><a href="data-sewa.php" class="nav-link">Data Sewa</a></li>
				<li class="nav-item"><a href="chat-admin.php" class="nav-link">Chat</a></li>
				<li class="nav-item"><a href="keluar.php" class="nav-link">Keluar</a></li>
			</ul>
		</div>
	</header>
    <!-- content -->
    <div class="section my-5">
        <div class="container">
            <h3>Data Sewa</h3>
            <div class="box">
                <form method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama Pelanggan" value="<?php echo htmlspecialchars($search); ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Hari</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Metode Pembayaran</th>
                                <th scope="col">Tanggal Sewa</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $row['product_id'] ?></td>
                                        <td><?php echo $row['nama'] ?></td>
                                        <td><?php echo $row['jam_sewa'] ?></td>
                                        <td><?php echo $row['no_hp'] ?></td>
                                        <td><?php echo $row['metode_pembayaran'] ?></td>
                                        <td><?php echo $row['tanggal_sewa'] ?></td>
                                        <td>Rp.<?php echo number_format($row['total_harga']) ?></td>
                                        <td>
                                            <?php if ($row['status'] == 'diterima') : ?>
                                                <i class="bi bi-check-circle text-success"></i> Diterima
                                            <?php elseif ($row['status'] == 'tidak diterima') : ?>
                                                <i class="bi bi-x-circle text-danger"></i> Tidak Diterima
                                            <?php else : ?>
                                                <form action="data-sewa.php" method="POST">
                                                    <input type="hidden" name="sewa_id" value="<?php echo $row['sewa_id']; ?>">
                                                    <select name="status" class="form-control">
                                                        <option value="">Pilih Status</option>
                                                        <option value="diterima">Diterima</option>
                                                        <option value="tidak diterima">Tidak Diterima</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Simpan</button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="edit-sewa.php?id=<?php echo $row['sewa_id'] ?>" class="btn btn-warning btn-sm mr-2">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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