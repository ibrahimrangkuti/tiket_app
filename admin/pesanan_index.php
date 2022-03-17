<?php include 'header.php' ?>

<?php

$pesanan = query("SELECT * FROM pesanan");

?>

<main>
    <?php include 'sidebar.php' ?>
    <div class="content">
        <h1>Data Pesanan</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>Destinasi</th>
                    <th>Jumlah Orang</th>
                    <th>Tanggal & Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $index => $row) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $row->nama ?></td>
                        <td><?= $row->email ?></td>
                        <td><?= $row->role ?></td>
                        <th>
                            <a href="user_edit.php?id=<?= $row->id ?>" class="btn-edit">Edit</a>
                            <a href="user_hapus.php?id=<?= $row->id ?>" class="btn-delete">Hapus</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include 'footer.php' ?>