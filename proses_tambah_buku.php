<?php
    include "koneksi.php";
    if($_POST['simpan']){
        $nama_buku=$_POST['nama_buku'];
		$penulis=$_POST['penulis'];
		$penerbit=$_POST['penerbit'];
		$tahun_terbit=$_POST['tahun_terbit'];
        $deskripsi=$_POST['deskripsi'];
		$stok=$_POST['stok'];
		$kategori=$_POST['id_kategori'];
        //upload foto
        $ekstensi = array('png','jpg','jpeg');
		$namafile = $_FILES['file']['name'];
		$tmp = $_FILES['file']['tmp_name'];
		$tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
		$ukuran = $_FILES['file']['size'];	

        if(empty($nama_buku)){
            echo "<script>alert('nama buku tidak boleh kosong');location.href='tambah_buku.php';</script>";
        }else{
			if(!in_array($tipe_file, $ekstensi)){
				header("location:tambah_buku.php?alert=gagal_ektensi");
			}else{
				if($ukuran < 1044070){			
					move_uploaded_file($tmp, 'assets/foto_produk/'.$namafile);
					$query = mysqli_query($conn, "INSERT INTO buku (nama_buku,penulis,penerbit,tahun_terbit, deskripsi, stok, foto,id_kategori) 
					VALUE ('".$nama_buku."','".$penulis."','".$penerbit."','".$tahun_terbit."','".$deskripsi."','".$stok."','".$namafile."','".$kategori."')");
					if($query){
						echo "<script>alert('Sukses menambahkan buku');location.href='buku.php';</script>";
					}else{
						echo "<script>alert('Gagal menambahkan buku');location.href='buku.php';</script>";
					}
				}else{
					echo "<script>alert('Ukuran Terlalu Besar');location.href='tambah_buku.php';</script>";
				}
			}
		}
    }
?>