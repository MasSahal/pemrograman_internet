<?php
// function date menampilkan tanggal dan waktu
echo date('H:i:s d-m-Y') . "<br>";

// function time menampilkan tanggal dan waktu saat ini unix timestamp
echo time() . "<br>";

//function mktim 10:10:10 10-10-2010
echo mktime(10, 10, 10, 10, 10, 10) . "<br>";

// function getdate
$getdate = getdate(time());
echo $getdate['wday'] . "/" . $getdate['mon'] . "/" . $getdate['year'] . "<br>";

// function strtotime
echo (strtotime("now") . "<br>");
