<?php
    include "koneksi.php";

    session_start();
    // Periksa apakah pengguna sudah login
    if(!isset($_SESSION['status_login']) || $_SESSION['status_login'] != true){
        header('location: Login/index.php');
    }

    // Query untuk mendapatkan daftar buku favorit pengguna
    $id_user = $_SESSION['id_user'];
    $query = "SELECT b.nama_buku, b.penulis, b.penerbit, b.tahun_terbit, b.deskripsi, b.foto, f.koleksiID
    FROM buku b
    INNER JOIN koleksipribadi f ON b.id_buku = f.id_buku
    WHERE f.id_user = $id_user";

    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <title>Daftar Buku Favorit</title>

    <link href="css/app.css" rel="stylesheet">
</head>

<body>
<div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">Perpus online</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Fitur
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="dashboard.php">
                            <i class="fas fa-fw fa-home"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <?php
                    if ($_SESSION['level'] != 'peminjam') {
                    ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="histori_peminjaman.php">
                                <i class="fas fa-fw fa-history"></i> <span class="align-middle">Transaksi</span>
                            </a>
                        </li>

                        <li class="sidebar-header">
                            Data Perpus
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="user.php">
                                <i class="fas fa-fw fa-user-graduate"></i> <span class="align-middle">User</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="tambah_petugas.php">
                                <i class="fas fa-fw fa-school"></i> <span class="align-middle">Petugas</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="buku.php">
                                <i class="fas fa-fw fa-book"></i> <span class="align-middle">Buku</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="laporan.php">
                                <i class="fas fa-fw fa-book"></i> <span class="align-middle">Generate Laporan</span>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="Pinjam.php">
                                <i class="fas fa-fw fa-book"></i> <span class="align-middle">Pinjam Buku</span>
                            </a>
                        </li>
                        <li class="sidebar-item active">
                            <a class="sidebar-link" href="koleksi.php">
                                <i class="fas fa-fw fa-book"></i> <span class="align-middle">koleksi</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="Ulasan.php">
                            <i class="fas fa-fw fa-book"></i> <span class="align-middle">Ulasan</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Account Pages
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="logout.php">
                            <i class="fas fa-sign-out-alt"></i> <span class="align-middle">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main">
            <main class="content">
                <div class="container-fluid p-0">
                    <!-- List of Favorite Books -->
                    <h2 class="mb-1">Daftar Buku Favorit</h2>
                    <br>

                    <div class="row">
                        <?php
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <div class="col-md-3">
                            <div class="card">
                            <img src="assets/foto_produk/<?=$row['foto']?>" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['nama_buku']; ?></h5>
                                    <p class="card-text">Penulis: <?php echo $row['penulis']; ?></p>
                                    <p class="card-text">Penerbit: <?php echo $row['penerbit']; ?></p>
                                    <p class="card-text">Tahun Terbit: <?php echo $row['tahun_terbit']; ?></p>
                                    <p class="card-text"><?php echo $row['deskripsi']; ?></p>
                                    <a href="proses_hapus_favorit.php?koleksiID=<?=$row['koleksiID']?>" class="btn btn-dark" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini dari daftar favorit?')">Hapus</a>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-left">
                            <p class="mb-0">
                                <a href="index.html" class="text-muted"><strong>Perpus online</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-right">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Khalifatur Labia R</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">XII RPL 2</a>
                                </li>
                            </ul>
                        </div>
                  
        </div>
    </div>

    <script src="js/app.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("datetimepicker-dashboard").flatpickr({
                inline: true,
                prevArrow: "<span class=\"fas fa-chevron-left\" title=\"Previous month\"></span>",
                nextArrow: "<span class=\"fas fa-chevron-right\" title=\"Next month\"></span>",
            });
        });
    </script>
</body>

</html>
