<?php
	session_start();
	include "koneksi.php";
	$qry_detail_buku=mysqli_query($conn,"select * from buku where id_buku = '".$_GET['id_buku']."'");
	$dt_buku=mysqli_fetch_array($qry_detail_buku);
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

	<title>Buku</title>

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
                            <a class="sidebar-link" href="tambah_petugass.php">
                                <i class="fas fa-fw fa-school"></i> <span class="align-middle">Petugas</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="buku.php">
                                <i class="fas fa-fw fa-book"></i> <span class="align-middle">Buku</span>
                            </a>
                        </li>
                             
                        <li class="sidebar-item ">
                            <a class="sidebar-link" href="kategori.php">
                                <i class="fas fa-fw fa-book"></i> <span class="align-middle">Kategori</span>
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
                    <?php
                    }
                    ?>
                    <li class="sidebar-item active">
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

		<div class="main">
			

			<!--main konten-->
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Buku</h1>

					<div class="col-md-9">
							<div class="card">
            <div class="row">
                <div class="col-md-4">
                <img src="assets/foto_produk/<?=$dt_buku['foto']?>"
                class="card-img-top">
                </div>
                <div class="col-md-8">
            <form action="masukankomentar.php?id_buku=<?=$dt_buku['id_buku']?>" method="post">
            							<table class="table table-borderless">
                            <thead>
                            <tr>
                            	<td></td><td></td>
                            </tr>
                            <tr>
                              <td>Nama Buku</td><td><?=$dt_buku['nama_buku']?></td>
                            </tr>
                            <tr>
                              <td>Deskripsi</td><td><?=$dt_buku['deskripsi']?></td>
                            </tr>
                            <tr>
                              <td>komentar</td><td> <textarea id="ulasan" name="ulasan" rows="4" required></textarea></td>
                            </tr>
                            <tr>
                              <td>rating</td><td><input type="number" name="rating" value="1"></td>
                            </tr><br><br>
                            <tr>
                            	<td></td><td></td>
                            </tr>
                            <tr>
                              <td colspan="2"><input class="btn btn-primary" type="submit" value="ulasan">
                              <a class="btn btn-warning" href="Ulasan.php" >Kembali</a>
                            </td>
                            </tr>
                            </thead>
                            </table>
                            </form>
                    </div>
                </div>
              </div>
                </div><br><br>
        </div>
				</div>
			</main>



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