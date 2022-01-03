<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Coba</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Cek nilai apakah besar apa kecil</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td>Angka 1</td>
                                    <td>
                                        <input type="number" name="number1" id="" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Angka 2</td>
                                    <td>
                                        <input type="number" name="number2" id="" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Lihat Hasil</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <?php

                        //cek apakah data sudah di submit
                        if (isset($_POST['number1'])) {

                            // tangkap data ke variabel
                            $nilai1 = $_POST['number1'];
                            $nilai2 = $_POST['number2'];

                            if ($nilai1 < $nilai2) {
                                echo "<h4>" . $nilai1 . " lebih kecil dari " . $nilai2 . "</h4>";
                            } elseif ($nilai1 > $nilai2) {
                                echo "<h4>" . $nilai1 . " lebih besar dari " . $nilai2 . "</h4>";
                            } else {
                                echo "<h4>" . $nilai1 . " sama dengan " . $nilai2 . "</h4>";
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Kalkulator Eksponential</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td>Angka 1</td>
                                    <td>
                                        <input type="number" name="number3" id="" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Angka 2 - Sebagai Exponen</td>
                                    <td>
                                        <input type="number" name="number4" id="" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Lihat Hasil</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <?php

                        //cek apakah data sudah di submit
                        if (isset($_POST['number3'])) {

                            // tangkap data ke variabel
                            $nilai3 = $_POST['number3'];
                            $nilai4 = $_POST['number4'];

                            //tangkap hasildi variabel
                            $hasil = pow($nilai3, $nilai4);

                            echo "<h4>" . $nilai3 . "<sup>" . $nilai4 . "</sup> adalah " . $hasil . "</h4>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Cek Predikat Nilai</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td>Nilai Ujian 2</td>
                                    <td>
                                        <input type="number" name="nilai_ujian1" id="" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nilai Ujian 2</td>
                                    <td>
                                        <input type="number" name="nilai_ujian2" id="" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nilai Ujian 3</td>
                                    <td>
                                        <input type="number" name="nilai_ujian3" id="" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Lihat Hasil</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <?php

                        //cek apakah data sudah di submit
                        if (isset($_POST['nilai_ujian1'])) {

                            // tangkap data ke variabel
                            $nilai_ujian1 = $_POST['nilai_ujian1'];
                            $nilai_ujian2 = $_POST['nilai_ujian2'];
                            $nilai_ujian3 = $_POST['nilai_ujian3'];

                            //tangkap hasildi variabel
                            $hasil_akhir = ($nilai_ujian1 + $nilai_ujian2 + $nilai_ujian3) / 3;

                            //inisialisasi variabel ksosong
                            $pred = "";
                            if ($hasil_akhir >= 90) {
                                $pred = "A";
                            } elseif ($hasil_akhir >= 80) {
                                $pred = "B";
                            } elseif ($hasil_akhir >= 70) {
                                $pred = "C";
                            } elseif ($hasil_akhir >= 60) {
                                $pred = "D";
                            } else {
                                $pred = "E";
                            }

                            // operator logika OR
                            if($pred == "D" OR $pred == "E"){
                                $status = "Anda Remedial!"
                            }else{
                                $status = "Anda Lulus!";
                            }

                            echo "<h4> Nilai : " . $hasil_akhir . "</h4>";
                            echo "<br>";
                            echo "<h4> Predikat : " . $pred . "</h4>";
                            echo "<br>";
                            echo "<h4> Status : " . $status . "</h4>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Kalkulator Eksponential</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td>Angka 1</td>
                                    <td>
                                        <input type="number" name="number3" id="" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Angka 2 - Sebagai Exponen</td>
                                    <td>
                                        <input type="number" name="number4" id="" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Lihat Hasil</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <?php

                        //cek apakah data sudah di submit
                        if (isset($_POST['number3'])) {

                            // tangkap data ke variabel
                            $nilai3 = $_POST['number3'];
                            $nilai4 = $_POST['number4'];

                            //tangkap hasildi variabel
                            $hasil = pow($nilai3, $nilai4);

                            echo "<h4>" . $nilai3 . "<sup>" . $nilai4 . "</sup> adalah " . $hasil . "</h4>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Kalkulator Sederhana</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td>Angka 1</td>
                                    <td>
                                        <input type="number" name="number1" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Operator</td>
                                    <td>
                                        <select class="form-control" name="operator">
                                            <option selected disabled>Pilih Operator</option>
                                            <option value="+">+</option>
                                            <option value="-">-</option>
                                            <option value="*">*</option>
                                            <option value="/">/</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Angka 2</td>
                                    <td>
                                        <input type="number" name="number2" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <input type="submit" class="btn btn-primary" name="kalkulator" value="Lihat Hasil">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h6>Result</h6>
                        <p>
                            <?php
                            if (isset($_POST['kalkulator'])) {
                                $a = $_POST['number1'];
                                $b = $_POST['number2'];
                                $op = $_POST['operator'];
                                switch ($op) {
                                    case '+':
                                        $hasil = $a + $b;
                                        break;
                                    case '-':
                                        $hasil = $a - $b;
                                        break;
                                    case '*':
                                        $hasil = $a * $b;
                                        break;
                                    case '/':
                                        $hasil = $a / $b;
                                        break;
                                    default:
                                        $hasil = "";
                                        break;
                                }
                                echo $a . " " . $op . " " . $b . " = " . $hasil;
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</body>

</html>