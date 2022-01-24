<?php
include("../db/connection.php");

//ambil data
$nim            = htmlentities(strip_tags(trim($_POST['nim'])));
$nama           = htmlentities(strip_tags(trim($_POST['nama'])));
$tempat_lahir   = htmlentities(strip_tags(trim($_POST['tempat_lahir'])));
$tanggal_lahir  = htmlentities(strip_tags(trim($_POST['tanggal_lahir'])));
$fakultas       = htmlentities(strip_tags(trim($_POST['fakultas'])));
$prodi          = htmlentities(strip_tags(trim($_POST['prodi'])));
$ipk            = (float) htmlentities(strip_tags(trim($_POST['ipk'])));

var_dump($_POST);
// die();
$err_msg = [];
//periksa nim
if (empty($nim)) {
    #
    // array_push(['Silahkan Masukan NIM!'], $err_msg);
} elseif (!preg_match("/^[0-9]{8}$/", $nim)) {
    #
    // array_push(['NIM Harus berupa 8 digit angka!'], $err_msg);
}

//filter data
$nim = mysqli_real_escape_string($mysqli, $nim);

//cek apakah ada data nim yang sama di database
$data = mysqli_num_rows($mysqli->query("SELECT * FROM mahasiswa WHERE nim='$nim'"));


$add = $mysqli->query("INSERT INTO mahasiswa ('nim','nama','tempat_lahir','tanggal_lahir','fakultas','ipk')VALUES('$nim','$nama','$tempat_lahir','$tanggal_lahir','$fakultas','$fakultas','$ipk'");
var_dump($add);
die();
// var_dump($data);
