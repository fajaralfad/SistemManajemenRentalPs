<?php 
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

	// Proses pencarian
	$search = "";
	if(isset($_GET['search'])){
		$search = $_GET['search'];
		$result_kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_name LIKE '%$search%' ORDER BY category_id DESC");
	} else {
		$result_kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
				<li class="nav-item"><a href="chat-admin.php" class="nav-link">Chat</a></li>
				<li class="nav-item"><a href="keluar.php" class="nav-link">Keluar</a></li>
			</ul>
		</div>
	</header>

    <!-- content -->
    <div class="section my-5">
        <div class="container">
            <h3>Data Kategori</h3>
            <div class="box">
                <form method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Kategori" value="<?php echo htmlspecialchars($search); ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
                <p><a href="tambah-kategori.php" class="btn btn-primary mb-1">Tambah Kategori</a></p>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            if(mysqli_num_rows($result_kategori) > 0){
                                while($row = mysqli_fetch_array($result_kategori)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td>
                                <a href="edit-kategori.php?id=<?php echo $row['category_id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> 
                                </a>
                                <a href="proses-hapus.php?idk=<?php echo $row['category_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus ?')">
                                    <i class="bi bi-trash"></i> 
                                </a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data</td>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
