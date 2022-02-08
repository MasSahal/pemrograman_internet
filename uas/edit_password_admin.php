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
    $password = htmlentities(strip_tags(trim($_POST['password'])));
    $password2 = htmlentities(strip_tags(trim($_POST['password2'])));

    // siapkan variabel untuk menampung pesan error
    $pesan_error = "";

    //cek apakah password telah di isi apa tidak
    if (empty($password)) {
        #
        $pesan_error .= "Password harus diisi! <br>";
    }

    //cek apakah password2 telah di isi apa tidak
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

    //jika tidak ada pesan erro maka data akan di input ke database
    if ($pesan_error === "") {

        //filter semua data dengan mysqli real escape
        $password = mysqli_real_escape_string($link, $password);

        //hash password
        $password_sha1 = sha1($password);

        //buat query insert
        $query = "UPDATE admin SET password='$password_sha1' WHERE id='$id'";

        //eksekusi data
        $result = mysqli_query($link, $query);

        //periksa data apakah sudah berhasil : true
        if ($result) {
            $pesan = "Admin dengan password $password telah berhasil diperbarui!";

            //redirect ke halaman tampil password
            header("location:tampil_admin.php?pesan=$pesan");
        } else {
            die("Data password $password tidak berhasil diperbarui : err - " . mysqli_errno($link) . " - " . mysqli_error($link));
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

    $password = "";
    $password2 = "";
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
    <title>Kampusku - Edit Password Admin</title>
</head>

<body class="bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand navbar-light bg-light p-3">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link" href="./tampil_mahasiswa.php">Mahasiswa</a>
                <a class="nav-item nav-link active" href="./tampil_admin.php">Admin</a>
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

                        <h4 class="text-center mt-3 mb-4">Form Edit Password Admin</h4>
                        <form action="./edit_password_admin.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control form-control-sm border-1 " placeholder="Masukan password..." value="<?= $password; ?>">
                                        <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="password2">Ulangi Password</label>
                                        <input type="password" name="password2" id="password2" class="form-control form-control-sm border-1 " placeholder="Ulangi password..." value="<?= $password2; ?>">
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