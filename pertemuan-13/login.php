<?php

if (isset($_GET["pesan"])) {
    $pesan = $_GET["pesan"];
}
if (isset($_POST["submit"])) {

    $username = htmlentities(strip_tags(trim($_POST["username"])));
    $password = htmlentities(strip_tags(trim($_POST["password"])));

    $pesan_error = "";

    if (empty($username)) {
        $pesan_error .= "Username belum diisi <br>";
    }
    if (empty($password)) {
        $pesan_error .= "Password belum diisi <br>";
    }
    include("./db/connection.php");

    $username = mysqli_real_escape_string($mysqli, $username);
    $password = mysqli_real_escape_string($mysqli, $password);

    $password_sha1 = sha1($password);

    $query = "SELECT * FROM admin WHERE username = '$username'
		AND password = '$password_sha1'";

    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) == 0) {
        $pesan_error .= "Username dan/atau Password tidak sesuai";
    }

    mysqli_free_result($result);

    mysqli_close($mysqli);

    if ($pesan_error === "") {
        // session_start();
        $_SESSION["nama"] = $username;
        echo "berhasil";
    }
} else {
    $pesan_error = "";
    $username   = "";
    $password   = "";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Mahasiswa</title>
    <link rel="icon" href="favicon.png" type="image/png">
    <style>
        body {
            background-color: #F8F8F8;
        }

        div.container {
            width: 380px;
            padding: 10px 50px 80px;
            background-color: white;
            margin: 20px auto;
            box shadow: 1px 0px 10px, -1px 0px 10px;
        }

        hi,
        h3 {
            text-align: center;
            font-family: Cambria, "Times New Rowman", serif;
        }

        p [ margin:0;
        }

        fieldset {
            padding: 20px;
            width: 215px;
            margin: auto;
        }

        input {
            margin-bottom: 10px;
        }

        input[type=text],
        input[type=password] {
            width:120px input[type=submit] {
                float: right;
            }

            label {
                width: 80px;
                float: left;
                margin-right: 10 px;
            }

            .error {
                background-color: #FFECEC;
                padding: 10px 15px;
                margin: 0 0 20px 0;
                border: 1px solid red;
                box-shadow: 1px 0px 3px red;
            }
    </style>
</head>

<body>
    <div class="container">
        <h1>Selamat Datang</h1>
        <h3>Sistem Informasi Kampus</h3>
        <?php
        if (isset($pesan)) {
            echo "<div class=\"pesan\">$pesan</div>";
        }
        if ($pesan_error !== "") {
            echo "<div class=\"error\">$pesan_error</div>";
        }
        ?>
        <form action="login.php" method="post">
            <fieldset>
                <legend>Login</legend>
                <span><?= sha1("admin123"); ?></span>
                <p>
                    <label for="username">Username :</label>
                    <input type="text" name="username" id="username" value="<?php echo $username ?>">
                </p>
                <p>
                    <label for="password">Password :</label>
                    <input type="text" name="password" id="password" value="<?php echo $password ?>">
                </p>
                <p>
                    <input type="submit" name="submit" value="Log In">
                </p>
            </fieldset>
        </form>
    </div>
</body>

</html>