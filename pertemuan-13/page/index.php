<?php
define('ROOTPATH', __DIR__);

//masukkan file koneksi ke databse
include('../db/connection.php');

//periksa login
if (!isset($_SESSION['is_login'])) {
    header("location:../index.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Sistem Informasi MyKampus</title>
</head>

<body class="bg-light">
    <div class="container">
        <?php include("./navbar.php"); ?>

        <div class="card rounded-0 border-0 py-5 px-3">
            <div class="container">
                <h3 class="">Selamat Datang <span class="text-warning"> <?= $_SESSION['username']; ?> </span>di Aplikasi Terintegrasi MyKampus</h3>
                <hr class="my-2">
                <p class="lead">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="card rounded-0">
                            <div class="card-header">
                                Mahasiswa Aktif
                            </div>
                            <div class="card-body">
                                <h4 class="text-success"><?= $mysqli->query("SELECT * FROM mahasiswa")->num_rows ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card rounded-0">
                            <div class="card-header">
                                Administrator
                            </div>
                            <div class="card-body">
                                <h4 class="text-success"><?= $mysqli->query("SELECT * FROM admin")->num_rows ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                </p>
            </div>
        </div>
        <div class="bg-white pb-3">
            <center>Copyright &copy; <?= date("Y"); ?></center>
        </div>
    </div>
</body>

</html>
<?php

// tutup koneksi
mysqli_close($mysqli);
?>