<?php
//panggil koneksi database
include("./connection.php");

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$_SESSION['user'] = $username;
$_SESSION['pass'] = $password;
// cek data
$cek = $mysqli->query("SELECT * FROM admin WHERE username='$username'");

var_dump($cek);
if ($cek->num_rows > 0) {
    $data = $cek->fetch_assoc();
    $pass_verify = password_verify($password, $data['password']);
    var_dump($pass_verify);

    if ($pass_verify) {
        // buat session login
        $_SESSION['username'] = $data['username'];
        $_SESSION['is_login'] = true;
        header("location:../page/index.php");
    } else {
        $_SESSION['error'] = "Password yang anda masukan tidak benar!";
        header("location:../index.php");
    }
} else {
    $_SESSION['error'] = "Data tidak ditemukan!";
    header("location:../index.php");
}
