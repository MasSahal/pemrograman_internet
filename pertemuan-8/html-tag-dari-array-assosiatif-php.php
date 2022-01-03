<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Belajar PHP</title>
</head>
<?php
$array = [
    "siswa1" => ['Ahmad', 'Surabaya', "12 Mei 2002"],
    "siswa2" => ['Sugeng', 'Jakarta', "09 April 2001"],
    "siswa3" => ['Mulyadi', 'Malang', "25 Desember 2003"],
    "siswa4" => ['Hambali', 'Gorontalo', "22 Juni 2000"]
];
?>

<body>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>Nama</th>
            <th>Tempat Tanggal Lahir</th>
        </tr>
        <?php foreach ($array as $a) { ?>
            <tr>
                <td><?= $a[0]; ?></td>
                <td><?= $a[1]; ?>, <?= $a[2]; ?></td>
            </tr>
        <?php }; ?>
    </table>
</body>

</html>