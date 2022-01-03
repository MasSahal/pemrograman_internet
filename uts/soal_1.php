<?php

$jumlah_kotor = 1500500;

if ($jumlah_kotor >= 3000000) {
    $diskon = 20;
} else if ($jumlah_kotor >= 2000000 && $jumlah_kotor <= 2999999) {
    $diskon = 15;
} else if ($jumlah_kotor >= 1000000 && $jumlah_kotor <= 1999999) {
    $diskon = 10;
} else {
    $diskon = 0;
};

$jumlah_diskon = $jumlah_kotor * ($diskon / 100);
$jumlah_bayar = $jumlah_kotor - $jumlah_diskon;

echo "Jumlah Pembayaran Dimas dan Jumlah Diskon <br>";
echo "============================ <br>";
echo "Harga Kotor = Rp " . number_format($jumlah_kotor) . "<br>";
echo "Diskon = Rp " . number_format($jumlah_diskon) . "<br>";
echo "Jumlah Bayar = Rp " . number_format($jumlah_bayar);
