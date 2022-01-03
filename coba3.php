<?php

function cek_data($nim, $nama)
{
    if ($nim == 1234 && $nama == "Nuha") {
        echo "data ditemukan! <br>";
        echo "------------------ <br>";
        echo "NIM : " . $nim . "<br>";
        echo "Nama : " . $nama . "<br>";
    } else {
        echo "data tidak ditemukan!";
    };
}

cek_data(1234, 'Nuha');
