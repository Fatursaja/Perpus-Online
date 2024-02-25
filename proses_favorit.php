<?php
    include "koneksi.php";

    // Pastikan pengguna telah login sebelum menambahkan ke favorit
    session_start();
    if(!isset($_SESSION['status_login']) || $_SESSION['status_login'] != true){
        header('location: ../static/Login/index.php');
    }

    // Pastikan parameter id_buku ada
    if(isset($_GET['id_buku'])){
        $id_buku = $_GET['id_buku'];

       
         $id_user = $_SESSION['id_user'];
         $check_query = "SELECT COUNT(*) AS total FROM koleksipribadi WHERE id_user = $id_user AND id_buku = $id_buku";
    $check_result = mysqli_query($conn, $check_query);
    $check_data = mysqli_fetch_assoc($check_result);

    if($check_data['total'] > 0) {
        // Jika buku sudah ada dalam koleksi, beri respons kepada pengguna
        echo "<script>
               alert('Buku sudah ada dalam koleksi favorit Anda');
               location.href='pinjam.php';
             </script>";
    } else {
        // Jika buku belum ada dalam koleksi, tambahkan buku ke koleksi favorit
        $insert_query = "INSERT INTO tb_koleksi (id_user, id_buku) VALUES ($id_user, $id_buku)";
        mysqli_query($koneksi, $insert_query);

        // Beri respons kepada pengguna bahwa buku telah ditambahkan ke favorit
        echo "<script>
               alert('Selamat Anda berhasil menambahkan buku ke favorit');
               location.href='pinjam.php';
             </script>";
    }
} else {
    // Beri respons bahwa parameter id_buku tidak ditemukan
    echo "ID buku tidak ditemukan!";
}
?>
