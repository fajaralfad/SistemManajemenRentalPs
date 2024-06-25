<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PSphere</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .bg {
            background-image: url(img/bgpls1.jpg);
            background-size: cover;
        }
    </style>
</head>

<body class="bg">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="card shadow" style="background: #343a40;">
                    <div class="card-body">
                        <h2 class="text-center mb-4" style="background: #343a40; color:white">Login</h2>
                        <form action="" method="POST">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="user" placeholder="Username" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="pass" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            session_start();
                            include 'db.php';

                            $user = mysqli_real_escape_string($conn, $_POST['user']);
                            $pass = mysqli_real_escape_string($conn, $_POST['pass']);

                            $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '" . $user . "' AND password = '" . MD5($pass) . "'");
                            if (mysqli_num_rows($cek) > 0) {
                                $d = mysqli_fetch_object($cek);
                                $_SESSION['status_login'] = true;
                                $_SESSION['a_global'] = $d;
                                $_SESSION['id'] = $d->admin_id;
                                echo '<script>window.location="dashboard.php"</script>';
                            } else {
                                echo '<div class="alert alert-danger mt-3">Username atau password Anda salah!</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>