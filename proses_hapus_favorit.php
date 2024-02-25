<?php
    include "koneksi.php";

    // Jika ada parameter koleksiID yang dikirimkan melalui URL
    if(isset($_GET['koleksiID'])){
        $koleksiID = $_GET['koleksiID'];
        
        // Query untuk menghapus buku favorit berdasarkan koleksiID
        $query = "DELETE FROM koleksipribadi WHERE koleksiID = $koleksiID";
        $result = mysqli_query($conn, $query);

        if($result){
            // Redirect kembali ke halaman daftar buku favorit setelah berhasil menghapus
            echo "<script>alert('Sukses menghapus favorit');location.href='koleksi.php';</script>";
        } else {
            // Tampilkan pesan error jika gagal menghapus
            echo "Gagal menghapus buku dari daftar favorit.";
        }
    } else {
        // Jika tidak ada parameter yang sesuai, redirect ke halaman daftar buku favorit
        header('location: koleksi.php');
    }
?>
