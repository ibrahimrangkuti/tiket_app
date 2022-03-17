<?php include 'header.php' ?>

<?php

$id = $_GET['id'];
$user = query("SELECT * FROM users WHERE id = $id")[0];

if (isset($_POST['edit'])) {
    if (editUser($_POST) > 0) {
        echo "<script>
                alert('Data user berhasil diedit')
                document.location.href = 'user_index.php'
            </script>";
    }
}

?>

<main>
    <?php include 'sidebar.php' ?>
    <div class="content">
        <h1>Data User</h1>
        <a href="user_index.php" class="btn-primary">Kembali</a>
        <form action="" method="POST" style="margin-top: 20px;">
            <input type="hidden" name="id" value="<?= $user->id ?>">
            <div class="form" style="width: 50%;">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" value="<?= $user->nama ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?= $user->email ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role">
                        <option hidden>Pilih Role</option>
                        <?php if ($user->role === 'admin') : ?>
                            <option value="admin" selected>Admin</option>
                        <?php elseif ($user->role === 'user') : ?>
                            <option value="user" selected>User</option>
                        <?php endif; ?>
                    </select>
                </div>
                <button type="submit" class="btn-primary" name="edit" style="width: 100%; margin-top: 20px;">Edit</button>
            </div>
        </form>
    </div>
</main>

<?php include 'footer.php' ?>