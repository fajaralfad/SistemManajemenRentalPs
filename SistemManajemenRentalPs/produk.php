<?php 
	include 'db.php';

	// Mengambil parameter search dan kat dari URL
	$search = isset($_GET['search']) ? $_GET['search'] : '';
	$kategori_id = isset($_GET['kat']) ? $_GET['kat'] : '';

	// Membuat kondisi WHERE berdasarkan parameter yang ada
	$where = '';
	if (!empty($search) || !empty($kategori_id)) {
		$where = "WHERE product_status = 1 ";
		if (!empty($search)) {
			$where .= "AND product_name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%' ";
		}
		if (!empty($kategori_id)) {
			$where .= "AND category_id = '" . mysqli_real_escape_string($conn, $kategori_id) . "' ";
		}
	}

	// Query produk berdasarkan kondisi WHERE yang telah dibuat
	$produk_query = "SELECT * FROM tb_product $where ORDER BY product_id DESC";
	$produk_result = mysqli_query($conn, $produk_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PSphere - Produk</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
        .product-image {
            max-width: 100%;
        }
    </style>
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
		<div class="container mt-3">
			<form action="produk.php" method="GET"> <!-- Tambahkan method GET -->
				<div class="input-group mb-3">
					<input type="text" name="search" class="form-control" placeholder="Cari Produk" value="<?php echo htmlspecialchars($search); ?>">
					<div class="input-group-append">
						<button class="btn btn-primary" type="submit">Cari Produk</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- category -->
<div class="section">
    <div class="container mb-5">
        <h3>Hasil Pencarian</h3>
        <?php 
            // Menampilkan kategori terpilih jika ada
            if (!empty($kategori_id)) {
                $kategori_name_query = "SELECT category_name FROM tb_category WHERE category_id = '$kategori_id'";
                $kategori_name_result = mysqli_query($conn, $kategori_name_query);
                if (mysqli_num_rows($kategori_name_result) > 0) {
                    $kategori_name = mysqli_fetch_assoc($kategori_name_result)['category_name'];
        ?>
        <p class="mt-3"><strong>Kategori:</strong> <?php echo htmlspecialchars($kategori_name); ?></p>
        <?php }} ?>

        <div class="row">
            <?php 
                if(mysqli_num_rows($produk_result) > 0){
                    while($p = mysqli_fetch_array($produk_result)){
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <a href="detail-produk.php?id=<?php echo $p['product_id']; ?>">
                        <img class="card-img-top" src="produk/<?php echo $p['product_image']; ?>" alt="<?php echo htmlspecialchars($p['product_name']); ?>">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($p['product_name']); ?></h5>
                        <p class="card-text">Rp. <?php echo number_format($p['product_price']); ?></p>
                    </div>
                </div>
            </div>
            <?php 
                    }
                } else {
            ?>
            <div class="col">
                <p class="text-muted">Produk tidak ditemukan.</p>
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
