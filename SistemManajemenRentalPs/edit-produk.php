<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
	echo '<script>window.location="login.php"</script>';
}

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '" . $_GET['id'] . "' ");
if (mysqli_num_rows($produk) == 0) {
	echo '<script>window.location="data-produk.php"</script>';
}
$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PSphere - Edit Data Produk</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
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
			<h3>Edit Data Produk</h3>
			<div class="box p-4 bg-light">
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="kategori">Kategori</label>
						<select class="form-control" name="kategori" required>
							<option value="">--Pilih--</option>
							<?php
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							while ($r = mysqli_fetch_array($kategori)) {
							?>
								<option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id) ? 'selected' : ''; ?>><?php echo $r['category_name'] ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label for="nama">Nama Produk</label>
						<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
					</div>

					<div class="form-group">
						<label for="harga">Sewa/hari</label>
						<input type="text" name="harga" id="harga" class="form-control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
					</div>

					<div class="form-group">
						<label for="gambar">Gambar Produk</label><br>
						<img src="produk/<?php echo $p->product_image ?>" width="100px" alt="Gambar Produk">
						<input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
						<input type="file" name="gambar" id="gambar" class="form-control-file">
					</div>

					<div class="form-group">
						<label for="deskripsi">Deskripsi Produk</label>
						<textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" placeholder="Deskripsi Produk"><?php echo $p->product_description ?></textarea>
					</div>

					<div class="form-group">
						<label for="status">Status</label>
						<select class="form-control" name="status">
							<option value="">--Pilih--</option>
							<option value="1" <?php echo ($p->product_status == 1) ? 'selected' : ''; ?>>Aktif</option>
							<option value="0" <?php echo ($p->product_status == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
						</select>
					</div>

					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				</form>
				<?php
				if (isset($_POST['submit'])) {
					// data inputan dari form
					$kategori 	= $_POST['kategori'];
					$nama 		= $_POST['nama'];
					$harga 		= $_POST['harga'];
					$status 	= $_POST['status'];
					$foto 		= $_POST['foto'];
					$deskripsi 	= $_POST['deskripsi'];

					// data gambar yang baru
					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];

					// jika admin ganti gambar
					if ($filename != '') {
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
							unlink('./produk/' . $foto);
							move_uploaded_file($tmp_name, './produk/' . $newname);
							$namagambar = $newname;
						}
					} else {
						// jika admin tidak ganti gambar
						$namagambar = $foto;
					}

					$update = mysqli_query($conn, "UPDATE tb_product SET 
                        category_id = '" . $kategori . "',
                        product_name = '" . $nama . "',
                        product_price = '" . $harga . "',
                        product_image = '" . $namagambar . "',
                        product_description = '" . $deskripsi . "', 
                        product_status = '" . $status . "'
                        WHERE product_id = '" . $p->product_id . "' ");

					if ($update) {
						echo '<script>alert("Ubah data berhasil")</script>';
						echo '<script>window.location="data-produk.php"</script>';
					} else {
						echo 'gagal ' . mysqli_error($conn);
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
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>