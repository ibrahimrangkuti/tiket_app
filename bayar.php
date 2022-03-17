<?php include 'header.php' ?>

<?php

$nama_bank = $_POST['nama_bank'];
$bank = query("SELECT * FROM bank WHERE nama_bank = '$nama_bank'")[0];

if (!isset($_SESSION['login'])) {
    echo "<script>
            alert('Harap login terlebih dahulu!')
            document.location.href = 'signin.php'
        </script>";
}

if (isset($_POST['konfirmasi'])) {
    if (bayar($_POST) > 0) {
        echo "<script>
                alert('Harap tunggu konfirmasi dari admin!')
                document.location.href = 'bayar.php?kode=<?= $kode_pesanan ?>'
            </script>";
    }
}

?>

<section id="bayar">
    <table class="table">
        <tr>
            <td>Kode Pesanan</td>
            <td>:</td>
            <td><?= $_SESSION['kode_pesanan'] ?></td>
        </tr>
        <tr>
            <td>Bank</td>
            <td>:</td>
            <td><?= $bank->nama_bank ?></td>
        </tr>
        <tr>
            <td>Atas Nama</td>
            <td>:</td>
            <td><?= $bank->atas_nama ?></td>
        </tr>
        <tr>
            <td>No Rekening</td>
            <td>:</td>
            <td><?= $bank->no_rekening ?></td>
        </tr>
        <tr>
            <td>Total Harga</td>
            <td>:</td>
            <td>Rp. <?= number_format($_SESSION['total_harga']) ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>Belum dibayar</td>
        </tr>
    </table>

    <div class="center">
        <form action="" method="POST">
            <input type="hidden" name="bank_id" value="<?= $bank->id ?>">
            <input type="hidden" name="kode_pesanan" value="<?= $_SESSION['kode_pesanan'] ?>">
            <div class="form">
                <div class="form-group">
                    <label for="atas_nama">Atas Nama</label>
                    <input type="text" name="atas_nama" id="atas_nama">
                </div>
                <div class="form-group">
                    <label for="no_rekening">No Rekening</label>
                    <input type="number" name="no_rekening" id="no_rekening">
                </div>
                <button type="submit" class="btn-primary" name="konfirmasi" style="width: 100%; margin-top: 10px;">Konfirmasi</button>
            </div>
        </form>
    </div>
</section>

<?php include 'footer.php' ?>