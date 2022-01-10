<?php include('./db/db_connect.php'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Data Mahasiswa</title>
</head>

<body class="bg-light">
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="text-center mb-5 mt-3">Data Mahasiswa</h3>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal lahir</th>
                        <th>Fakultas</th>
                        <th>Jurusan</th>
                        <th>Ipk</th>
                    </tr>

                    <?php
                    $record = $mysqli->query("SELECT * FROM mahasiswa_baru");
                    // var_dump($record);
                    foreach ($record as $r) { ?>
                        <tr>
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
        </div>
    </div>
</body>

</html>
<?php
// bebaskan memory
mysqli_free_result($record);

// tutup koneksi
mysqli_close($mysqli);
?>