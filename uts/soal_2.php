<?php
$nilai_andi = 77;
echo "Nilai Andi : " . $nilai_andi . "<br>";

switch ($nilai_andi) {
  case ($nilai_andi >= 0) && ($nilai_andi <= 49):
    echo "Nilai Anda pada rentang 'E'. Maaf anda kurang beruntung, coba ambil lagi di semester depan";
    break;

  case ($nilai_andi >= 50) && ($nilai_andi <= 59):
    echo "Nilai Anda pada rentang 'D'. Anda harus lebih berusaha lebih keras dan lebih rajin lagi";
    break;

  case ($nilai_andi >= 60) && ($nilai_andi <= 69):
    echo "Nilai Anda pada rentang 'C'. Anda harus berusaha lebih keras lagi";
    break;

  case ($nilai_andi >= 70) && ($nilai_andi <= 79):
    echo "Nilai Anda pada rentang 'B'. Selamat nilai anda melebihi nilai rata-rata";
    break;

  case ($nilai_andi >= 80) && ($nilai_andi <= 100):
    echo "Nilai Anda pada rentang 'A'. Selamat anda mendapatkan nilai sempurna";
    break;

  default:
    echo "Nilai yang anda masukan tidak sesuai!";
    break;
};

echo "<hr>";

$nilai_rina = 35;
echo "Nilai Rina : " . $nilai_rina . "<br>";
switch ($nilai_rina) {
  case ($nilai_rina >= 0) && ($nilai_rina <= 49):
    echo "Nilai Anda pada rentang 'E'. Maaf anda kurang beruntung, coba ambil lagi di semester depan";
    break;

  case ($nilai_rina >= 50) && ($nilai_rina <= 59):
    echo "Nilai Anda pada rentang 'D'. Anda harus lebih berusaha lebih keras dan lebih rajin lagi";
    break;

  case ($nilai_rina >= 60) && ($nilai_rina <= 69):
    echo "Nilai Anda pada rentang 'C'. Anda harus berusaha lebih keras lagi";
    break;

  case ($nilai_rina >= 70) && ($nilai_rina <= 79):
    echo "Nilai Anda pada rentang 'B'. Selamat nilai anda melebihi nilai rata-rata";
    break;

  case ($nilai_rina >= 80) && ($nilai_rina <= 100):
    echo "Nilai Anda pada rentang 'A'. Selamat anda mendapatkan nilai sempurna";
    break;

  default:
    echo "Nilai yang anda masukan tidak sesuai!";
    break;
};
