<?php
ob_start();
session_start();
include('./connection.php');

if (!isset($_SESSION['nama'])) {
    header("location:./login.php");
};

//buat pesan
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

if (isset($_GET["cari"])) {

    //ambil data input dari form
    $cari = htmlentities(strip_tags(trim($_GET['cari'])));

    //filter
    $cari = mysqli_real_escape_string($link, $cari);

    //buat query pencarian
    $query  = "SELECT * FROM dosen WHERE ";
    $query .= "nip LIKE '%$cari%' OR ";
    $query .= "nama LIKE '%$cari%' OR ";
    $query .= "telepon LIKE '%$cari%' OR ";
    $query .= "email LIKE '%$cari%'";

    //buat pesan
    $pesan = "Menampilkan Hasil Pencarian <b>$cari</b>";
    #
} else {

    $query = "SELECT * FROM dosen ORDER BY nama ASC";
    $pesan = "Tabel Data Seluruh Dosen";
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

    <title>Dosen - Sistem Informasi Kampusku</title>

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

            <div id="content">

                <!-- Topbar -->
                <?php include('./template/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Dosen</h1>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <?php if (isset($msg)) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <span><?= $msg; ?></span>
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-left-secondary shadow">
                                <div class="card-header">
                                    <div class="m-0 font-weight-bold text-primary"><?= $pesan; ?></div>
                                </div>
                                <div class="card-body">
                                    <a name="" id="" class="btn btn-success btn-sm mb-3" href="adddosen.php" role="button">Tambah Dosen</a>
                                    <a name="" id="" class="btn btn-info btn-sm mb-3" href="dosen.php" role="button">Refresh</a>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>NIP</th>
                                                    <th>Nama</th>
                                                    <th>Telepon</th>
                                                    <th>Email</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $no = 0;

                                                //eksekusi query
                                                $result = mysqli_query($link, $query);
                                                foreach ($result as $data) { ?>
                                                    <tr>
                                                        <td><?= $no += 1; ?></td>
                                                        <td><?= $data['nip']; ?></td>
                                                        <td><?= $data['nama']; ?></td>
                                                        <td><?= $data['telepon']; ?></td>
                                                        <td><?= $data['email']; ?></td>
                                                        <td>
                                                            <a class="btn btn-warning btn-sm" href="./editdosen.php?nip=<?= $data['nip']; ?>">Edit</a>
                                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus dosen <?= $data['nama']; ?>?')" href="./process/hapus_dosen.php?nip=<?= $data['nip']; ?>">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php  }

                                                //bebaskan memory
                                                mysqli_free_result($result);

                                                //tutup koneksi
                                                mysqli_close($link);
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <?php include('./template/footer.php'); ?>
                <!-- End of Footer -->

            </div>
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- modal logout dan js-->
        <?php include('./template/modal_js.php'); ?>

</body>

</html>