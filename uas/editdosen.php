<?php

//jalankan session
session_start();

if (!isset($_SESSION['nama'])) {
    header("location:./login.php");
};

//buat pesan
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

include("./connection.php");

//periksa apakah form telah di submit
if (isset($_POST['submit'])) {

    $nip        = htmlentities(strip_tags(trim($_POST['nip'])));
    $nama       = htmlentities(strip_tags(trim($_POST['nama'])));
    $telepon    = htmlentities(strip_tags(trim($_POST['telepon'])));
    $email      = htmlentities(strip_tags(trim($_POST['email'])));
    $alamat     = htmlentities(strip_tags(trim($_POST['alamat'])));

    $pesan_error = "";

    if (empty($nip)) {
        $pesan_error .= "NIP harus diisi! <br>";
    }

    //filter data
    $nip = mysqli_real_escape_string($link, $nip);
    $result = mysqli_query($link, "SELECT * FROM dosen WHERE nip='$nip'");

    $data_mhs = mysqli_num_rows($result);
    if ($data_mhs >= 1) {
        $pesan_error .= "Field nip yang sama sudah digunakan oleh dosen lain! <br>";
    }

    if (empty($nama)) {
        $pesan_error .= "Nama harus diisi! <br>";
    }

    if (empty($telepon)) {
        $pesan_error .= "Telepon harus diisi! <br>";
    }

    if (empty($email)) {
        $pesan_error .= "Email harus diisi! <br>";
    }

    if (empty($alamat)) {
        $pesan_error .= "Alamat harus diisi! <br>";
    }

    if ($pesan_error === "") {

        $nip        = mysqli_real_escape_string($link, $nip);
        $nama       = mysqli_real_escape_string($link, $nama);
        $telepon    = mysqli_real_escape_string($link, $telepon);
        $email      = mysqli_real_escape_string($link, $email);
        $alamat     = mysqli_real_escape_string($link, $alamat);

        $query  = "UPDATE dosen SET nip='$nip', nama='$nama', telepon='$telepon', email='$email', alamat='$alamat' WHERE nip='$nip'";
        $result = mysqli_query($link, $query);

        if ($result) {
            $pesan = "Dosen $username telah berhasil diperbarui!";
            $pesan = urlencode($pesan);
            header("location:dosen.php?msg=$pesan");
        } else {
            die("Dosen $username tidak berhasil diperbarui : err - " . mysqli_errno($link) . " - " . mysqli_error($link));
        }
    }
} else {

    $nip = htmlentities(strip_tags(trim($_GET['nip'])));

    $nip = mysqli_real_escape_string($link, $nip);

    $result = mysqli_query($link, "SELECT * FROM dosen WHERE nip='$nip'");

    $data = mysqli_fetch_assoc($result);

    $pesan_error    = "";
    $nip            = $data['nip'];
    $nama           = $data['nama'];
    $telepon        = $data['telepon'];
    $email          = $data['email'];
    $alamat         = $data['alamat'];
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

    <title>Edit Dosen - Sistem Informasi Kampusku</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Edit Data Dosen</h1>
                    </div>

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
                                <form action="./adddosen.php" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="text-center mt-3 mb-4">Form Edit Dosen</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="nip">NIP</label>
                                                            <input type="number" min="0" name="nip" id="nip" class="form-control border-1 " readonly value="<?= $nip; ?>">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="nama">Nama</label>
                                                            <input type="text" name="nama" id="nama" class="form-control border-1 " placeholder="Masukan nama..." value="<?= $nama; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="telepon">No Telepon</label>
                                                            <input type="number" min="0" name="telepon" id="telepon" class="form-control border-1 " placeholder="Masukan no telepon..." value="<?= $telepon; ?>">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="email">Email</label>
                                                            <input type="text" name="email" id="email" class="form-control border-1 " placeholder="Masukan email..." value="<?= $email; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea class="form-control" name="alamat" id="alamat" rows="4" placeholder="Masukan alamat"><?= $alamat; ?></textarea>
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