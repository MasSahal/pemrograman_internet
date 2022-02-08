<?php

session_start();
include('./connection.php');

if (!isset($_SESSION['nama'])) {
    header("location:./login.php");
};

//buat pesan
if (isset($_GET['msg'])) {
    $pesan = $_GET['msg'];
}

//periksa apakah form telah di submit
if (isset($_POST['submit'])) {

    //ambil data dari form input
    $nim            = htmlentities(strip_tags(trim($_POST['nim'])));

    $nama           = htmlentities(strip_tags(trim($_POST['nama'])));
    $tempat_lahir   = htmlentities(strip_tags(trim($_POST['tempat_lahir'])));
    $tanggal_lahir  = htmlentities(strip_tags(trim($_POST['tanggal_lahir'])));
    $fakultas       = htmlentities(strip_tags(trim($_POST['fakultas'])));
    $jurusan        = htmlentities(strip_tags(trim($_POST['jurusan'])));
    $ipk            = htmlentities(strip_tags(trim($_POST['ipk'])));

    var_dump($_POST);
    $pesan_error = "";

    //cek
    if (empty($nama)) {
        #
        $pesan_error .= "Nama harus diisi! <br>";
    }

    if (empty($tempat_lahir)) {
        #
        $pesan_error .= "Tempat lahir harus diisi! <br>";
    }

    if (empty($tanggal_lahir)) {
        #
        $pesan_error .= "Tanggal lahir harus diisi! <br>";
    }

    if (empty($jurusan)) {
        #
        $pesan_error .= "jurusan harus diisi! <br>";
    }

    if (empty($ipk)) {
        #
        $pesan_error .= "IPK harus diisi! <br>";
    }

    if (!is_numeric($ipk) or $ipk <= 0) {
        $pesan_error .= "IPK harus bernilai angka dan tidak negatif! <br>";
    }

    if ($pesan_error === "") {

        //filter semua data dengan mysqli real escape
        $nim            = mysqli_real_escape_string($link, $nim);
        $nama           = mysqli_real_escape_string($link, $nama);
        $tempat_lahir   = mysqli_real_escape_string($link, $tempat_lahir);
        $tanggal_lahir  = mysqli_real_escape_string($link, $tanggal_lahir);
        $fakultas       = mysqli_real_escape_string($link, $fakultas);
        $jurusan        = mysqli_real_escape_string($link, $jurusan);
        $ipk            = (float) mysqli_real_escape_string($link, $ipk);

        //buat query update
        $query = "UPDATE mahasiswa SET ";
        $query .= "nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', ";
        $query .= "fakultas='$fakultas', tempat_lahir='$tempat_lahir', jurusan='$jurusan', ipk='$ipk' WHERE nim='$nim' ";

        //eksekusi data
        $result = mysqli_query($link, $query);

        //periksa data apakah sudah berhasil = true
        if ($result) {
            $pesan = "Data mahasiswa dengan nama $nama telah berhasil diperbarui!";
            $pesan = urlencode($pesan);
            header("location:mahasiswa.php?msg=$pesan");
        } else {
            #
            $pesan = "Data mahasiswa dengan nama $nama tidak berhasil diperbarui!";
            $pesan = urlencode($pesan);
            header("location:mahasiswa.php?msg=$pesan");
        }
    }
} else {
    $nim = htmlentities(strip_tags(trim($_GET['nim'])));
    $nim = mysqli_real_escape_string($link, $nim);
    $result = mysqli_query($link, "SELECT * FROM mahasiswa WHERE nim='$nim'");
    $data = mysqli_fetch_assoc($result);

    $pesan_error    = "";
    $nim            = $data['nim'];
    $nama           = $data['nama'];
    $tempat_lahir   = $data['tempat_lahir'];
    $tanggal_lahir  = $data['tanggal_lahir'];
    $fakultas       = $data['fakultas'];
    $jurusan        = $data['jurusan'];
    $ipk            = $data['ipk'];
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

    <title>Edit Mahasiswa - Sistem Informasi Kampusku</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Edit Data Mahasiswa <?= $nama; ?></h1>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <?php if ($pesan_error !== "") { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $pesan_error; ?>
                                </div>
                            <?php } ?>

                            <div class="card border-left-primary shadow">
                                <form action="editmahasiswa.php" method="post" enctype="multipart/form-data">
                                    <div class="card-body">

                                        <h4 class="text-center mt-3 mb-4">Form Edit Mahasiswa</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="nim">NIM</label>
                                                    <input type="number" min="0" name="nim" id="nim" class="form-control   border-1 " placeholder="Contoh : 20210120" value="<?= $nim; ?>">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" name="nama" id="nama" class="form-control   border-1 " placeholder="Masukan nama..." value="<?= $nama; ?>">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="fakultas">Fakultas</label>
                                                    <select class="form-control   border-1 " name="fakultas" id="fakultas" required>
                                                        <option hidden disabled value <?= ($fakultas != "") ? "" : "selected"; ?>>- Pilih Fakultas -</option>
                                                        <?php $data_fakultas = [
                                                            'Kedokteran', 'FMIPA', 'Ekonomi', 'Teknik', 'Sastra', 'FASILKOM'
                                                        ];
                                                        foreach ($data_fakultas as $fak) {

                                                        ?>
                                                            <option value="<?= $fak; ?>" <?= ($fakultas === $fak) ? "selected" : ""; ?>><?= $fak; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="ipk">Nilai IPK</label>
                                                    <input type="text" name="ipk" id="ipk" class="form-control   border-1 " placeholder="Masukan IPK..." value="<?= $ipk; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control   border-1 " placeholder="Masukan tempat lahir..." value="<?= $tempat_lahir; ?>">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control   border-1 " placeholder="Masukan tanggal lahir..." value="<?= $tanggal_lahir; ?>">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="jurusan">Jurusan</label>
                                                    <input type="text" name="jurusan" id="jurusan" class="form-control   border-1 " placeholder="Masukan jurusan..." value="<?= $jurusan; ?>">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-success px-3">Simpan Perubahan</button>

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