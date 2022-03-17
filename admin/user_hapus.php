<?php

include 'header.php';

$id = $_GET['id'];
$cek_user = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
if (!mysqli_num_rows($cek_user)) {
    echo "<script>
            alert('User tidak ditemukan!')
            document.location.href = 'user_index.php'
        </script>";
    return false;
}

$user = mysqli_fetch_object($cek_user);
if ($user->role == 'admin') {
    echo "<script>
            alert('Tidak dapat menghapus admin!')
            document.location.href = 'user_index.php'
        </script>";
    return false;
}

mysqli_query($conn, "DELETE FROM users WHERE id = $id");
if (mysqli_affected_rows($conn)) {
    echo "<script>
            alert('User berhasil dihapus!')
            document.location.href = 'user_index.php'
        </script>";
}
