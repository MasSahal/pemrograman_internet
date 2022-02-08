<?php

//jalankan session
session_start();

//periksa apakah user sudah login ditandai dengan adanya session nama -> $_SESSION['nama']
// jika tusernameak ada maka akan dikembalikan ke halaman login
if (!isset($_SESSION['nama'])) {
    header("location:./login.php");
};

//buat pesan
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

//Panggil file koneksi ke database
include("./connection.php");

//cek apakah form untuk pencarian telah di submit
if (isset($_GET["cari"])) {

    //ambil data input dari form
    $cari = htmlentities(strip_tags(trim($_GET['cari'])));

    //filter untuk mencegah sql injection
    $cari = mysqli_real_escape_string($link, $cari);

    //buat query pencarian
    $query  = "SELECT * FROM admin WHERE ";
    $query .= "username LIKE '%$cari%'";

    //buat pesan
    $pesan = "Menampilkan Hasil Pencarian <b>$cari</b>";
    #
} else {
    //bukan dari pencarian
    //mengambil seluruh data di table mahasiswa
    $query = "SELECT * FROM admin ORDER BY username ASC";

    //buat pesan
    $pesan = "Menampilkan Seluruh Data Admin";
}
?>

<!DOCTYPE html>
<html lang="username">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wusernameth=device-wusernameth, initial-scale=1.0">
    <link rel="shortcut icon" href="./favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Kampusku - Data Admin</title>
</head>

<body class="bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand navbar-light bg-light p-3">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link" href="./tampil_mahasiswa.php">Mahasiswa</a>
                <a class="nav-item nav-link active" href="./tampil_admin.php">Admin</a>
                <a class="nav-item nav-link" href="./logout.php">Log-Out</a>
            </div>
        </nav>
        <div class="card">
            <div class="card-body">
                <div class="row mt-3 mb-4">
                    <div class="col-12 text-center">
                        <h4><?= $pesan; ?></h4>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 col-sm-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="./tambah_admin.php" class="btn btn-success btn-sm">Tambah</a>
                            <a href="./hapus_semua_admin.php" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus seluruh data?')">Hapus Semua</a>
                            <a href="./tampil_admin.php" class="btn btn-warning btn-sm">Refresh</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <form method="get">
                            <div class="form-group">
                                <input type="search" name="cari" username="cari" class="form-control form-control-sm border-1" placeholder="Cari data ...">
                            </div>
                        </form>
                    </div>
                </div>

                <?php if (isset($msg)) { ?>
                    <div class="alert alert-success p-2 my-2" role="alert">
                        <?= $msg; ?>
                    </div>
                <?php }; ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Passowrd Hash</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <?php
                        $no = 0;

                        //eksekusi query
                        $result = mysqli_query($link, $query);
                        foreach ($result as $data) { ?>
                            <tr>
                                <td><?= $no += 1; ?></td>
                                <td><?= $data['username']; ?></td>
                                <td>
                                    <!-- <input type="password" class="form-control form-control-sm" value="" username="" readonly> -->
                                    <?= $data['password']; ?>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-xs" href="./edit_password_admin.php?id=<?= $data['id']; ?>">Change Password</a>
                                    <a class="btn btn-warning btn-xs" href="./edit_admin.php?id=<?= $data['id']; ?>">Edit</a>
                                    <a class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus admin <?= $data['username']; ?>?')" href="./hapus_admin.php?id=<?= $data['id']; ?>">Hapus</a>
                                </td>
                            </tr>
                        <?php  }

                        //bebaskan memory
                        mysqli_free_result($result);

                        //tutup koneksi
                        mysqli_close($link);
                        ?>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    Copyright &copy; <?= date("Y"); ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>