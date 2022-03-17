<?php include 'header.php' ?>

<?php

if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin') {
        header('Location: admin/index.php');
    } elseif ($_SESSION['role'] == 'user') {
        header('Location: index.php');
    }
}

if (isset($_POST['signup'])) {
    if (signup($_POST) > 0) {
        echo "<script>
                alert('Berhasil daftar akun! Silakan sign in')
                document.location.href = 'signin.php'
            </script>";
    }
}

?>

<section id="auth">
    <h1>Sign Up</h1>
    <form action="" method="POST">
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
        <p>Sudah punya akun? <a href="signin.php">Sign In</a></p>
        <button type="submit" class="btn-primary" name="signup">Sign Up</button>
    </form>
</section>

<?php include 'footer.php' ?>