<?php
//ambil pesan jika ada
if (isset($_GET['msg'])) {
    $pesan = $_GET['msg'];
}

//cek apakah form telah di submit
if (isset($_POST['submit'])) {  //submit berasal dari name

    //ambil data yang di imput dalam form
    $username = htmlentities(strip_tags(trim($_POST['username'])));
    $password = htmlentities(strip_tags(trim($_POST['password'])));

    // siapkan variabel untuk menampung pesan error
    $pesan_error = "";

    //cek apakah username telah di isi apa tidak
    if (empty($username)) {
        $pesan_error .= "Username harus diisi! <br>";
    }

    //cek apakah password telah di isi apa tidak
    if (empty($password)) {
        $pesan_error .= "Password harus diisi! <br>";
    }

    //Panggil file koneksi ke database
    include("./connection.php");

    //filter data input dengan mysqli real escape
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);

    //generate hash password dengan sha1
    $password_hash = sha1($password);

    //cek apakah username dan password ada di table admin
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password_hash'";

    $result = mysqli_query($link, $query);
    if (!$result) {
        #
        //jika data ada 0 di table
        $pesan_error .= "Username dan/atau Password tidak sesuai! <br>";
    }

    //bebaskan memory
    mysqli_free_result($result);

    // tutupk koneksi database mysql
    mysqli_close($link);

    //jika tidak ada pesan error berarti lolos seleksi
    if ($pesan_error === "") {
        #
        //nyalakan session
        session_start();

        //buat session nama sebagai bukti telah berhasil masuk
        $_SESSION['nama'] = $username;

        //redirect / lempar ke halaman tampil mahasiswa
        header("location:index.php");
    }
} else {
    #jika tidak ada form yang disubmit

    //buat variabel dengan nilai ksosong sebagai default
    $username = "";
    $password = "";
    $pesan_error = "";
}
