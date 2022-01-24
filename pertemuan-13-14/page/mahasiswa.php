<?php

//masukkan file koneksi ke databse
include('../db/connection.php');

//periksa login
if (!isset($_SESSION['is_login'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Sistem Informasi MyKampus</title>
</head>

<body class="bg-light">
    <div class="container">
        <?php include("./navbar.php"); ?>
        <div class="card rounded-0 border-0">
            <div class="card-body">
                <h3 class="text-center my-3">Data Mahasiswa</h3>
                <?php
                if (isset($_GET['search'])) {
                    $cari = $_GET['search'];
                    $res = $mysqli->query("SELECT * FROM mahasiswa WHERE nama LIKE '%$cari%' OR nim LIKE '%$cari%' OR tempat_lahir LIKE '%$cari%' OR fakultas LIKE '%$cari%' OR jurusan LIKE '%$cari%' OR ipk LIKE '%$cari%'");
                    if ($res) {
                        $record = $res;
                    } else {
                        echo "<h4 class='text-center text-danger'>Data tidak ditemukan!</h4>";
                    }
                } else {
                    $record = $mysqli->query("SELECT * FROM mahasiswa");
                }

                ?>
                <a href="./add-mahasiswa.php" class="btn btn-success mb-3 float-end">Tambah</a>
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal lahir</th>
                            <th>Fakultas</th>
                            <th>Jurusan</th>
                            <th>IPK</th>
                        </tr>
                    </thead>

                    <?php
                    $no = 0;
                    foreach ($record as $r) { ?>
                        <tr>
                            <td><?= $no += 1; ?></td>
                            <td><?= $r['nim']; ?></td>
                            <td><?= $r['nama']; ?></td>
                            <td><?= $r['tempat_lahir']; ?></td>
                            <td><?= $r['tanggal_lahir']; ?></td>
                            <td><?= $r['fakultas']; ?></td>
                            <td><?= $r['jurusan']; ?></td>
                            <td><?= $r['ipk']; ?></td>
                        </tr>
                    <?php  } ?>
                </table>

            </div>
            <div class="card-footer">
                <center>Copyright &copy; <?= date("Y"); ?></center>
            </div>
        </div>
    </div>
</body>

</html>
<?php
// bebaskan memory
// mysqli_free_result($record);

// tutup koneksi
mysqli_close($mysqli);
?>