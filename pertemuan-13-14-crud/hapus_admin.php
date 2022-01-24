<?php

//Panggil file koneksi ke database
include("./connection.php");

//pilih data dari database sesuai nim yang dipilih tadi saat tekan tombol hapus
$id = htmlentities(strip_tags(trim($_GET['id'])));

//filter anti injeksi
$id = mysqli_real_escape_string($link, $id);

//pilih data untuk dapet nama
$result = mysqli_query($link, "SELECT * FROM admin WHERE id='$id'");
$result = mysqli_fetch_assoc($result);
$nama = $result['username'];

//pilih data untuk dihapus
$result = mysqli_query($link, "DELETE FROM admin WHERE id='$id'");

//buat pesan
$pesan = "Data admin $nama berhasil dihapus!";
$pesan = urlencode($pesan);

if ($result) {
    header("location:./tampil_admin.php?msg=$pesan");
} else {
    die("Gagal menghapus data admin $nama - Error Code :" . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
