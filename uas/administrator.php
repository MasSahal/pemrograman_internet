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
    $pesan = "Menampilkan Seluruh Data Administrator";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator - Sistem Informasi Kampusku</title>

    <!-- css -->
    <?php include('./template/css.php'); ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('./template/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('./template/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Administrator</h1>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <?php if (isset($msg)) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <span><?= $msg; ?>!</span>
                                </div>
                            <?php }; ?>
                            <div class="card border-left-success shadow">
                                <div class="card-header">
                                    <div class="m-0 font-weight-bold text-primary"><?= $pesan; ?></div>
                                </div>
                                <div class="card-body">
                                    <a name="" id="" class="btn btn-success btn-sm mb-3" href="addadministrator.php" role="button">Tambah Administrator</a>
                                    <a name="" id="" class="btn btn-info btn-sm mb-3" href="dosen.php" role="button">Refresh</a>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-stripped">
                                            <thead class="thead-light">
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
                                                        <?= $data['password']; ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm" href="./editpwadministrator.php?id=<?= $data['id']; ?>">Change Password</a>
                                                        <a class="btn btn-warning btn-sm" href="./editadministrator.php?id=<?= $data['id']; ?>">Edit</a>
                                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus admin <?= $data['username']; ?>?')" href="./hapus_admin.php?id=<?= $data['id']; ?>">Hapus</a>
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
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include('./template/footer.php'); ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- modal logout dan js-->
        <?php include('./template/modal_js.php'); ?>

</body>

</html>