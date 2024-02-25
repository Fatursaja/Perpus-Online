<?php
    if ($_POST) {
        $id_user = $_POST['id_user'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $alamat = $_POST['alamat'];
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $level = $_POST['level'];

        if (empty($nama_lengkap)) {
            echo "<script>alert('Nama user tidak boleh kosong');location.href='tambah_user.php';</script>";
        } elseif (empty($username)) {
            echo "<script>alert('Username tidak boleh kosong');location.href='tambah_user.php';</script>";
        } else {
            include "koneksi.php";
            if (empty($password)) {
                $update = mysqli_query($conn, "UPDATE user SET
                nama_lengkap='".$nama_lengkap."', tanggal_lahir='".$tanggal_lahir."', gender='".$gender."', alamat='".$alamat."', username='".$username."', email='".$email."', level='".$level."' WHERE id_user='".$id_user."'") or
                die(mysqli_error($conn));

                if ($update) {
                    echo "<script>alert('Sukses update user');location.href='user.php';</script>";
                } else {
                    echo "<script>alert('Gagal update user');location.href='ubah_user.php?id_user=".$id_user."';</script>";
                }
            }
        }
    }
?>
