<?php
//jalankan session
session_start();

$host   = "localhost";
$root   = "root";
$pass   = "";
$dbname   = "mykampus";

//kneksi ke database
$mysqli = mysqli_connect($host, $root, $pass, $dbname);

//cek apakah ada error
if ($mysqli->connect_error) {
    die("Koneksi database gagal! : " . $conn->connect_error);
};
