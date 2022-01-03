<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>Hasil Transaksi Produk</title>
</head>

<body class="bg-light">
	<?php
	error_reporting(0);
	//inisal tiap input ke variabel
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$alamat = $_POST['alamat'];
	$buku = $_POST['buku'];
	$kurir = $_POST['kurir'];
	$jumlah = $_POST['jumlah'];
	$tanggal_kirim = $_POST['tanggal_kirim'];
	$tambahan1 = 0;
	$tambahan2 = 0;
	$tambahan3 = 0;

	if (empty($tanggal_kirim)) {
		$tanggal_kirim = date('D, d M Y');
	}

	// echo date('now');
	if ($buku == 1) {
		$nama_buku = "Pemrograman Internet";
		$harga_buku = 109000;
	} elseif ($buku == 2) {
		$nama_buku = "Pemrograman Berorientasi Objek";
		$harga_buku = 120000;
	} elseif ($buku == 3) {
		$nama_buku = "CSS Cheat Sheet";
		$harga_buku = 79000;
	} elseif ($buku == 4) {
		$nama_buku = "Fundamental PHP Lengkap";
		$harga_buku = 99000;
	} elseif ($buku == 5) {
		$nama_buku = "Fundamental CSS Lengkap";
		$harga_buku = 100000;
	} elseif ($buku == 6) {
		$nama_buku = "Dasar Dasar HTML dan CSS";
		$harga_buku = 80000;
	} elseif ($buku == "") {
		$nama_buku = "";
		$harga_buku = 0;
	}

	if ($kurir == 1) {
		$jenis_ekspedisi = "JNE Regular";
		$harga_ongkir = 12000;
	} elseif ($kurir == 2) {
		$jenis_ekspedisi = "JNE OKE";
		$harga_ongkir = 17000;
	} elseif ($kurir == 3) {
		$jenis_ekspedisi = "J&T Regular";
		$harga_ongkir = 12000;
	} elseif ($kurir == 4) {
		$jenis_ekspedisi = "Si Cepat Express";
		$harga_ongkir = 15000;
	} elseif ($kurir == "") {
		$jenis_ekspedisi = "";
		$harga_ongkir = 0;
	}
	?>
	<div class="container">
		<div class="justify-content-center my-2">
			<?php if ($buku == "") {  ?>
				<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<strong>Oops!</strong> Silahkan Pilih Buku!
				</div>
			<?php }
			if ($kurir == "") {  ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<strong>Oops!</strong> Silahkan Pilih Jasa Ekspedisi!
				</div>
			<?php }
			if (!preg_match("/.+@.+\..+/", $email)) {  ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<strong>Oops!</strong> Format Email tidak sesuai!
				</div>
			<?php
				//replace email
				$email = "";
			} ?>
			<div class="card">
				<div class="card-header bg-warning">
					<strong>
						Hasil Transaksi Produk
					</strong>
				</div>
				<div class="card-body">
					<table class="table-sm">
						<tr>
							<th>Nama</th>
							<td>:</td>
							<td><?= $nama; ?></td>
						</tr>
						<tr>
							<th>E-Mail</th>
							<td>:</td>
							<td><?= $email; ?></td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td>:</td>
							<td><?= $alamat; ?></td>
						</tr>
						<tr>
							<th>Expedisi Pengirman</th>
							<td>:</td>
							<td><?= $jenis_ekspedisi; ?></td>
						</tr>
						<tr>
							<th>Tanggal Pengirman</th>
							<td>:</td>
							<td><?php ($kurir != "") ? date('D, d M Y', strtotime($tanggal_kirim)) : ""; ?></td>
						</tr>
					</table>
					<br>
					<table class="table table-bordered">
						<tr class="bg-secondary text-white">
							<th>No</th>
							<th>Nama</th>
							<th>Harga Buku</th>
							<th>Jumlah</th>
							<th>Sub-total</th>
						</tr>
						<tr>
							<td><?= $no = 1; ?></td>
							<td>Buku <?= $nama_buku; ?></td>
							<td>Rp<?= number_format($harga_buku, 2, ",", "."); ?></td>
							<td><?= $jumlah; ?></td>
							<td>
								<?php $sub_total = $harga_buku * $jumlah; ?>
								Rp<?= number_format($sub_total, 2, ",", "."); ?>
							</td>
						</tr>
						<?php if (isset($_POST['tambahan1'])) {
							$tambahan1 = 20000
						?>
							<tr>
								<td><?= $no += 1; ?></td>
								<td><?= $_POST['tambahan1']; ?></td>
								<td>
									Rp<?= number_format($tambahan1, 2, ",", "."); ?>
								</td>
								<td>1</td>
								<td>Rp<?= number_format($tambahan1, 2, ",", "."); ?></td>
							</tr>
						<?php } ?>
						<?php if (isset($_POST['tambahan2'])) {
							$tambahan2 = 5000
						?>
							<tr>
								<td><?= $no += 1; ?></td>
								<td><?= $_POST['tambahan2']; ?></td>
								<td>
									Rp<?= number_format($tambahan2, 2, ",", "."); ?>
								</td>
								<td>1</td>
								<td>Rp<?= number_format($tambahan2, 2, ",", "."); ?></td>
							</tr>
						<?php } ?>
						<?php if (isset($_POST['tambahan3'])) {
							$tambahan3 = 3000
						?>
							<tr>
								<td><?= $no += 1; ?></td>
								<td><?= $_POST['tambahan3']; ?></td>
								<td>
									Rp<?= number_format($tambahan3, 2, ",", "."); ?>
								</td>
								<td>1</td>
								<td>Rp<?= number_format($tambahan3, 2, ",", "."); ?></td>
							</tr>
						<?php } ?>
						<tr>
							<td colspan="4" align="right">Ongkos Kirim</td>
							<td>
								Rp<?= number_format($harga_ongkir, 2, ",", "."); ?>
							</td>
						</tr>

						<tr>
							<td colspan="4" align="right">Total</td>
							<td class="font-weight-bold">
								<?php $total =  $harga_ongkir + $sub_total + $tambahan1 + $tambahan2 + $tambahan3; ?>
								Rp<?= number_format($total, 2, ",", "."); ?>
							</td>
						</tr>
					</table>

				</div>
				<div class="card-footer">
					<a href="./" class="btn btn-primary">
						Kembali
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>