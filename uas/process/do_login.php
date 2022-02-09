<?php
//ambil pesan jika ada
if (isset($_GET['msg'])) {
    $pesan = $_GET['msg'];
}

//cek apakah form telah di submit
if (isset($_POST['submit'])) {

    //ambil data yang di imput dalam form
    $username = htmlentities(strip_tags(trim($_POST['username'])));
    $password = htmlentities(strip_tags(trim($_POST['password'])));

    // siapkan variabel untuk menampung pesan error
    $pesan_error = "";

    if (empty($username)) {
        $pesan_error .= "Username harus diisi! <br>";
    }

    if (empty($password)) {
        $pesan_error .= "Password harus diisi! <br>";
    }

    include("./connection.php");

    //filter data input dengan mysqli real escape
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);

    //cek data
    $query = "SELECT * FROM admin WHERE username='$username'";

    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $verif = password_verify($password, $data['password']);
        var_dump($verif);
        if (!$verif) {
            $pesan_error .= "Password tidak sesuai! <br>";
        }
    } else {
        $pesan_error .= "Username tidak sesuai! <br>";
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
