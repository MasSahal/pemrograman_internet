<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Form Pembelian Bahan Baku</title>
</head>
<?php
$alert = "";
$buku = "";
$kurir = "";
?>

<body class="bg-light">
	<div class="container">
		<div class="d-flex justify-content-center">
			<div class="card my-4">
				<div class="card-header bg-success text-white font-weight-bold">
					Form Pembelian Buku Pemrograman Internet
				</div>
				<form action="proccess.php" method="post">
					<!-- <form method="post"> -->
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama">Nama</label>
									<input type="text" name="nama" id="nama" class="form-control" required oninvalid="this.setCustomValidity('Kolom Nama tidak boleh kosong!')">
								</div>

								<div class="form-group">
									<label for="email">Email</label>
									<input type="text" name="email" id="email" class="form-control" required>
								</div>

								<div class="form-group">
									<label for="alamat">Alamat Pengiriman</label>
									<textarea class="form-control" name="alamat" id="alamat" rows="4" required></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="buku">Buku</label>
									<select class="form-control" name="buku" id="buku" required>
										<option value="0" selected disabled>- Pilih Buku -</option>
										<option value="1">Pemrograman Internet - Rp 109.000</option>
										<option value="2">Pemrograman Berorientasi Objek - Rp 120.000</option>
										<option value="3">CSS Cheat Sheet - Rp 79.000</option>
										<option value="4">Fundamental PHP Lengkap - Rp 99.000</option>
										<option value="5">Fundamental CSS Lengkap - Best Seller - Rp 100.000</option>
										<option value="6">Dasar Dasar HTML dan CSS - Rp 80.000</option>
									</select>
								</div>

								<div class="form-group">
									<label for="jumlah">Jumlah Buku</label>
									<input type="number" name="jumlah" class="form-control" min="0" required>
								</div>

								<div class="form-group">
									<label for="kurir">Ekspedisi Pengiriman</label>
									<select class="form-control" name="kurir" id="kurir" required>
										<option value="0" selected disabled>- Pilih Ekspedisi Pengiriman -</option>
										<option value="1">JNE Regular - Rp 12.000</option>
										<option value="2">JNE OKE - Rp 17.000</option>
										<option value="3">J&T Regular - Rp 12.000</option>
										<option value="4">Si Cepat Express - Rp 15.000</option>
									</select>
								</div>
								<div class="form-group">
									<label for="tanggal_kirim">Rencana Tanggal Pengiriman</label>
									<input type="date" name="tanggal_kirim" id="tanggal_kirim" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<strong>Tambahan :</strong> <br>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="tambahan1" id="" value="DVD Ebook"> DVD Ebook
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="tambahan2" id="" value="Kertas Kado"> Kertas Kado
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="tambahan3" id="" value="Extra Bubble Warp"> Extra Bubble Warp
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="float-right my-3">
							<button type="reset" class="btn btn-warning px-5">Reset</button>
							&nbsp;
							<button type="submit" name="submit" class="btn btn-primary px-5">Checkout</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>