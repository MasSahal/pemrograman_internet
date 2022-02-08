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

    $id       = htmlentities(strip_tags(trim($_POST['id'])));
    $password = htmlentities(strip_tags(trim($_POST['password'])));
    $password2 = htmlentities(strip_tags(trim($_POST['password2'])));


    $pesan_error = "";

    if (empty($password)) {
        #
        $pesan_error .= "Password harus diisi! <br>";
    }

    if (empty($password2)) {
        #
        $pesan_error .= "Ulangi password harus diisi! <br>";
    }

    //filter data
    $id = mysqli_real_escape_string($link, $id);
    $password = mysqli_real_escape_string($link, $password);
    $password2 = mysqli_real_escape_string($link, $password2);

    //cek apakah passworddengan password2 tidak sama
    if ($password != $password2) {
        #
        $pesan_error .= "Password tidak sama! <br>";
    }

    if ($pesan_error === "") {

        $password = mysqli_real_escape_string($link, $password);

        //hash password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        //buat query insert
        $query = "UPDATE admin SET password='$password_hash' WHERE id='$id'";

        //eksekusi data
        $result = mysqli_query($link, $query);

        //periksa data apakah sudah berhasil : true
        if ($result) {
            $pesan = "Admin dengan password $password telah berhasil diperbarui!";

            //redirect ke halaman tampil password
            header("location:administrator.php?pesan=$pesan");
        } else {
            die("Data password $password tidak berhasil diperbarui : err - " . mysqli_errno($link) . " - " . mysqli_error($link));
        }
    }
} else {
    $id = htmlentities(strip_tags(trim($_GET['id'])));
    $id = mysqli_real_escape_string($link, $id);

    //pilih data untuk dapet nama
    $result = mysqli_query($link, "SELECT * FROM admin WHERE id='$id'");
    $result = mysqli_fetch_assoc($result);

    $pesan_error = "";

    $id = $result['id'];

    $password = "";
    $password2 = "";
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
                        <h1 class="h3 mb-0 text-gray-800">Edit Password Administrator</h1>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($pesan_error !== "") { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <span><?= $pesan_error; ?></span>
                                </div>
                            <?php }; ?>
                            <div class="card border-left-success shadow">
                                <form action="./editpwadministrator.php" method="post">
                                    <div class="card-body">
                                        <h4 class="text-center mt-3 mb-4">Form Edit Password Administrator</h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control border-1 " placeholder="Masukan password..." value="<?= $password; ?>">
                                                    <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="password2">Ulangi Password</label>
                                                    <input type="password" name="password2" id="password2" class="form-control border-1 " placeholder="Ulangi password..." value="<?= $password2; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-primary px-3 float-end">Simpan Perubahan</button>
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