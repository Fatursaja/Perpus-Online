<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : NULL;
    $id_buku = mysqli_real_escape_string($conn, $_POST['id_buku']);
    $ulasan = mysqli_real_escape_string($conn, $_POST['ulasan']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);

    $insert = mysqli_query($conn, "INSERT INTO ulasan_buku (id_user, id_buku, ulasan, rating) VALUES ('$id_user', '$id_buku', '$ulasan', '$rating')");

    if ($insert) {
        echo "<script>alert('Sukses komentar'); location.href='Ulasan.php';</script>";
    } else {
        echo "<script>alert('Gagal komentar'); location.href='tambah_user.php';</script>";
    }
} else {
    // Tangani jika akses langsung ke proses_ulasan.php tanpa metode POST
    echo "<script>alert('Metode akses tidak valid'); location.href='tambah_user.php';</script>";
}
?>
