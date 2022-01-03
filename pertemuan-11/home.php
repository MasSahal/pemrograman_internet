<?php
if (!isset($_COOKIE['username'])) {
    header("location:index.php");
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Pertemuan 11</title>
</head>

<body style="background:#1B262C">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 rounded-0 mt-5">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary rounded-0">
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <a class="nav-item nav-link active" href="?">Home <span class="sr-only">(current)</span></a>
                                <a class="nav-item nav-link" href="?page=data-mahasiswa">Data Mahasiswa</a>
                                <a class="nav-item nav-link" href="?page=alamat-kampus">Alamat Kampus</a>
                                <a class="nav-item nav-link" href="logout.php">Log-out</a>
                            </div>
                        </div>
                    </nav>
                    <?php
                    if (isset($_GET['page'])) {

                        $page = $_GET['page'];
                        switch ($page) {
                            case 'data-mahasiswa':
                                include('data-mahasiswa.php');
                                break;
                            case 'alamat-kampus':
                                include('alamat-kampus.php');
                                break;

                            default:
                                include('home.php');
                                break;
                        }
                    } else { ?>
                        <div class="p-3">
                            <div class="bg-secondary text-white p-3">
                                <h3 class="display-5">Selamat Datang</h3>
                                <p class="lead"><?= $_COOKIE['username']; ?></p>
                                <hr class="my-2">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>