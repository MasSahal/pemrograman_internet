<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Nilai UTS Mahasiswa</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>

<body class="bg-dark">
	<div class="container">
		<div class="card rounded-0 mt-5 border-0">
			<div class="card-header bg-primary rounded-0">
				<h4 class="card-title text-white">Data Hasil Ujian Tengah Semester 1</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class=" col-md-6 col-sm-12">
						<table class="table table-sm table-borderless">
							<thead>
								<tr>
									<th>NIM</th>
									<td>:</td>
									<td> 2021009871</td>
								</tr>
								<tr>
									<th>Nama</th>
									<td>:</td>
									<td>Osana Najimi</td>
								</tr>
								<tr>
									<th>Prodi</th>
									<td>:</td>
									<td>Teknik Elektro</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<br>
				<table class="table table-bordered text-center">
					<thead>
						<tr>
							<th>No</th>
							<th>Mata Kuliah</th>
							<th>Nilai Akhir</th>
							<th>Predikat</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$nilai = [
							"Pemrograman Internet" => 90,
							"Algoritma Pemrograman" => 86,
							"Aljabar Linear dan Mtriks" => 77,
							"PPKN" => 40,
							"Pemrograman Mobile" => 87,
							"Arsitektur Komputer" => 75,
							"Bahasa Inggris" => 70,
							"Pemrograman Berorientasi Objek" => 84, //penggunaan operator assigment array
							"Bahasa dan Sastra" => 74, //penggunaan operator assigment array
							"PJOK" => 64 //penggunaan operator assigment array
						];
						$jml_remed = 0;
						$i = 11 - 10; //penggunaan operator aritmetika
						foreach ($nilai as $matkul => $n) {
						?>
							<tr>
								<?php
								if ($n < 75) { //penggunaan operator perbandingan
									$jml_remed += 1;  //penggunaan operator gabungan assigment
									$warna = "bg-danger";
								} else {
									$warna = "";
								}

								if ($n >= 90) { //penggunaan operator perbandingan
									$pred = "A";
								} elseif ($n >= 80) { //penggunaan operator perbandingan
									$pred = "B";
								} elseif ($n >= 70) { //penggunaan operator perbandingan
									$pred = "C";
								} elseif ($n >= 60) { //penggunaan operator perbandingan
									$pred = "D";
								} else {
									$pred = "E";
								}
								?>
								<td><?= $i; ?></td>
								<td align="left"><?= $matkul; ?> </td>
								<td class="<?= $warna; ?>"><?= $n; ?> </td>
								<td><?= $pred; ?></td>
							</tr>
						<?php

							$i++; //penggunaan operator increment
						}; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="mt-4">
			<center>
				Made with ❤️ by Sahl
			</center>
		</div>
	</div>
</body>

</html>