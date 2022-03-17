<?php include 'header.php' ?>

<?php

$users = query("SELECT * FROM users ORDER BY id DESC ");

?>

<main>
    <?php include 'sidebar.php' ?>
    <div class="content">
        <h1>Data User</h1>
        <a href="user_tambah.php" class="btn-primary">Tambah User</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
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