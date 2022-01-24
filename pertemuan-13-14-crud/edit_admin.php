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

    //cek apakah username telah di isi apa tidak
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


    //jika tidak ada pesan erro maka data akan di input ke database
    if ($pesan_error === "") {

        //filter semua data dengan mysqli real escape
        $username = mysqli_real_escape_string($link, $username);

        //buat query insert
        $query = "UPDATE admin SET username='$username' WHERE id='$id'";

        //eksekusi data
        $result = mysqli_query($link, $query);

        //periksa data apakah sudah berhasil : true
        if ($result) {
            $pesan = "Admin dengan username $username telah berhasil diperbarui!";

            //redirect ke halaman tampil username
            header("location:tampil_admin.php?pesan=$pesan");
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

    //siapkan variabel sebagai default
    $pesan_error = "";

    //untuk seleksi data yg mau di ubah di tabel pakenya where id
    $id = $result['id'];

    $username = $result['username'];
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
    <title>Kampusku - Tambah Admin</title>
</head>

<body class="bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand navbar-light bg-light p-3">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href="./tampil_mahasiswa.php">Mahasiswa</a>
                <a class="nav-item nav-link" href="./tampil_admin.php">Admin</a>
                <a class="nav-item nav-link" onclick="return confirm('Yakin ingin keluar?')" href="./logout.php">Log-Out</a>
            </div>
        </nav>
        <div class="card mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <!-- jika ada pesan error -->
                        <?php if ($pesan_error !== "") { ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $pesan_error; ?>
                            </div>
                        <?php } ?>

                        <h4 class="text-center mt-3 mb-4">Form Edit Admin</h4>
                        <form action="./edit_admin.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control form-control-sm border-1 " placeholder="Masukan username..." value="<?= $username; ?>">
                                        <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col">
                                    <button type="submit" name="submit" class="btn btn-primary px-3 float-end">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>