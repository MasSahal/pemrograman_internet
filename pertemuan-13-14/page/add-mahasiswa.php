<?php
include("../db/connection.php");

// include("../process/tambah.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Form Tambah Mahasiswa</title>

</head>

<body class="bg-light">
    <div class="container">
        <?php include("./navbar.php"); ?>
        <div class="card rounded-0 border-0">
            <div class="card-body mx-5">
                <form action="../process/tambah.php" method="post">
                    <h3 class="text-center my-3">Form Tambah Mahasiswa</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" name="nim" id="nim" class="form-control" placeholder="Contoh : 20210120001">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan nama...">
                            </div>
                            <div class="form-group">
                                <label for="fakultas">Fakultas</label>
                                <select class="form-control" name="fakultas" id="fakultas">
                                    <option disabled selected>- Pilih Fakultas -</option>
                                    <?php $fakultas = [
                                        'Kedokteran', 'FMIPA', 'Ekonomi', 'Teknik', 'Sastra', 'FASILKOM'
                                    ];
                                    foreach ($fakultas as $fak) {

                                    ?>
                                        <option value="<?= $fak; ?>"><?= $fak; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukan tempat lahir...">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control" placeholder="Masukan tanggal lahir...">
                            </div>
                            <div class="form-group">
                                <label for="prodi">Program Studi</label>
                                <input type="text" name="prodi" id="prodi" class="form-control" placeholder="Masukan prodi...">
                            </div>
                            <div class="form-group">
                                <label for="ipk">Nilai IPK</label>
                                <input type="text" name="ipk" id="ipk" class="form-control" placeholder="Masukan prodi...">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col">
                            <button type="submit" class="btn btn-primary px-3 float-end">Tambahkan</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer mt-lg-5">
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

</html>