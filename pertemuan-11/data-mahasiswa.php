<?php
$siswa = [
    ['nama' => 'Sahal', 'prodi' => 'Teknik Informatika', 'smt' => 3],
    ['nama' => 'Nuha', 'prodi' => 'PGSD', 'smt' => 2],
    ['nama' => 'Ibnu', 'prodi' => 'Teknik Sipil', 'smt' => 3],
    ['nama' => 'Alex', 'prodi' => 'Teknik Informatika', 'smt' => 1],
    ['nama' => 'Angga', 'prodi' => 'Teknik Mesin', 'smt' => 4],
    ['nama' => 'Jonathan', 'prodi' => 'Sistem Informasi', 'smt' => 4]
]; ?>

<div class="p-3">
    <h4>Data Siswa</h4>
    <table class="table table-bordered table-sm">
        <tr class="thead-light">
            <th>#</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Semester</th>
        </tr>
        <?php
        $no = 0;
        foreach ($siswa as $s) { ?>
            <tr>
                <td><?= $no += 1; ?></td>
                <td><?= $s['nama']; ?></td>
                <td><?= $s['prodi']; ?></td>
                <td><?= $s['smt']; ?></td>
            </tr>
        <?php }; ?>
    </table>
</div>