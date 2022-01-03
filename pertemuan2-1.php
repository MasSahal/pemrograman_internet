<?php

// membuat fungsi kalkulator
function calc($nilai1, $nilai2, $operator)
{
    if ($operator == "+") {
        $hasil = $nilai1 + $nilai2;
    } elseif ($operator == "-") {
        $hasil = $nilai1 - $nilai2;
    } elseif ($operator == "*") {
        $hasil = $nilai1 * $nilai2;
    } elseif ($operator == "/") {
        $hasil = $nilai1 / $nilai2;
    } else {
        print "Operator is invalid!";
        $hasil = false;
    }

    if ($hasil) {
        $output = "Hasil dari " . $nilai1 . $operator . $nilai2 . " adalah " . $hasil;
        return $output;
    }
}

// jalankan fungsi dengan variabel
$run = calc(10, 20, "-");
echo $run;
