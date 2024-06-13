<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
	echo '<script>window.location="login.php"</script>';
}

// Proses pencarian
$search = "";
if (isset($_GET['search'])) {
	$search = $_GET['search'];
	$produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) WHERE product_name LIKE '%$search%' ORDER BY product_id DESC");
} else {
	$produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PSphere</title>
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
				<li class="nav-item"><a href="keluar.php" class="nav-link">Keluar</a></li>
			</ul>
		</div>
	</header>
	<!-- content -->
	<div class="section my-5">
		<div class="container">
			<h3>Data Produk</h3>
			<div class="box">
				<form method="GET" class="mb-3">
					<div class="input-group">
						<input type="text" name="search" class="form-control" placeholder="Cari Produk" value="<?php echo htmlspecialchars($search); ?>">
						<div class="input-group-append">
							<button type="submit" class="btn btn-primary">
								<i class="bi bi-search"></i> Cari
							</button>
						</div>
					</div>
				</form>
				<a href="tambah-produk.php" class="btn btn-primary mb-3">Tambah Produk</a>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Kategori</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>Gambar</th>
							<th>Deskripsi</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						if (mysqli_num_rows($produk) > 0) {
							while ($row = mysqli_fetch_array($produk)) {
						?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $row['category_name'] ?></td>
									<td><?php echo $row['product_name'] ?></td>
									<td>Rp.<?php echo number_format($row['product_price']) ?></td>
									<td><img src="produk/<?php echo $row['product_image'] ?>" width="100px"></td>
									<td><?php echo $row['product_description'] ?></td>
									<td><?php echo ($row['product_status'] == 1) ? 'Aktif' : 'Tidak Aktif'; ?></td>
									<td>
										<a href="edit-produk.php?id=<?php echo $row['product_id'] ?>" class="btn btn-warning btn-sm">
											<i class="bi bi-pencil"></i>
										</a>
										<a href="proses-hapus.php?idp=<?php echo $row['product_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus ?')">
											<i class="bi bi-trash"></i>
										</a>
									</td>
								</tr>
							<?php }
						} else { ?>
							<tr>
								<td colspan="8" class="text-center">Tidak ada data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
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