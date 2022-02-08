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

//periksa apakah form telah di submit
if (isset($_POST['submit'])) {

    //buat variabel kosong fakultas
    $fakultas = "";

    //ambil data dari form input
    $username = htmlentities(strip_tags(trim($_POST['username'])));
    $password = htmlentities(strip_tags(trim($_POST['password'])));

    // siapkan variabel untuk menampung pesan error
    $pesan_error = "";

    //cek apakah username telah di isi apa tidak
    if (empty($username)) {
        #
        $pesan_error .= "Username harus diisi! <br>";
    }

    //cek apakah password telah di isi apa tidak
    if (empty($password)) {
        #
        $pesan_error .= "Password harus diisi! <br>";
    }

    //filter data
    $username = mysqli_real_escape_string($link, $username);
    $result = mysqli_query($link, "SELECT * FROM admin WHERE username='$username'");

    //cek apakah ada data nim yang sama di database
    $data_admin = mysqli_num_rows($result);
    if ($data_admin >= 1) {
        $pesan_error .= "Username yang sama sudah digunakan oleh akun admin lain! <br>";
    }


    //jika tidak ada pesan erro maka data akan di input ke database
    if ($pesan_error === "") {

        //filter semua data dengan mysqli real escape
        $username = mysqli_real_escape_string($link, $username);
        $password = mysqli_real_escape_string($link, $password);

        //buat hash password dengan sha1
        $password_sha1 = sha1($password);

        //buat query insert
        $query = "INSERT INTO admin (username, password) VALUES ('$username','$password_sha1')";

        //eksekusi data
        $result = mysqli_query($link, $query);

        //periksa data apakah sudah berhasil : true
        if ($result) {
            $pesan = "Admin dengan username $username telah berhasil di tambahkan!";

            //redirect ke halaman tampil username
            header("location:administrator.php?msg=$pesan");
        } else {
            die("Data username $username tidak berhasil di tambahkan : err - " . mysqli_errno($link) . " - " . mysqli_error($link));
        }
    }
} else {

    //siapkan variabel sebagai default
    $pesan_error = "";
    $username = "";
    $password = "";
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
                        <h1 class="h3 mb-0 text-gray-800">Tambah Data Administrator</h1>
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
                                <form action="./addadministrator.php" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="text-center mt-3 mb-4">Form Tambah Administrator</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="username">Username</label>
                                                            <input type="text" name="username" id="username" class="form-control border-1 " placeholder="Masukan username..." value="<?= $username; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="password">Password</label>
                                                            <input type="password" name="password" id="password" class="form-control border-1 " placeholder="Masukan password..." value="<?= $password; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-success px-3 float-end">Tambahkan</button>
                                    </div>
                                </form>
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