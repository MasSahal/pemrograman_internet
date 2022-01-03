
<?php

function selisih($a, $b)
{
    $tgl_1 = date_create($a);
    $tgl_2 = date_create($b);

    $selisih_tgl = date_diff($tgl_2, $tgl_1);
    $selisih['tahun'] = $selisih_tgl->y;
    $selisih['bulan'] = $selisih_tgl->m;
    $selisih['hari'] = $selisih_tgl->d;
    return $selisih;
}
$hasil = selisih("17-04-2003", "now");
var_dump($hasil);
echo "Selisih tanggal adalah " . $hasil['tahun'] . " tahun, " . $hasil['bulan'] . " bulan, " . $hasil['hari'] . " hari.";
