<?php include 'header.php' ?>

<?php

$destinasi = query("SELECT * FROM destinasi");
$banks = query("SELECT * FROM bank");

if (isset($_POST['pesan'])) {
    $nama_destinasi = $_POST['destinasi'];
    $dest = query("SELECT * FROM destinasi WHERE nama_destinasi = '$nama_destinasi'")[0];
    $pesanan_destinasi = mysqli_query($conn, "SELECT * FROM pesanan_destinasi");

    $baris = mysqli_num_rows($pesanan_destinasi);
    $today = date('dmy', time());

    $_SESSION['pesan'] = true;
    $_SESSION['kode_pesanan'] = 'KD-' . $today . $baris + 1;
    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['destinasi'] = $nama_destinasi;
    $_SESSION['jumlah'] = $_POST['jumlah'];
    $_SESSION['tanggal'] = $_POST['tanggal'];
    $_SESSION['waktu'] = $_POST['waktu'];
    $total_harga = $_POST['jumlah'] * $dest->biaya;
    $harga_diskon = 0;
    if ($total_harga >= 1000000 and $total_harga <= 2999999) {
        $harga_diskon = $total_harga * 15 / 100;
        $total_harga = $total_harga - $harga_diskon;
    } else if ($total_harga >= 3000000 and $total_harga <= 4999999) {
        $harga_diskon = $total_harga * 20 / 100;
        $total_harga = $total_harga - $harga_diskon;
    } else if ($total_harga >= 5000000 and $total_harga <= 9999999) {
        $harga_diskon = $total_harga * 40 / 100;
        $total_harga = $total_harga - $harga_diskon;
    }

    $_SESSION['total_harga'] = $total_harga;
}

if (isset($_SESSION['pesan'])) {
    $kode_pesanan = $_SESSION['kode_pesanan'];
}

?>

<section id="pesan">
    <div class="container">
        <h1>Pesan</h1>
        <div class="row">
            <div class="col">
                <form action="" method="POST">
                    <div class="form" style="width: 70%; margin-top: 20px;">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="destinasi">Destinasi</label>
                            <select name="destinasi" id="destinasi">
                                <?php foreach ($destinasi as $row) : ?>
                                    <option value="<?= $row->nama_destinasi ?>" required><?= $row->nama_destinasi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Orang</label>
                            <input type="number" name="jumlah" id="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal & Waktu</label>
                            <input type="date" name="tanggal" id="tanggal" required>
                            <input type="time" name="waktu" id="waktu" required>
                        </div>
                        <button type="submit" class="btn-primary" name="pesan" style="width: 100%; margin-top: 20px;">Pesan</button>
                    </div>
                </form>
            </div>
            <div class="col">
                <table class="table" style="margin-top: 20px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Pesanan</th>
                            <th>Nama Lengkap</th>
                            <th>Destinasi</th>
                            <th>Jumlah Orang</th>
                            <th>Tanggal & Waktu</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($_SESSION['pesan'])) : ?>
                            <tr>
                                <td>1</td>
                                <td><?= $_SESSION['kode_pesanan'] ?></td>
                                <td><?= $_SESSION['nama'] ?></td>
                                <td><?= $_SESSION['destinasi'] ?></td>
                                <td><?= $_SESSION['jumlah'] ?> orang</td>
                                <td><?= $_SESSION['tanggal'] ?> <?= $_SESSION['waktu'] ?></td>
                                <td>Rp. <?= number_format($_SESSION['total_harga']) ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div>
                    <?php if (isset($_SESSION['pesan'])) : ?>
                        <form action="bayar.php?kode=<?= $kode_pesanan ?>" method="POST">
                            <div class="flex-align-center">
                                <div>
                                    <label for="bank">Pilih Bank</label>
                                    <select name="nama_bank" id="nama_bank">
                                        <?php foreach ($banks as $bank) : ?>
                                            <option value="<?= $bank->nama_bank ?>"><?= $bank->nama_bank ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn-primary" name="bayar" style="float: right; margin-top: 20px;">Lanjut Bayar</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php' ?>