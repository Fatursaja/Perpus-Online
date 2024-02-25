<?php
if(isset($_GET['id'])){
    include "koneksi.php";
    $id_peminjaman_buku = $_GET['id'];
    $cek_terlambat = mysqli_query($conn, "SELECT * FROM peminjaman_buku WHERE id_peminjaman_buku = '".$id_peminjaman_buku."'");
    $dt_pinjam = mysqli_fetch_array($cek_terlambat);
    
    $kembali = $dt_pinjam['jumlah_pinjam'];
    $id_buku = $dt_pinjam['id_buku'];
    $tanggal_kembali = strtotime($dt_pinjam['tanggal_kembali']);
    $tanggal_sekarang = strtotime(date('Y-m-d'));
    
    if($tanggal_sekarang <= $tanggal_kembali) { // Pengembalian tepat waktu atau sebelum tanggal kembali
        $denda = 0;
    } else { // Pengembalian setelah tanggal kembali
        $harga_denda_perhari = 5000;
        $selisih_hari = floor(($tanggal_sekarang - $tanggal_kembali) / (60 * 60 * 24)); // Menghitung selisih hari
        $denda = $selisih_hari * $harga_denda_perhari;
    }

    mysqli_query($conn, "INSERT INTO pengembalian_buku (id_peminjaman_buku, id_buku, tanggal_pengembalian, denda, jumlah_kembali)
    VALUES ('".$id_peminjaman_buku."','".$id_buku."','".date('Y-m-d')."','".$denda."','".$kembali."')");
    
    header('location: histori_peminjaman.php');
}
?>
