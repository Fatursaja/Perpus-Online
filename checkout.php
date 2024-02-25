<?php
session_start();
include "koneksi.php";

 
// mengambil data barang dengan kode paling besar
$query = mysqli_query($conn, "SELECT max(kd_pinjam) as kodeTerbesar FROM peminjaman_buku");
$data = mysqli_fetch_array($query);
$kodeBarang = $data['kodeTerbesar'];
 
// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeBarang, 3, 3);
 
// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;
 
// membentuk kode barang baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
$huruf = "bku";
$kodeBarang = $huruf . sprintf("%03s", $urutan);

 

$cart = @$_SESSION['cart'];
foreach ($cart as $key_produk => $val_produk) {
    $id_buku = mysqli_real_escape_string($conn, $val_produk['id_buku']);
    $qty = (int) $val_produk['qty'];
if (count($cart) > 0) {
    $lama_pinjam = 1; // satuan hari

    $tgl_harus_kembali = date('Y-m-d', mktime(0, 0, 0, date('m'), (date('d') + $lama_pinjam), date('Y')));

    // Dapatkan data id_user, jika tidak ada, beri nilai NULL
    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : NULL;

    // Masukkan data peminjaman buku
    mysqli_query($conn, "INSERT INTO peminjaman_buku (id_user,id_buku, tanggal_pinjam, tanggal_kembali,jumlah_pinjam,kd_pinjam) VALUES 
    ('$id_user','$id_buku', '" . date('Y-m-d') . "', '$tgl_harus_kembali','$qty','$kodeBarang')");
}
    // Dapatkan id peminjaman terakhir yang diinsert
    $id_peminjaman = mysqli_insert_id($conn);

    foreach ($cart as $key_produk => $val_produk) {
        // Lakukan pengecekan apakah id_buku sesuai dengan data yang valid
        $id_buku = mysqli_real_escape_string($conn, $val_produk['id_buku']);
        $qty = (int) $val_produk['qty']; // pastikan qty adalah integer

        // Masukkan data detail peminjaman buku
        mysqli_query($conn, "INSERT INTO detail_peminjaman_buku (id_peminjaman_buku, id_buku, qty) VALUES ('$id_peminjaman', '$id_buku', '$qty')");
    }

    unset($_SESSION['cart']);
    echo '<script>alert("Anda berhasil meminjam buku");location.href="pinjam.php"</script>';
}
?>