<?php
    if($_GET['id_kategori']){
        include "koneksi.php";
        $qry_hapus=mysqli_query($conn,"delete from kategoribuku where id_kategori='".$_GET['id_kategori']."'");
        if($qry_hapus){
            echo "<script>alert('Sukses hapus kategori');location.href='kategori.php';</script>";
        } else {
            echo "<script>alert('Gagal hapus kategori');location.href='kategori.php';</script>";
        }
    }
?>