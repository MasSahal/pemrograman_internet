<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Latihan Pertemuan 7</title>
</head>

<body>
  <div class="container">
    <div class="card mt-3">
      <div class="card-header">
        <h3 class="card-title">Konverter Bahasa vokal i</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <form method="post">
              <h6>Input Text</h6>
              <div class="form-group">
                <textarea class="form-control" name="text_replace" id="text" rows="auto" cols="4" placeholder="ketikan sesuatu..."></textarea>
              </div>
              <input type="submit" name="replace" class="btn btn-primary" value="Lihat Hasil">
            </form>
          </div>
          <div class="col-md-6">
            <h6>Result</h6>
            <p>
              <?php
              if (isset($_POST['replace'])) {

                $text = $_POST['text_replace'];
                echo str_replace(['a', "o", "e", "u"], "i", $text); //penggunaan fungsi str_replace()
                #
              }
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="card mt-3">
      <div class="card-header">
        <h3 class="card-title">Uppercase and Lowercase</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <form method="post">
              <h6>Input Text</h6>
              <div class="form-group">
                <textarea class="form-control" name="text" id="text" rows="auto" cols="4" placeholder="ketikan sesuatu..."></textarea>
              </div>
              <input type="submit" name="upp" class="btn btn-primary" value="Make Uppercase">
              <input type="submit" name="low" class="btn btn-success" value="Make Lowercase">
            </form>
          </div>
          <div class="col-md-6">
            <h6>Result</h6>
            <p>
              <?php
              if (isset($_POST['upp'])) {
                echo strtoupper($_POST['text']); //penggunaan fungsi strtoupper()
              } elseif (isset($_POST['low'])) {
                echo strtolower($_POST['text']); //penggunaan fungsi strtolower()
              }
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="card mt-3">
      <div class="card-header">
        <h3 class="card-title">Calculator Exponent</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <form method="post">
              <table class="table table-borderless table-sm">
                <tr>
                  <td>Number</td>
                  <td>
                    <input type="number" name="angka1" class="form-control" required>
                  </td>
                </tr>
                <tr>
                  <td>Exponent</td>
                  <td>
                    <input type="number" name="expo" class="form-control" required>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>
                    <input type="submit" class="btn btn-primary" name="make_expo" value="Lihat Hasil">
                  </td>
                </tr>
              </table>
            </form>
          </div>
          <div class="col-md-6">
            <h6>Result</h6>
            <p>
              <?php
              if (isset($_POST['make_expo'])) {
                $angka1 = $_POST['angka1'];
                $expo = $_POST['expo'];
                $hasil_expo = pow($angka1, $expo); // menggunakan function pow()
                echo $angka1 . "<sup>" . $expo . "</sup> = " . number_format($hasil_expo); // menggunakan function number_format()
              }
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="card mt-3">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <form method="post">
              <input name="rand" id="" class="btn btn-warning" type="submit" value="Random Number">
            </form>
          </div>
          <div class="col-md-6">
            <?php if (isset($_POST['rand'])) { ?>
              <p>
              <h6>Result</h6>
              <?= rand(); ?>
              <!-- function random number rand() -->
              </p>
            <?php }; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>