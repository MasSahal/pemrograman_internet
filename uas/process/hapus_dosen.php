<?php

//Panggil file koneksi ke database
include("../connection.php");

$nip = htmlentities(strip_tags(trim($_GET['nip'])));

$nip = mysqli_real_escape_string($link, $nip);

$result = mysqli_query($link, "SELECT * FROM dosen WHERE nip='$nip'");
$result = mysqli_fetch_assoc($result);
$nama = $result['nama'];

$result = mysqli_query($link, "DELETE FROM dosen WHERE nip='$nip'");

//buat pesan
$pesan = "Data dosen $nama berhasil dihapus!";
$pesan = urlencode($pesan);

if ($result) {
    header("location:../dosen.php?msg=$pesan");
} else {
    die("Gagal menghapus data dosen - Error Code :" . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
