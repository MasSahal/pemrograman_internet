<?php

//jalankan session
session_start();
if (!isset($_SESSION['nama'])) {
    header("location:./login.php");
};

//buat pesan
if (isset($_GET['msg'])) {
    $pesan = $_GET['msg'];
}

//Panggil file koneksi ke database
include("./connection.php");

//periksa apakah form telah di submit
if (isset($_POST['submit'])) {

    //buat variabel kosong fakultas
    $fakultas = "";

    //ambil data dari form input
    $id       = htmlentities(strip_tags(trim($_POST['id'])));
    $username = htmlentities(strip_tags(trim($_POST['username'])));

    // siapkan variabel untuk menampung pesan error
    $pesan_error = "";
    if (empty($username)) {
        #
        $pesan_error .= "Username harus diisi! <br>";
    }

    //filter data
    $id = mysqli_real_escape_string($link, $id);
    $username = mysqli_real_escape_string($link, $username);

    $result = mysqli_query($link, "SELECT * FROM admin WHERE username='$username'");

    //cek apakah ada data nim yang sama di database
    $data_admin = mysqli_num_rows($result);
    if ($data_admin >= 1) {
        $pesan_error .= "Username yang sama sudah digunakan oleh akun admin lain! <br>";
    }


    if ($pesan_error === "") {

        //filter semua data dengan mysqli real escape
        $username = mysqli_real_escape_string($link, $username);

        //buat query insert
        $query = "UPDATE admin SET username='$username' WHERE id='$id'";

        //eksekusi data
        $result = mysqli_query($link, $query);

        if ($result) {
            $pesan = "Admin dengan username $username telah berhasil diperbarui!";

            //redirect ke halaman tampil username
            header("location:administrator.php?pesan=$pesan");
        } else {
            die("Data username $username tidak berhasil diperbarui : err - " . mysqli_errno($link) . " - " . mysqli_error($link));
        }
    }
} else {

    //ambil data dari url pakenya $_GET
    $id = htmlentities(strip_tags(trim($_GET['id'])));
    $id = mysqli_real_escape_string($link, $id);

    //pilih data untuk dapet nama
    $result = mysqli_query($link, "SELECT * FROM admin WHERE id='$id'");
    $result = mysqli_fetch_assoc($result);

    $pesan_error = "";

    $id = $result['id'];

    $username = $result['username'];
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

    <title>Edit Administrator - Sistem Informasi Kampusku</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Edit Data Administrator</h1>
                    </div>
                    <?php if ($pesan_error !== "") { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $pesan_error; ?>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if (isset($msg)) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <span><?= $msg; ?></span>
                                </div>
                            <?php }; ?>
                            <div class="card border-left-success shadow">
                                <form action="./editadministrator.php" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="text-center mt-3 mb-4">Form Edit Administrator</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="username">Username</label>
                                                            <input type="text" name="username" id="username" class="form-control form-control-sm border-1 " placeholder="Masukan username..." value="<?= $username; ?>">
                                                            <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-success px-3 float-end">Simpan Perubahan</button>
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