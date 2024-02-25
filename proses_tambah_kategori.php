<?php
 
    if($_POST['simpan']){
        $nama_kategori=$_POST['nama_kategori'];
		
        if(empty($nama_kategori)){
            echo "<script>alert('nama kategori tidak boleh kosong');location.href='tambah_kategori.php';</script>";
        }else{
			
            include "koneksi.php";
            $insert=mysqli_query($conn,"insert into kategoribuku (namakategori) value ('".$nama_kategori."')") or die(mysqli_error($conn));
        if($insert){
						echo "<script>alert('Sukses menambahkan kategori');location.href='kategori.php';</script>";
					}else{
						echo "<script>alert('Gagal menambahkan kategori);location.href='kategori.php';</script>";
					}
                }
            }
?>