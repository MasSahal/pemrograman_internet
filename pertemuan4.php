<?php
$mobil = array("Xenia", "Honda Jaz", "Ertiga", "Alphard");
 
sort($mobil);
echo "A. ";
print_r($mobil);

echo "<br><br>";

rsort($mobil);
echo "B. ";
print_r($mobil);

echo "<br><br>";

$umur = array("Husein"=>20, "Dimas"=>24, "Angga"=>45, "Sulaeman"=>32);

asort($umur);
echo "C. ";
print_r($umur);

echo "<br><br>";

arsort($umur);
echo "D. ";
print_r($umur);

echo "<br><br>";

ksort($umur);
echo "E. ";
print_r($umur);

echo "<br><br>";
  
krsort($umur);
echo "F. ";
print_r($umur);
?>