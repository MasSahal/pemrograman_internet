<?php

$nilai = [70, 89, 80, 75, 97, 99, 100, 87, 68];

$jumlah = count($nilai);
$min = min($nilai);
$max = max($nilai);
$average = array_sum($nilai) / count($nilai);

foreach ($nilai as $n) {
  echo "Nilai " . $n . "<br>";
}
echo "<hr>";
echo "Nilai terbesar : " . $max . "<br>";
echo "Nilai terkecil : " . $min . "<br>";
echo "Nilai rata-rata : " . $average . "<br>";;
echo "Jumlah banyaknya nilai : " . $jumlah;

?>
<?php if (isset($_POST['rand'])) { ?>
  <p>
  <h6>Result</h6>
  <?= rand(); ?>
  <!-- function random number rand() -->
  </p>
<?php }; ?>