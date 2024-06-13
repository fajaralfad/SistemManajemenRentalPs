<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sewa_id = $_POST['sewa_id'];
    $status = $_POST['status'];

    $update_query = "UPDATE tb_sewa SET status = '$status' WHERE sewa_id = $sewa_id";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo '<script>alert("Status berhasil diperbarui."); window.location="data-sewa.php";</script>';
    } else {
        echo '<script>alert("Gagal memperbarui status."); window.location="data-sewa.php";</script>';
    }
}
?>
