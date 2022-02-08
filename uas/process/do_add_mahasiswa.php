<?php

//buat variabel kosong fakultas
$fakultas = "";

//ambil data dari form input
$nim            = htmlentities(strip_tags(trim($_POST['nim'])));
$nama           = htmlentities(strip_tags(trim($_POST['nama'])));
$tempat_lahir   = htmlentities(strip_tags(trim($_POST['tempat_lahir'])));
$tanggal_lahir  = htmlentities(strip_tags(trim($_POST['tanggal_lahir'])));
$fakultas       = htmlentities(strip_tags(trim($_POST['fakultas'])));
$jurusan        = htmlentities(strip_tags(trim($_POST['jurusan'])));
$ipk            = htmlentities(strip_tags(trim($_POST['ipk'])));

// siapkan variabel untuk menampung pesan error
$pesan_error = "";

//cek apakah nim telah di isi apa tidak
if (empty($nim)) {
    #
    $pesan_error .= "Field NIM harus diisi! <br>";
} elseif (!preg_match("/^[0-9]{8}$/", $nim)) {
    #
    $pesan_error .= "NIM harus berupa 8 digit angka! <br>";
}

//filter data
$nim = mysqli_real_escape_string($link, $nim);
$result = mysqli_query($link, "SELECT * FROM mahasiswa WHERE nim='$nim'");

// die();
//cek apakah ada data nim yang sama di database
$data_mhs = mysqli_num_rows($result);
if ($data_mhs >= 1) {
    $pesan_error .= "Field NIM yang sama sudah digunakan oleh mahasiswa lain! <br>";
}

//cek apakah nama telah di isi apa tidak
if (empty($nama)) {
    #
    $pesan_error .= "Field Nama harus diisi! <br>";
}

//cek apakah tempat lahiir telah di isi apa tidak
if (empty($tempat_lahir)) {
    #
    $pesan_error .= "Field Tempat lahir harus diisi! <br>";
}

//cek apakah tanggal lahir telah di isi apa tidak
if (empty($tanggal_lahir)) {
    #
    $pesan_error .= "Field Tanggal lahir harus diisi! <br>";
}

//cek apakah jurusan telah di isi apa tidak
if (empty($jurusan)) {
    #
    $pesan_error .= "Field Jurusan harus diisi! <br>";
}

//cek apakah jurusan telah di isi apa tidak
if (empty($ipk)) {
    #
    $pesan_error .= "Field IPK harus diisi! <br>";
}

//cek apakah ipk berupa angka dan tidak boleh negatif
if (!is_numeric($ipk) or $ipk <= 0) {
    $pesan_error .= "IPK harus bernilai angka dan tidak negatif! <br>";
}

//jika tidak ada pesan erro maka data akan di input ke database
if ($pesan_error === "") {

    //filter semua data dengan mysqli real escape
    $nim            = mysqli_real_escape_string($link, $nim);
    $nama           = mysqli_real_escape_string($link, $nama);
    $tempat_lahir   = mysqli_real_escape_string($link, $tempat_lahir);
    $tanggal_lahir  = mysqli_real_escape_string($link, $tanggal_lahir);
    $fakultas       = mysqli_real_escape_string($link, $fakultas);
    $jurusan        = mysqli_real_escape_string($link, $jurusan);
    $ipk            = (float) mysqli_real_escape_string($link, $ipk);

    //buat query insert
    $query = "INSERT INTO mahasiswa VALUES ('$nim','$nama','$tempat_lahir','$tanggal_lahir','$fakultas','$jurusan','$ipk')";

    //eksekusi data
    $result = mysqli_query($link, $query);

    //periksa data apakah sudah berhasil : true
    if ($result) {
        $pesan = "Mahasiswa dengan nama $nama telah berhasil di tambahkan!";

        //redirect ke halaman tampil mahasiswa
        header("location:tampil_mahasiswa.php?msg=$pesan");
    } else {
        die("Data mahasiswa $nama tidak berhasil di tambahkan : err - " . mysqli_errno($link) . " - " . mysqli_error($link));
    }
};
