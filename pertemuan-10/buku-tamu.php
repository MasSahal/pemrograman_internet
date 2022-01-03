<div class="card mt-3">
    <div class="card-header bg-info text-white">
        <h4>
            <strong>
                Komentar dari <?= $nama; ?>
            </strong>
        </h4>
    </div>
    <div class="card-body">
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $nama; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?= $email; ?></td>
            </tr>
            <tr>
                <td>Komentar</td>
                <td>:</td>
                <td><?= $komentar; ?></td>
            </tr>
            <tr>
                <td colspan="3">
                    <img src="<?= "./image/" . $name_img; ?>" class="img-fluid" alt="">
                </td>
            </tr>
        </table>
    </div>
    <div class="card-footer">
        <a name="" id="" class="btn btn-primary" href="" role="button">Kembali</a>
    </div>
</div>