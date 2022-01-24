<?php

//Panggil file koneksi ke database
include("./connection.php");

$query = "DELETE FROM mahasiswa";
if (mysqli_query($link, $query)) {
    header("location:./tampil_mahasiswa.php");
} else {
    die("Gagal menghapus seluruh data mahasiswa - Error Code :" . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
