<?php
$buah = array(1 => "apel",  2 => "rambutan", 3 => "pepaya", 4  => "mangga");
echo "Array Buah Default <br>";
var_dump($buah);
echo "<br>";
echo "Array Buah Arsort() secara Descending berdasarkan value <br>";
arsort($buah);
var_dump($buah);

echo "<hr>";

$hewan = array(
    1  => "kucing",
    2  => "kuda",
    3  => "kelinci",
    4  => "gajah",
    5  => "semut",
    6  => "harimau",
    7  => "ular"
);
echo "Array Hewan Default <br>";
var_dump($hewan);
echo "<br>";
echo "Array Hewan Asort() secara Ascending berdasarkan value <br>";
asort($hewan);
var_dump($hewan);













// foreach ($buah as $b => $vb) {
//     echo "buah['" . $b . "'] = " . $vb . "<br>";
// }
// foreach ($hewan as $h => $vh) {
//     echo "hewan['" . $h . "'] = " . $vh . "<br>";
// }
