<?php
include 'db.php';
$productId = isset($_GET['id']) ? $_GET['id'] : null;
if ($productId) {
    $query = "SELECT * FROM tb_product WHERE product_id = '$productId'";
    $produk = mysqli_query($conn, $query);
    if ($produk && mysqli_num_rows($produk) > 0) {
        $p = mysqli_fetch_object($produk);
    } else {
        // Handle case where product is not found
        $p = null;
    }
} else {
    // Handle case where id parameter is not provided
    $p = null;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PSphere - Detail Produk</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
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
            <form action="produk.php">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Produk">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari Produk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- product detail -->
    <div class="section">
        <div class="container mt-3">
            <h3 class="mb-4">Detail Produk</h3>
            <?php if ($p) : ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="produk/<?php echo $p->product_image ?>" class="product-image">
                            </div>
                            <div class="col-md-8">
                                <h3><?php echo $p->product_name ?></h3>
                                <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
                                <p><?php echo $p->product_description ?></p>
                                <form action="sewa.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $p->product_id ?>">
                                    <button src='sewa.php' type="submit" class="btn btn-primary">Sewa</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-danger mt-4" role="alert">
                    Produk tidak ditemukan.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer mt-4 bg-light py-3">
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