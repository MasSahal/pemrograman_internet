<?php

//Panggil file koneksi ke database
include("./connection.php");

//buat pesan
$pesan = "Seluruh data admin berhasil dihapus!";
$pesan = urlencode($pesan);

$query = "DELETE FROM admin";
if (mysqli_query($link, $query)) {
    header("location:./tampil_admin.php?msg=$pesan");
} else {
    die("Gagal menghapus seluruh data admin - Error Code :" . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
