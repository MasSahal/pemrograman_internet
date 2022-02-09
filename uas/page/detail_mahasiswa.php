<div class="row mb-3">
    <div class="col-12">
        <div class="card border-left-danger shadow">
            <div class="card-header">
                <div class="m-0 font-weight-bold text-primary">Detail <?= $data['nama']; ?></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="./img/<?= $data['foto']; ?>" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless w-75">
                            <tr>
                                <th>NIM</th>
                                <td>:</td>
                                <td><?= $data['nim']; ?></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td><?= $data['nama']; ?></td>
                            </tr>
                            <tr>
                                <th>Tempat, Tanggal Lahir</th>
                                <td>:</td>
                                <td><?= $data['tempat_lahir'] . ", " . date("d M Y", strtotime($data['tanggal_lahir'])); ?></td>
                            </tr>
                            <tr>
                                <th>Fakultas</th>
                                <td>:</td>
                                <td><?= $data['fakultas']; ?></td>
                            </tr>
                            <tr>
                                <th>Program Studi</th>
                                <td>:</td>
                                <td><?= $data['jurusan']; ?></td>
                            </tr>
                            <tr>
                                <th>Nilai IPK</th>
                                <td>:</td>
                                <td><?= $data['ipk']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a name="" id="" class="btn btn-primary btn-sm" href="mahasiswa.php" role="button">Kembali</a>

            </div>
        </div>
    </div>
</div>