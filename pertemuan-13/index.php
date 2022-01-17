<?php
//masukkan file koneksi ke databse
include('./db/db_connect.php');

//jika sudah ada sesi login..lempar ke halaman utama
if (isset($_SESSION['is_login'])) {
  header("location:./page/");
}


if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
  $user = $_SESSION['user'];
  $pass = $_SESSION['pass'];
} else {
  $user = "";
  $pass = "";
}
session_destroy();
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="shortcut icon" href="./assets/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>Login</title>
</head>

<body class="bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5" style="top:120px">
        <?php if (isset($_SESSION['error'])) { ?>
          <div class="alert alert-danger" role="alert">
            <strong>Oops!</strong> <?= $_SESSION['error']; ?>.
          </div>
        <?php }; ?>
        <div class="card rounded-0">
          <div class="card-header">
            <h4 class="text-center font-weight-bold">Sistem Informasi MyKampus</h4>
          </div>
          <div class="card-body">
            <strong class="text-center font-weight-bold">Silahkan Login</strong>
            <hr>
            <form action="./db/do_login.php" method="post">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control <?= isset($error) ? 'is-invalid' : ''; ?>" value="<?= $user; ?>" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control <?= isset($error) ? 'is-invalid' : ''; ?>" value="<?= $pass; ?>" required>
              </div>
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-info btn-block">Submit</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</body>

</html>
<?php

// tutup koneksi
mysqli_close($mysqli);
?>