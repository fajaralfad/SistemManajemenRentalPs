<?php 
	session_start();
	include 'db.php'; // Sesuaikan dengan file koneksi database Anda

	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

	// Proses hapus kategori
	if(isset($_GET['idk'])){
		$category_id = $_GET['idk'];

		// Hapus kategori dari database
		$delete_category = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '$category_id'");
		if($delete_category){
			echo '<script>alert("Data kategori berhasil dihapus");window.location="data-kategori.php"</script>';
		} else {
			echo '<script>alert("Gagal menghapus data kategori");window.location="data-kategori.php"</script>';
		}
	}

	// Proses hapus produk
	if(isset($_GET['idp'])){
		$produk_id = $_GET['idp'];

		// Hapus data sewa yang terkait dengan produk
		$delete_sewa = mysqli_query($conn, "DELETE FROM tb_sewa WHERE product_id IN (SELECT product_id FROM tb_product WHERE product_id = '$produk_id')");
		if(!$delete_sewa){
			echo '<script>alert("Gagal menghapus data sewa terkait produk");window.location="data-produk.php"</script>';
			exit; // Keluar dari skrip jika gagal menghapus data sewa
		}

		// Hapus gambar terkait dari server
		$produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '$produk_id'");
		$p = mysqli_fetch_object($produk);

		if ($p) {
			$image_path = './uploads/'.$p->product_image;
			if (file_exists($image_path)) {
				unlink($image_path);
			}
		}

		// Hapus data produk dari database
		$delete_produk = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '$produk_id'");
		if($delete_produk){
			echo '<script>alert("Data produk berhasil dihapus");window.location="data-produk.php"</script>';
		} else {
			echo '<script>alert("Gagal menghapus data produk");window.location="data-produk.php"</script>';
		}
	}
?>
