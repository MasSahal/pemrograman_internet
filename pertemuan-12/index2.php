<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "universitas";
$koneksi = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$koneksi) {
    die("koneksi dengan database gagal: " . mysqli_connect_errno() .
        " - " . mysqli_connect_error());
}
$query = "DROP TABLE IF EXISTS mahasiswa_baru";
$hasil_query = mysqli_query($koneksi, $query);

if (!$hasil_query) {
    die("Query Error: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
}

$query  = "CREATE TABLE mahasiswa_baru (nim CHAR(8), nama VARCHAR(100), ";
$query .= "tempat_lahir VARCHAR(50), tanggal_lahir DATE, ";
$query .= "fakultas VARCHAR(50), jurusan VARCHAR(50), ";
$query .= "ipk DECIMAL(3,2), PRIMARY KEY (nim))";

$hasil_query = mysqli_query($koneksi, $query);

if (!$hasil_query) {
    die("Query Error: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
}

$query  = "INSERT INTO mahasiswa_baru VALUES ";
$query .= "('14005011', 'Riana Putria', 'padang', '1996-11-23', ";
$query .= "'FMIPA', 'Kimia', 3.1), ";
$query .= "('15003044', 'Rudi Permana', 'Bandung', '1994-08-22', ";
$query .= "'FASILKOM', 'Ilmu Komputer', 2.9), ";
$query .= "('15003036', 'Sari Citra Lestari', 'Jakarta', '1997-12-31', ";
$query .= "'Ekomnomi', 'Manajemen', 3.5)";

$hasil_query = mysqli_query($koneksi, $query);

if (!$hasil_query) {
    die("Query Error: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <h1>Belajar PHP</title>
</head>

<body>
    <h1>Table Mahasiswa</h1>
    <table border="1">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Fakultas</th>
            <th>Jurusan</th>
            <th>IPK</th>
        </tr>
        <?php
        $query = "SELECT * FROM mahasiswa_baru";
        $hasil_query = mysqli_query($koneksi, $query);

        if (!$hasil_query) {
            die("Query error: " . mysqli_errno($koneksi) .
                " - " . mysqli_error($koneksi));
        }
        while ($data = mysqli_fetch_assoc($hasil_query)) {
            echo "<tr>";
            echo "<td>$data[nim]</td>";
            echo "<td>$data[nama]</td>";
            echo "<td>$data[tempat_lahir]</td>";
            echo "<td>$data[tanggal_lahir]</td>";
            echo "<td>$data[fakultas]</td>";
            echo "<td>$data[jurusan]</td>";
            echo "<td>$data[ipk]</td>";
            echo "</tr>";
        }

        mysqli_free_result($hasil_query);
        ?>
    </table>
</body>

</html>
<?php
mysqli_close($koneksi);
?>