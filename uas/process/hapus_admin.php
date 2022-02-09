<?php

include("../connection.php");

$id = htmlentities(strip_tags(trim($_GET['id'])));

//filter anti injeksi
$id = mysqli_real_escape_string($link, $id);

//pilih data untuk dapet nama
$result = mysqli_query($link, "SELECT * FROM admin WHERE id='$id'");

//jika tidak ada daata di database
if (!$result) {
    header("location:../administrator.php");
}

$result = mysqli_fetch_assoc($result);
$nama = $result['username'];

//delete
$result = mysqli_query($link, "DELETE FROM admin WHERE id='$id'");

//pesan
$pesan = urlencode("Data admin $nama berhasil dihapus!");

if ($result) {
    header("location:../administrator.php?pesan=$pesan");
} else {
    die("Gagal menghapus data admin $nama - Error Code :" . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
