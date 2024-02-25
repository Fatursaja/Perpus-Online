<?php
session_start();

// Cek apakah data POST tersedia
if($_POST){

    // Include file koneksi
    include "koneksi.php";

    // Ambil informasi buku dari database berdasarkan id buku yang diberikan
    $qry_get_buku = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku = '".$_GET['id_buku']."'");
    $dt_buku = mysqli_fetch_array($qry_get_buku);

    // Jika keranjang belum ada, inisialisasi dengan array kosong
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Cek apakah keranjang sudah penuh
    $jumlah_buku_dipinjam = count($_SESSION['cart']);
    $max_buku_dipinjam = 2; // Jumlah maksimal buku yang dapat dipinjam

    // Logika untuk menambah buku ke keranjang
    if ($jumlah_buku_dipinjam < $max_buku_dipinjam) {
        // Tambah buku ke keranjang jika belum mencapai batasan maksimal
        $_SESSION['cart'][] = array(
            'id_buku' => $dt_buku['id_buku'],
            'nama_buku' => $dt_buku['nama_buku'],
            'qty' => $_POST['jumlah_pinjam']
        );
    } else {
        // Keranjang sudah penuh, berikan pesan kepada pengguna atau lakukan tindakan lainnya
        $_SESSION['pesan'] = "Keranjang sudah penuh. Anda tidak dapat menambahkan lebih banyak buku.";
    }
}

// Redirect ke halaman keranjang
header('location: keranjang.php');

?>