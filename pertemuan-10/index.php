<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Form Komentar</title>
</head>

<body class="bg-light">

    <?php
    // sembunyikan error bawaan php
    error_reporting(0);

    //definisi var error
    $err_msg = "";

    //jika form telah di submit
    if (isset($_POST['submit'])) {
        $nama       = $_POST['nama'];
        $email      = $_POST['email'];
        $komentar   = $_POST['komentar'];



        //jika $nama kosong
        if (empty($nama)) {
            $err_msg .= " <li>Silahkan masukan nama Anda! </li>";
        }

        //jika $email kosong
        if (empty($email)) {
            $err_msg .= " <li>Silahkan masukan email Anda! ";
        } elseif (!preg_match("/.+@.+\..+/", $email)) {
            $err_msg .= " <li>Silahkan masukan email dengan format yang benar! </li> ";
        }

        //jika $email kosong
        if (empty($komentar)) {
            $err_msg .= " <li>Silahkan masukan komentar Anda! </li> ";
        }

        //jika gambar tida berhasil di upload
        $up_err = $_FILES['gambar']['error'];
        if ($up_err !== 0) {
            $msg_err_img = [
                1 => "<li>Gambar terlalu besar!</li>",
                2 => "<li>Maksimal gambar 2Mb!</li>",
                3 => "<li>Gambar terkirim sebagian!</li>",
                4 => "<li>Tidak ada gambar yang di upload!</li>",
                6 => "<li>Missing a temporary folder!</li>",
                7 => "<li>Gagal memindahkan gambar ke server!</li>",
                8 => "<li>500 - Server Error</li>",
            ];
            $err_msg .= $msg_err_img[$up_err];
        } else {
            // jika tidak ada error
            $folder = "image";
            $name_img = $_FILES['gambar']['name'];
            $path_img = $folder . "/" . $name_img;

            //jika file sudah diupload
            if (file_exists($path_img)) {
                $err_msg .= "<li>Gambar telah diupload sebelumnya!</li>";
            }
        }

        //cek gambar bila melebhi 1mb
        $mb = 1048576;
        if ($_FILES['gambar']['size'] > $mb) {
            $err_msg .= "<li>Gambar terlalu besar!</li>";
        }

        $gambar = $_FILES['gambar'];
        $allowed = array('gif', 'png', 'jpg', 'jpeg');
        $filename = $_FILES['gambar']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        // var_dump($ext);
        // die();
        if (!in_array($ext, $allowed)) {
            $err_msg .= "<li>Silahkan masukan gambar yang benar (gif, png, jpg, jpeg)!</li>";
        }
    } else {

        // jika form blm di submit
        $nama = "";
        $email = "";
        $komentar = "";
    }


    //cek apakah ukuran file melebihi batas post max size
    //ditaro disini agar $err_msg tidak tereset
    if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($_FILES) && empty($_POST)) {
        $postMax = ini_get('post_max_size');
        $err_msg .= "<li>Ukuran gambar melewati maksimal ({$postMax})</li>";
    }
    ?>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card border-0 bg-transparent">
                <?php
                //jika $nama kosong
                if ($err_msg != "") { ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Oops!</strong> Terjadi Error
                        <hr>
                        <ul>
                            <?= $err_msg; ?>
                        </ul>
                    </div>
                <?php }; ?>
                <?php if (isset($_POST['submit'])) {
                    // jika loloas semua validasi/
                    if ($err_msg === "") {
                        $folder = "image";
                        $tmp_img = $_FILES['gambar']['tmp_name'];
                        $name_img = $_FILES['gambar']['name'];
                        $path_img = $folder . "/" . $name_img;
                        move_uploaded_file($tmp_img, $path_img);

                        //incloude hasil bukutamu
                        include('buku-tamu.php');
                        die();
                    }
                }; ?>
                <div class="card my-3">
                    <div class="card-header bg-success text-white font-weight-bold">
                        Form Buku Tamu
                    </div>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $nama; ?>" </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="<?= $email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="komentar">Komentar</label>
                                <textarea class="form-control" name="komentar" id="komentar" rows="3"><?= $komentar; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Input Gambar</label>
                                <input type="file" class="form-control-file" name="gambar" id="gambar">
                                <small>Max 1Mb</small>
                            </div>
                        </div>
                        <div class="card-header">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>