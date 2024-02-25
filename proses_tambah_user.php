<?php
    if($_POST){
    $nama_lengkap=$_POST['nama_lengkap'];
    $tanggal_lahir=$_POST['tanggal_lahir'];
    $alamat=$_POST['alamat'];
    $gender=$_POST['gender'];
    $username=$_POST['username'];
    $password= $_POST['password'];
    $email=$_POST['email'];
    $level=$_POST['level'];
    if(empty($nama_lengkap)){
        echo "<script>alert('nama user tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif(empty($username)){
        echo "<script>alert('username tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif(empty($password)){
        echo "<script>alert('password tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif(empty($level)){
        echo "<script>alert('level tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif(empty($gender)){
        echo "<script>alert('gender tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif(empty($alamat)){
        echo "<script>alert('alamat tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif(empty($email)){
        echo "<script>alert('email tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif(empty($tanggal_lahir)){
        echo "<script>alert('password tidak boleh kosong');location.href='tambah_user.php';</script>";
    } else {
        include "koneksi.php";
        $insert=mysqli_query($conn,"insert into user (nama_lengkap,tanggal_lahir, gender, alamat, username, password, email,level) value ('".$nama_lengkap."','".$tanggal_lahir."','".$gender."','".$alamat."','".$username."','".md5($password)."','".$email."','".$level."')") or die(mysqli_error($conn));
    if($insert){
        echo "<script>alert('Sukses daftar');location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal daftar');location.href='tambah_user.php';</script>";
    }
    }
    }
?>