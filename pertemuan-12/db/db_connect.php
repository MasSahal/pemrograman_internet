<?php

$host   = "localhost";
$root   = "root";
$pass   = "";
$dbname = "universitas";

//kneksi ke database
$mysqli = mysqli_connect($host, $root, $pass, $dbname);

//cek apakah ada error
if ($mysqli->connect_error) {
    die("Koneksi database gagal! : " . $conn->connect_error);
} else {
    echo "<script>alert('Selamat anda dapat koneksi orang dalam!')</script>";
}
