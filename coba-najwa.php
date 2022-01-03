<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>|BOOKING HOTEL|</title>
</head>

<body>
    <!-- Input -->
    <fieldset>
        <div>
            <legend>
                <h1>|FORM BOOKING HOTEL|</h1>
            </legend>
            <form method="post">
                <table>
                    <tr>
                        <td>
                            <label for="nk">Nomor KTP</label>
                        </td>
                        <td>:
                            <input id="nk" type="number" name="nk" placeholder="Masukkan Nomor">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nama">Nama </label>
                        </td>
                        <td>:
                            <input id="nama" type="text" name="nama" placeholder="Masukkan Nama">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="umur">Umur</label>
                        </td>
                        <td>:
                            <input id="umur" type="number" name="umur" placeholder="Masukkan Umur">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="jk">Jenis Kelamin</label>
                        </td>
                        <td>:
                            <input id="jk" type="text" name="jk" placeholder="Jenis Kelamin">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="alamat">Alamat</label>
                        </td>
                        <td>:
                            <input id="alamat" type="text" name="alamat" placeholder="Masukkan Alamat">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="tk">Tipe Kamar</label>
                        </td>
                        <td>:
                            <select name="tk" id="tk">
                                <option hidden="" disabled="" selected="">Pilih</option>
                                <option value="standar">Standar Room</option>
                                <option value="superior">Superior Room</option>
                                <option value="deluxe">Deluxe Room</option>
                                <option value="standar">Suit Room</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nomorkamar">Nomor Kamar</label>
                        </td>
                        <td>:
                            <input id="nomorkamar" type="number" name="nomorkamar" placeholder="Masukkan Nomor Kamar">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="fas">Fasilitas</label>
                        </td>
                        <td>:
                            <input id="fas" type="text" name="fas" placeholder="Fasilitas tambahan">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="jmlkamar">Jumlah Kamar</label>
                        </td>
                        <td>:
                            <select name="jmlKamar" id="jmlKamar">
                                <option hidden="" disabled="" selected="">Pilih</option>
                                <?php for ($i = 1; $i <= 15; $i++) { ?>
                                    <option value='<?= $i; ?>'> <?= $i; ?> Kamar</option>

                                <?php
                                }; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="lamainap">Lama Inap</label>
                        </td>
                        <td>:
                            <input id="lamainap" type="number" name="lamainap" placeholder="Lama inap">
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Inap :</td>
                        <td>
                            <select name="tanggal">
                                <option value="">Tanggal Inap:</option>
                                <?php
                                for ($a = 1; $a <= 31; $a++) {
                                    echo "    <option>$a</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="input">Input</button>
                        </td>
                    </tr>


                </table>
            </form>
        </div>
        <br><br><br>
        <?php
        // agar tidak error saat form belum ada yang terisi
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

        // menentukan variabel
        $nomorKtp = $_POST['nk'];
        $nama = $_POST['nama'];
        $umur = $_POST['umur'];
        $jk = $_POST['jk'];
        $alamat = $_POST['alamat'];
        $tipeKamar = $_POST['tk'];
        $nomorKamar = $_POST['nomorkamar'];
        $fasilitas = $_POST['fas'];
        $jumlahKamar = $_POST['jmlKamar']; //
        $lamaInap = $_POST['lamainap'];
        $tanggal = $_POST['tanggal'];
        $pajakKamar = $_POST['pk'];

        // sebelum 'imput' diklik tidak ada hasil yang keluar
        if (isset($_POST['input'])) {
            $rp;
        } else {
            return null;
        }

        // mencari tipe kamar
        // $harga = 0;
        if ($tipeKamar == "standar") {
            $harga = 300000;
        } elseif ($tipeKamar == "superior") {
            $harga = 500000;
        } elseif ($tipeKamar == "deluxe") {
            $harga = 800000;
        } else {
            $harga = 1000000;
        }
        //menentukan jumlah kamar
        $jumlahKamar = "";
        switch ($_POST['jmlKamar']) {
            case ($_POST['jmlKamar'] == 1):
                $jumlahKamar = $_POST['jmlKamar'];
                break;
            case ($_POST['jmlKamar'] <= 5):
                $jumlahKamar = $_POST['jmlKamar'];
                break;
            case ($_POST['jmlKamar'] <= 10):
                $jumlahKamar = $_POST['jmlKamar'];
                break;
            case ($_POST['jmlKamar'] <= 15):
                $jumlahKamar = $_POST['jmlKamar'];
                break;
        }
        // mencari diskon
        if ($jumlahKamar == 1) {
            $diskon = 0;
        } elseif ($jumlahKamar <= 5) {
            $diskon = 5 / 100;
        } elseif ($jumlahKamar <= 10) {
            $diskon = 10 / 100;
        } else {
            $diskon = 15 / 100;
        }

        // mencari pph
        $pajakKamar = 10 / 100 * $harga;
        echo $harga;
        $total = (($harga * $lamaInap * $jumlahKamar) + $pajakKamar) - $diskon;

        ?>

        <!-- Output  -->
        <div>
            <h2>Hasil :</h2>
            <table>
                <tr>
                    <td>Nomor KTP</td>
                    <td>:
                        <?php echo "$nomorKtp"; ?>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:
                        <?php echo "$nama"; ?>
                    </td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:
                        <?php echo "$umur"; ?>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:
                        <?php echo "$jk"; ?>
                    </td>
                </tr>

                <tr>
                    <td>Alamat</td>
                    <td>:
                        <?php echo "$alamat"; ?>
                    </td>
                </tr>
                <tr>
                    <td>Tipe Kamar</td>
                    <td>:
                        <?php echo "$tipeKamar"; ?>
                    </td>
                </tr>
                <tr>
                    <td>Nomor Kamar</td>
                    <td>:
                        <?php echo "$nomorKamar"; ?>
                    </td>
                </tr>
                <tr>
                    <td>Fasilitas</td>
                    <td>:
                        <?php echo "$fasilitas"; ?>
                    </td>
                </tr>
                <tr>
                    <td>Jumlah Kamar</td>
                    <td>:
                        <?php echo $jumlahKamar; ?> Kamar
                    </td>
                </tr>
                <tr>
                    <td>Lama Inap</td>
                    <td>:
                        <?php echo "$lamaInap hari"; ?>
                    </td>
                </tr>
                <tr>
                    <td>Tangal Inap</td>
                    <td>:
                        <?php echo "$tanggal"; ?>
                    </td>
                </tr>
                <tr>
                    <td>Total Bayaran</td>
                    <td>:
                        <?php echo "$total"; ?>
                    </td>
                </tr>
            </table>
        </div>
    </fieldset>
</body>

</html>