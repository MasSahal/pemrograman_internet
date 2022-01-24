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
            header("location:tampil_admin.php?pesan=$pesan");
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

                        <h4 class="text-center mt-3 mb-4">Form Tambah Admin</h4>
                        <form action="./tambah_admin.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control form-control-sm border-1 " placeholder="Masukan username..." value="<?= $username; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control form-control-sm border-1 " placeholder="Masukan password..." value="<?= $password; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col">
                                    <button type="submit" name="submit" class="btn btn-primary px-3 float-end">Tambahkan</button>
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