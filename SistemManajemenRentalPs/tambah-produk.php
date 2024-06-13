<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
	echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Produk | PSphere</title>
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
			<h3>Tambah Data Produk</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="kategori">Kategori</label>
						<select class="form-control" name="kategori" id="kategori" required>
							<option value="">--Pilih--</option>
							<?php
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							while ($r = mysqli_fetch_array($kategori)) {
							?>
								<option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="nama">Nama Produk</label>
						<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Produk" required>
					</div>
					<div class="form-group">
						<label for="harga">Sewa/hari</label>
						<input type="text" name="harga" class="form-control" id="harga" placeholder="Harga" required>
					</div>
					<div class="form-group">
						<label for="gambar">Gambar</label>
						<input type="file" name="gambar" class="form-control-file" id="gambar" required>
					</div>
					<div class="form-group">
						<label for="deskripsi">Deskripsi</label>
						<textarea name="deskripsi" class="form-control" id="deskripsi" rows="5" placeholder="Deskripsi Produk"></textarea>
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						<select class="form-control" name="status" id="status">
							<option value="">--Pilih--</option>
							<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>
						</select>
					</div>
					<button type="submit" name="submit" class="btn btn-primary">Kirim</button>
				</form>
				<?php
				if (isset($_POST['submit'])) {
					// menampung inputan dari form
					$kategori 	= $_POST['kategori'];
					$nama 		= $_POST['nama'];
					$harga 		= $_POST['harga'];
					$status 	= $_POST['status'];
					$deskripsi  = $_POST['deskripsi'];

					// menampung data file yang diupload
					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];

					$type1 = explode('.', $filename);
					$type2 = $type1[1];

					$newname = 'produk' . time() . '.' . $type2;

					// menampung data format file yang diizinkan
					$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

					// validasi format file
					if (!in_array($type2, $tipe_diizinkan)) {
						// jika format file tidak ada di dalam tipe diizinkan
						echo '<script>alert("Format file tidak diizinkan")</script>';
					} else {
						// jika format file sesuai dengan yang ada di dalam array tipe diizinkan
						// proses upload file sekaligus insert ke database
						move_uploaded_file($tmp_name, './produk/' . $newname);

						$insert = mysqli_query($conn, "INSERT INTO tb_product (category_id, product_name, product_price, product_image, product_status, product_description) VALUES (
										'" . $kategori . "',
										'" . $nama . "',
										'" . $harga . "',
										'" . $newname . "',
										'" . $status . "',
										'" . $deskripsi . "'
											) ");

						if ($insert) {
							echo '<script>alert("Tambah data berhasil")</script>';
							echo '<script>window.location="data-produk.php"</script>';
						} else {
							echo 'gagal ' . mysqli_error($conn);
						}
					}
				}
				?>
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