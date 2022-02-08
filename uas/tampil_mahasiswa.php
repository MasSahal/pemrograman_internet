<?php

//jalankan session
session_start();

//periksa apakah user sudah login ditandai dengan adanya session nama -> $_SESSION['nama']
// jika tidak ada maka akan dikembalikan ke halaman login
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
    $query  = "SELECT * FROM mahasiswa WHERE ";
    $query .= "nim LIKE '%$cari%' OR ";
    $query .= "nama LIKE '%$cari%' OR ";
    $query .= "tempat_lahir LIKE '%$cari%' OR ";
    $query .= "tanggal_lahir LIKE '%$cari%' OR ";
    $query .= "fakultas LIKE '%$cari%' OR ";
    $query .= "jurusan LIKE '%$cari%' OR ";
    $query .= "ipk LIKE '%$cari%'";

    //buat pesan
    $pesan = "Menampilkan Hasil Pencarian <b>$cari</b>";
    #
} else {
    //bukan dari pencarian
    //mengambil seluruh data di table mahasiswa
    $query = "SELECT * FROM mahasiswa ORDER BY nama ASC";

    //buat pesan
    $pesan = "Menampilkan Seluruh Data Mahasiswa";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Kampusku - Data Mahasiswa</title>
</head>

<body class="bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand navbar-light bg-light p-3">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href="./tampil_mahasiswa.php">Mahasiswa</a>
                <a class="nav-item nav-link" href="./tampil_admin.php">Admin</a>
                <a class="nav-item nav-link" href="./logout.php" onclick="return confirm('Yakin ingin keluar?')">Log-Out</a>
            </div>
        </nav>
        <div class="card">
            <div class="card-body">
                <div class="row mt-3 mb-4">
                    <div class="col-12 text-center">
                        <h4><?= $pesan; ?></h4>
                    </div>
                </div>

                <?php if (isset($msg)) { ?>
                    <div class="alert alert-success p-2 mb-2" role="alert">
                        <?= $msg; ?>
                    </div>
                <?php }; ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>#</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal lahir</th>
                                <th>Fakultas</th>
                                <th>Jurusan</th>
                                <th>IPK</th>
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
                                <td><?= $data['nim']; ?></td>
                                <td><?= $data['nama']; ?></td>
                                <td><?= $data['tempat_lahir']; ?></td>
                                <td><?= $data['tanggal_lahir']; ?></td>
                                <td><?= $data['fakultas']; ?></td>
                                <td><?= $data['jurusan']; ?></td>
                                <td><?= $data['ipk']; ?></td>
                                <td>
                                    <a class="btn btn-warning btn-xs" href="./edit_mahasiswa.php?nim=<?= $data['nim']; ?>">Edit</a>
                                    <a class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus mahasiswa <?= $data['nama']; ?>?')" href="./hapus_mahasiswa.php?nim=<?= $data['nim']; ?>">Hapus</a>
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