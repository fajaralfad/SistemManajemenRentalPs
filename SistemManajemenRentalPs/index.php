<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PSphere</title>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<!-- header -->
	<header class="header">
		<div class="container d-flex justify-content-between align-items-center">
			<h1><a href="index.php">PSphere</a></h1>
		</div>
	</header>

	<!-- search -->
	<div class="search">
		<div class="container mt-5">
			<form action="produk.php">
				<div class="input-group mb-3">
					<input type="text" name="search" class="form-control" placeholder="Cari Produk">
					<div class="input-group-append">
						<button class="btn btn-primary" type="submit">Cari Produk</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- category -->
	<div class="section">
		<div class="container mb-3 mt-3">
			<h3>Kategori</h3>
			<div class="box d-flex flex-wrap">
				<?php
				$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
				if (mysqli_num_rows($kategori) > 0) {
					while ($k = mysqli_fetch_array($kategori)) {
						$search_param = isset($_GET['search']) ? '&search=' . htmlspecialchars($_GET['search']) : '';
				?>
						<a href="produk.php?kat=<?php echo $k['category_id'] . $search_param; ?>" class="text-dark col-3 mb-3">
							<div class="bg-light p-3 rounded text-center">
								<img src="img/kategori.png" width="50px" style="margin-bottom: 5px;">
								<p><?php echo $k['category_name'] ?></p>
							</div>
						</a>
					<?php }
				} else { ?>
					<p class="text-muted">Kategori tidak ada</p>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- new product -->
	<div class="section">
		<div class="container mb-5">
			<h3>Produk Terbaru</h3>
			<div class="row">
				<?php
				$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
				if (mysqli_num_rows($produk) > 0) {
					while ($p = mysqli_fetch_array($produk)) {
				?>
						<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
							<div class="card h-100">
								<a href="detail-produk.php?id=<?php echo $p['product_id']; ?>">
									<img class="card-img-top" src="produk/<?php echo $p['product_image']; ?>" alt="<?php echo htmlspecialchars($p['product_name']); ?>">
								</a>
								<div class="card-body">
									<h5 class="card-title"><?php echo htmlspecialchars(substr($p['product_name'], 0, 30)); ?></h5>
									<p class="card-text">Rp. <?php echo number_format($p['product_price']); ?>/hari</p>
								</div>
							</div>
						</div>
					<?php
					}
				} else {
					?>
					<div class="col">
						<p class="text-muted">Produk tidak ada</p>
					</div>
				<?php } ?>
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