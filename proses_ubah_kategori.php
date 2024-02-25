<?php
include "koneksi.php";
if ($_POST) {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];

    if (empty($nama_kategori)) {
        echo "<script>alert('Nama kategori tidak boleh kosong');location.href='ubah_kategori.php?id_kategori=$id_kategori';</script>";
    } else {
        // Lakukan proses update kategori buku
        $update = mysqli_query($conn, "UPDATE kategoribuku SET NamaKategori='$nama_kategori' WHERE id_kategori='$id_kategori'");

        if ($update) {
            echo "<script>alert('Sukses update kategori buku');location.href='kategori.php';</script>";
        } else {
            echo "<script>alert('Gagal update kategori buku');location.href='ubah_kategori.php?id_kategori=$id_kategori';</script>";
        }
    }
}
?>
