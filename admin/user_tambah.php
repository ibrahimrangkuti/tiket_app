<?php include 'header.php' ?>

<?php

if (isset($_POST['tambah'])) {
    if (tambahUser($_POST) > 0) {
        echo "<script>
                alert('User berhasil ditambahkan')
                document.location.href = 'user_index.php'
            </script>";
    }
}

?>

<main>
    <?php include 'sidebar.php' ?>
    <div class="content">
        <h1>Data User</h1>
        <form action="" method="POST">
            <div class="form" style="width: 50%;">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary" name="tambah" style="width: 100%; margin-top: 20px;">Tambah</button>
            </div>
        </form>
    </div>
</main>

<?php include 'footer.php' ?>