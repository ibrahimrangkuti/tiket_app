<?php include 'header.php' ?>

<?php

if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin') {
        header('Location: admin/index.php');
    } elseif ($_SESSION['role'] == 'user') {
        header('Location: index.php');
    }
}

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cek_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cek_email)) {
        $result = mysqli_fetch_object($cek_email);
        if (password_verify($password, $result->password)) {
            $_SESSION['login'] = true;
            $_SESSION['nama'] = $result->nama;
            $_SESSION['email'] = $result->email;
            $_SESSION['role'] = $result->role;
            if ($result->role == 'admin') {
                header('Location: admin/index.php');
            } else if ($result->role == 'user') {
                if (isset($_SESSION['pesan'])) {
                    $kode_pesanan = $_SESSION['kode_pesanan'];
                    header('Location: pesan.php');
                } else {
                    header('Location: index.php');
                }
            }
        } else {
            echo "<script>
                alert('Password salah!')
            </script>";
        }
    } else {
        echo "<script>
                alert('Akun tidak ditemukan!')
            </script>";
    }
}

?>

<section id="auth">
    <h1>Sign In</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <p>Belum punya akun? <a href="signup.php">Sign Up</a></p>
        <button type="submit" class="btn-primary" name="signin">Sign In</button>
    </form>
</section>

<?php include 'footer.php' ?>