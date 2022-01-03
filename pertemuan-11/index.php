<?php
if (isset($_POST['submit'])) {

    //ambil data input post
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    //validasi login
    if ($username == "admin" && $password == "admin123") {

        //jika lolos 
        setcookie("username", "admin");
        setcookie("nama", "Sahal");
        header("location: home.php");
        #
    } else {

        //jika tidak lolos
        $error = "Username dan/atau password tidak sesuai!";
    }
} else {

    $username = "";
    $password = "";
}

// var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Pertemuan 11</title>
</head>

<body style="background:#1B262C">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5" style="top:120px">
                <div class="card rounded-0">
                    <div class="card-body">
                        <h4 class="text-center font-weight-bold">Login</h4>
                        <hr>

                        <form action="index.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control <?= isset($error) ? 'is-invalid' : ''; ?>" value="<?= $username; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control <?= isset($error) ? 'is-invalid' : ''; ?>" value="<?= $password; ?>" required>
                            </div>
                            <small class="text-center text-danger"><?= isset($error) ? $error : '' ?></small>
                            <br>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-info btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>