<?php

//Panggil file koneksi ke database
include("../connection.php");

$nim = htmlentities(strip_tags(trim($_GET['nim'])));

//filter anti injeksi
$nim = mysqli_real_escape_string($link, $nim);

//get data
$result = mysqli_query($link, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$result = mysqli_fetch_assoc($result);
$nama = $result['nama'];

// dd("../img/" . $result['foto']);
//cek gambar
if (file_exists("../img/" . $result['foto'])) {
    unlink("../img/" . $result['foto']);
}
//hapus gambar 

//delete
$result = mysqli_query($link, "DELETE FROM mahasiswa WHERE nim='$nim'");

//buat pesan
$pesan = urlencode("Data mahasiswa $nama berhasil dihapus!");

if ($result) {
    header("location:../mahasiswa.php?msg=$pesan");
} else {
    die("Gagal menghapus data mahasiswa - Error Code :" . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
