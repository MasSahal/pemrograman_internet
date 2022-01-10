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
}


if (!$mysqli->query("drop table if exists mahasiswa_baru")) {
    echo "Gagal hapus table mahasiswa_baru";
}

//inisialisasi data
$q_table = "create table mahasiswa_baru( nim char(8), nama varchar(100), tempat_lahir varchar(100), tanggal_lahir date, fakultas varchar(50), jurusan varchar(50), ipk decimal(3,2), primary key (nim));";
$add_table = mysqli_query($mysqli, $q_table);

if (!$add_table) {
    echo "Gagal membuat table mahasiswa_baru";
    echo mysqli_errno($mysqli);
    echo mysqli_error($mysqli);
}

$q_data = "insert into mahasiswa_baru values('15002032', 'Rina Kumala Sari', 'Jakarta', '1997-06-28', 'Ekonomi', 'Akuntansi', 3.4),('13012012', 'James Situmorang', 'Medan', '1995-04-02', 'Kedokteran', 'Kedokteran Gigi', 2.7),('15102135', 'Sri Mulyani', 'Palembang', '1994-02-11', 'Pendidikan', 'Sastra Indonesia', 3.6),('13012022', 'Hilman KA', 'Medan', '1991-05-02', 'Teknologi', 'Teknik Informatika', 4.0),('13012018', 'Cecep Firmansyah', 'Jayapura', '1981-12-02', 'Teknologi', 'Teknik Mesin', 3.0)";
$add_rows = $mysqli->query($q_data);
if (!$add_rows) {
    echo "Gagal membuat data mahasiswa_baru";
    echo mysqli_errno($mysqli);
    echo mysqli_error($mysqli);
}
