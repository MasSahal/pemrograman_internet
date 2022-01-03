
<?php
//hitung selisih tanggal
$tgl_1 = strtotime("5-11-2020");
$tgl_2 = strtotime("6-12-2021");

$selisih_tgl = abs($tgl_2 - $tgl_1);
echo $selisih_tgl . "<br>";

$satu_tahun = 365 * 24 * 60 * 60;
$satu_bulan = 30 * 24 * 60 * 60;
$satu_hari = 24 * 60 * 60;

$selisih_tahun = floor($selisih_tgl / $satu_tahun);
$selisih_bulan = floor(($selisih_tgl - ($selisih_tahun * $satu_tahun)) / $satu_bulan);
$selisih_hari = floor(($selisih_tgl - ($selisih_tahun * $satu_tahun) - ($selisih_bulan * $satu_bulan)) / $satu_hari);

echo "Selisih tanggal adalah " . $selisih_tahun . " tahun, " . $selisih_bulan . " bulan, " . $selisih_hari . " hari.";
