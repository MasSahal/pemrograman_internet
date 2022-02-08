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

    // include('./connection.php');
    //buat variabel kosong fakultas
    $fakultas = "";

    //ambil data dari form input
    $nim            = htmlentities(strip_tags(trim($_POST['nim'])));
    $nama           = htmlentities(strip_tags(trim($_POST['nama'])));
    $tempat_lahir   = htmlentities(strip_tags(trim($_POST['tempat_lahir'])));
    $tanggal_lahir  = htmlentities(strip_tags(trim($_POST['tanggal_lahir'])));
    $fakultas       = htmlentities(strip_tags(trim($_POST['fakultas'])));
    $jurusan        = htmlentities(strip_tags(trim($_POST['jurusan'])));
    $ipk            = htmlentities(strip_tags(trim($_POST['ipk'])));

    $foto           = $_FILES['foto'];

    $pesan_error = "";

    //cek apakah nim telah di isi apa tidak
    if (empty($nim)) {
        #
        $pesan_error .= "Field NIM harus diisi! <br>";
    } elseif (!preg_match("/^[0-9]{8}$/", $nim)) {
        #
        $pesan_error .= "NIM harus berupa 8 digit angka! <br>";
    }

    //filter data
    $nim = mysqli_real_escape_string($link, $nim);
    $result = mysqli_query($link, "SELECT * FROM mahasiswa WHERE nim='$nim'");

    $data_mhs = mysqli_num_rows($result);
    if ($data_mhs >= 1) {
        $pesan_error .= "Field NIM yang sama sudah digunakan oleh mahasiswa lain! <br>";
    }

    if (empty($nama)) {
        $pesan_error .= "Field Nama harus diisi! <br>";
    }

    if (empty($tempat_lahir)) {
        $pesan_error .= "Field Tempat lahir harus diisi! <br>";
    }

    if (empty($tanggal_lahir)) {
        $pesan_error .= "Field Tanggal lahir harus diisi! <br>";
    }

    if (empty($jurusan)) {
        #
        $pesan_error .= "Field Jurusan harus diisi! <br>";
    }

    if (empty($ipk)) {
        #
        $pesan_error .= "Field IPK harus diisi! <br>";
    }

    if (empty($foto)) {
        #
        $pesan_error .= "Field Foto harus diisi! <br>";
    }

    //cek apakah ipk berupa angka dan tidak boleh negatif
    if (!is_numeric($ipk) or $ipk <= 0) {
        $pesan_error .= "IPK harus bernilai angka dan tidak negatif! <br>";
    }

    //jika gambar tida berhasil di upload
    $up_err = $foto['error'];
    if ($up_err !== 0) {
        $msg_err_img = [
            1 => "Gambar terlalu besar! <br>",
            2 => "Maksimal gambar 2Mb! <br>",
            3 => "Gambar terkirim sebagian! <br>",
            4 => "Tidak ada gambar yang di upload! <br>",
            6 => "Missing a temporary folder! <br>",
            7 => "Gagal memindahkan gambar ke server! <br>",
            8 => "500 - Server Error <br>",
        ];
        $pesan_error .= $msg_err_img[$up_err];
    } else {
        // jika tidak ada error
        $folder = "img";
        $name_img = $foto['name'];
        $path_img = $folder . "/" . $name_img;

        //jika file sudah diupload
        if (file_exists($path_img)) {
            $pesan_error .= "Gambar telah diupload sebelumnya!";
        }
    }

    //cek gambar bila melebhi 1mb
    $mb = 1048576;
    if ($foto['size'] > $mb) {
        $pesan_error .= "Gambar terlalu besar!";
    }

    $gambar = $foto;
    $allowed = array('png', 'jpg', 'jpeg');
    $filename = $foto['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    // var_dump($ext);
    // die();
    if (!in_array($ext, $allowed)) {
        $pesan_error .= "Silahkan masukan gambar yang benar (png, jpg, jpeg)!";
    }


    //jika tidak ada pesan erro maka data akan di input ke database
    if ($pesan_error === "") {

        //filter semua data dengan mysqli real escape
        $nim            = mysqli_real_escape_string($link, $nim);
        $nama           = mysqli_real_escape_string($link, $nama);
        $tempat_lahir   = mysqli_real_escape_string($link, $tempat_lahir);
        $tanggal_lahir  = mysqli_real_escape_string($link, $tanggal_lahir);
        $fakultas       = mysqli_real_escape_string($link, $fakultas);
        $jurusan        = mysqli_real_escape_string($link, $jurusan);
        $ipk            = (float) mysqli_real_escape_string($link, $ipk);
        $nama_foto      = $foto['name'];
        $tmp_foto       = $foto['tmp_name'];

        $path_img = "./img/" . $name_img;

        //pindah foto
        move_uploaded_file($tmp_foto, $path_img);

        //buat query insert
        $query = "INSERT INTO mahasiswa VALUES ('$nim','$nama','$tempat_lahir','$tanggal_lahir','$fakultas','$jurusan','$ipk','$nama_foto')";

        //eksekusi data
        $result = mysqli_query($link, $query);

        //periksa data apakah sudah berhasil : true
        if ($result) {
            $pesan = "Mahasiswa dengan nama $nama telah berhasil di tambahkan!";
            $pesan = urlencode($pesan);
            header("location:mahasiswa.php?msg=$pesan");
        } else {
            die("Data mahasiswa $nama tidak berhasil di tambahkan : err - " . mysqli_errno($link) . " - " . mysqli_error($link));
        }
    }
} else {


    //siapkan variabel sebagai default
    $pesan_error = "";
    $nim = "";
    $nama = "";
    $tempat_lahir = "";
    $tanggal_lahir = "";
    $fakultas = "";
    $jurusan = "";
    $ipk = "";
    $foto = "";
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

    <title>Add Mahasiswa - Sistem Informasi Kampusku</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Tambah Data Mahasiswa</h1>
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

                            <div class="card border-left-primary shadow">
                                <form action="addmahasiswa.php" method="post" enctype="multipart/form-data">
                                    <div class="card-body">

                                        <h4 class="text-center mt-3 mb-4">Form Tambah Mahasiswa</h4>
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
                                                <div class="form-group">
                                                    <label for="foto">Upload Foto</label>
                                                    <input type="file" class="form-control-file" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId">
                                                    <small id="fileHelpId" class="form-text text-muted">Maks 2Mb, png, jpg, jpeg</small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-success px-3">Tambahkan</button>

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