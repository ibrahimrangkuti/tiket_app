<?php

session_start();

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

function signup($data)
{
    global $conn;

    $nama = $data['nama'];
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $cek_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cek_email)) {
        echo "<script>
                alert('Email sudah tersedia')
            </script>";
        return false;
    }

    $query = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function bayar($data)
{
    global $conn;

    $bank_id = $data['bank_id'];
    $kode_pesanan = $data['kode_pesanan'];
    $atas_nama = $data['atas_nama'];
    $no_rekening = $data['no_rekening'];

    $query = "INSERT INTO data_pembayaran (bank_id, kode_pesanan, atas_nama, no_rekening) VALUES ($bank_id, '$kode_pesanan', '$atas_nama', '$no_rekening')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
