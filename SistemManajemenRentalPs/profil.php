<?php
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

	$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
	$d = mysqli_fetch_object($query);

	if(isset($_POST['submit'])){
		$nama   = ucwords($_POST['nama']);
		$user   = $_POST['user'];
		$hp     = $_POST['hp'];
		$email  = $_POST['email'];
		$alamat = ucwords($_POST['alamat']);

		// Proses upload gambar
		if($_FILES['gambar']['name'] != ''){
			$gambar     = $_FILES['gambar']['name'];
			$tmp_name   = $_FILES['gambar']['tmp_name'];
			$upload_dir = 'uploads/';

			// Pindahkan gambar ke direktori yang ditentukan
			move_uploaded_file($tmp_name, $upload_dir.$gambar);

			// Hapus gambar lama jika ada
			if($d->gambar != ''){
				unlink($upload_dir.$d->gambar);
			}

			$update = mysqli_query($conn, "UPDATE tb_admin SET 
											admin_name = '".$nama."',
											username = '".$user."',
											admin_telp = '".$hp."',
											admin_email = '".$email."',
											admin_address = '".$alamat."',
											gambar = '".$gambar."'
											WHERE admin_id = '".$d->admin_id."' ");
		} else {
			$update = mysqli_query($conn, "UPDATE tb_admin SET 
											admin_name = '".$nama."',
											username = '".$user."',
											admin_telp = '".$hp."',
											admin_email = '".$email."',
											admin_address = '".$alamat."'
											WHERE admin_id = '".$d->admin_id."' ");
		}

		if($update){
			// Ambil ulang data admin setelah update
			$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$d->admin_id."' ");
			$d = mysqli_fetch_object($query);

			// Perbarui session admin_name
			$_SESSION['a_global']->admin_name = $d->admin_name;

			echo '<script>alert("Ubah data berhasil")</script>';
			echo '<script>window.location="profil.php"</script>';
		} else {
			echo 'gagal '.mysqli_error($conn);
		}
	}

	// Proses perubahan password
	if(isset($_POST['ubah_password'])){
		$pass1 	= $_POST['pass1'];
		$pass2 	= $_POST['pass2'];

		if($pass2 != $pass1){
			echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
		} else {
			$u_pass = mysqli_query($conn, "UPDATE tb_admin SET 
						password = '".MD5($pass1)."'
						WHERE admin_id = '".$d->admin_id."' ");
			if($u_pass){
				echo '<script>alert("Ubah password berhasil")</script>';
				echo '<script>window.location="profil.php"</script>';
			} else {
				echo 'gagal '.mysqli_error($conn);
			}
		}
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
			<h3>Profile</h3>
			<div class="box p-4 bg-light">
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="nama">Nama Lengkap</label>
						<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo $d->admin_name ?>" required>
					</div>
					<div class="form-group">
						<label for="user">Username</label>
						<input type="text" name="user" id="user" class="form-control" placeholder="Username" value="<?php echo $d->username ?>" required>
					</div>
					<div class="form-group">
						<label for="hp">No Hp</label>
						<input type="text" name="hp" id="hp" class="form-control" placeholder="No Hp" value="<?php echo $d->admin_telp ?>" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $d->admin_email ?>" required>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" value="<?php echo $d->admin_address ?>" required>
					</div>
					<div class="form-group">
    					<label for="gambar">Gambar</label>
    					<input type="file" name="gambar" id="gambar" class="form-control-file" accept="image/*">
					</div>
					<!-- Tampilkan gambar yang sudah diupload -->
					<?php if($d->gambar): ?>
						<div class="form-group">
							<label>Gambar saat ini:</label><br>
							<img src="uploads/<?php echo $d->gambar ?>" alt="Gambar Profil" class="img-fluid" style="max-width: 200px;">
						</div>
					<?php endif; ?>
					<button type="submit" name="submit" class="btn btn-primary">Ubah Profil</button>
				</form>
			</div>

			<h3 class="mt-5">Ubah Password</h3>
			<div class="box p-4 bg-light">
				<form action="" method="POST">
					<div class="form-group">
						<label for="pass1">Password Baru</label>
						<input type="password" name="pass1" id="pass1" class="form-control" placeholder="Password Baru" required>
					</div>
					<div class="form-group">
						<label for="pass2">Konfirmasi Password Baru</label>
						<input type="password" name="pass2" id="pass2" class="form-control" placeholder="Konfirmasi Password Baru" required>
					</div>
					<button type="submit" name="ubah_password" class="btn btn-primary">Ubah Password</button>
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

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script>
		// Script untuk me-refresh halaman setelah proses update profil selesai
		if(window.history.replaceState){
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
</body>
</html>
