<?php

//Panggil file koneksi ke database
include("./connection.php");

//pilih data dari database sesuai nim yang dipilih tadi saat tekan tombol hapus
$nim = htmlentities(strip_tags(trim($_GET['nim'])));

//filter anti injeksi
$nim = mysqli_real_escape_string($link, $nim);

//pilih data
$result = mysqli_query($link, "DELETE FROM mahasiswa WHERE nim='$nim'");

if ($result) {
    header("location:./tampil_mahasiswa.php");
} else {
    die("Gagal menghapus seluruh data mahasiswa - Error Code :" . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
