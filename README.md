# Sistem Manajemen Rental PS

Sistem Manajemen Rental PS adalah sebuah aplikasi web yang memungkinkan pengguna untuk menyewa produk PlayStation dan memberikan fitur manajemen lengkap untuk admin.

## Fitur

### Pengguna
- **Menyewa Produk**: Pengguna dapat melihat daftar produk yang tersedia dan melakukan penyewaan.

### Admin
- **Data Produk**: Mengelola informasi produk yang tersedia untuk disewa.
- **Data Sewa**: Melihat dan mengelola data penyewaan oleh pengguna.
- **Data Kategori**: Mengelola kategori produk untuk memudahkan pengorganisasian.
- **Edit Profil**: Admin dapat mengedit informasi profil mereka.

## Teknologi yang Digunakan
- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Framework**: Bootstrap

## Instalasi

1. Clone repositori ini:
    ```bash
    git clone https://github.com/fajaralfad/sistem-manajemen-rental-ps.git
    ```

2. Pindah ke direktori proyek:
    ```bash
    cd sistem-manajemen-rental-ps
    ```

3. Buat database baru di MySQL dan import file SQL yang terdapat dalam folder `database`:
    ```sql
    CREATE DATABASE rental_ps;
    USE rental_ps;
    SOURCE path/to/database.sql;
    ```

4. Konfigurasi koneksi database di file `config.php`:
    ```php
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "psphere";
    ?>
    ```
## Kontak
Jika Anda memiliki pertanyaan atau saran, silakan hubungi saya di fajaralfad85@gmail.com.
