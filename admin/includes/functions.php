<?php

session_start();

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
}

$conn = mysqli_connect("localhost", "root", "", "tiket_app");

function query($query)
{
    global $conn;

    $rows = [];
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_object($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambahUser($data)
{
    global $conn;

    $nama = $data['nama'];
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $role = $data['role'];
    $cek_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cek_email)) {
        echo "<script>
                alert('Email sudah tersedia')
            </script>";
        return false;
    }

    $query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$password', '$role')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editUser($data)
{
    global $conn;

    $id = $data['id'];
    $nama = $data['nama'];
    $email = $data['email'];
    $role = $data['role'];
    $result = query("SELECT * FROM users WHERE id = $id")[0];
    if ($email !== $result->email) {
        $cek_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($cek_email)) {
            echo "<script>
                    alert('Email sudah terdaftar')
                </script>";
            return false;
        }
    }

    $query = "UPDATE users SET
                    nama = '$nama',
                    email = '$email',
                    role = '$role'
                WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
