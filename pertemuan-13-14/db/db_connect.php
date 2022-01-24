<?php
//jalankan session
session_start();

$host   = "localhost";
$root   = "root";
$pass   = "";

//kneksi ke database
$mysqli = mysqli_connect($host, $root, $pass);

//cek apakah ada error
if ($mysqli->connect_error) {
    die("Koneksi database gagal! : " . $conn->connect_error);
}

$dbCreate = $mysqli->query("CREATE DATABASE IF NOT EXISTS mykampus");
if (!$dbCreate) {
    die("Gagal membuat database mykampus");
}

// pilih databse
$selectDb = mysqli_select_db($mysqli, 'mykampus');
if (!$selectDb) {
    die("Gagal memilih database mykampus");
}

$delTableMhs = $mysqli->query("DROP TABLE IF EXISTS mahasiswa");
if (!$delTableMhs) {
    die("Gagal hapus table mahasiswa");
}

//inisialisasi tabel mahasiswa
$mbQuery = "create table mahasiswa( nim char(8), nama varchar(100), tempat_lahir varchar(100), tanggal_lahir date, fakultas varchar(50), jurusan varchar(50), ipk decimal(3,2), primary key (nim));";
$addTable = mysqli_query($mysqli, $mbQuery);

if (!$addTable) {
    die("Gagal membuat table mahasiswa : " . mysqli_errno($mysqli) . " | " .  mysqli_error($mysqli));
}

$dataQuery = "insert into mahasiswa values('15002011', 'Jamaluddin', 'Jakarta', '1997-06-23', 'Ekonomi', 'Akuntansi', 3.4),('13012012', 'James Dulari', 'Medan', '1995-12-02', 'Kedokteran', 'Kedokteran Gigi', 2.7),('15111135', 'Sri Mulyani', 'Palembang', '1994-02-11', 'Pendidikan', 'Sastra Indonesia', 3.6),('13012022', 'Hilman KA', 'Medan', '1991-05-02', 'Teknologi', 'Teknik Informatika', 4.0),('13012018', 'Cecep Firmansyah', 'Jayapura', '1981-12-02', 'Teknologi', 'Teknik Mesin', 3.0)";
$addRows = $mysqli->query($dataQuery);
if (!$addRows) {
    die("Gagal membuat data mahasiswa : " . mysqli_errno($mysqli) . " | " .  mysqli_error($mysqli));
}


//admin
$delTableAdm = $mysqli->query("DROP TABLE IF EXISTS admin");
if (!$delTableAdm) {
    die("Gagal hapus table admin");
}

//inisialisasi tabel admin
$mbQuery = "create table admin( username varchar(100), password varchar(100));";
$addTable = mysqli_query($mysqli, $mbQuery);

if (!$addTable) {
    die("Gagal membuat table admin : " . mysqli_errno($mysqli) . " | " .  mysqli_error($mysqli));
}


//data admin
$username = "admin";
$password = password_hash("admin123", PASSWORD_BCRYPT);

$dataQuery = "insert into admin values('$username', '$password')";
$addRows = $mysqli->query($dataQuery);
if (!$addRows) {
    die("Gagal membuat data admin : " . mysqli_errno($mysqli) . " | " .  mysqli_error($mysqli));
}
