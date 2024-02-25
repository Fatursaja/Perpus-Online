<?php
       include "koneksi.php";
    ?>

<?php
    session_start();
    if($_SESSION['status_login']!=true){
        header('location: Login/index.php');
    }
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

	<title>Dashboard Perpus</title>

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
                        <?php
                    if ($_SESSION['level'] == 'admin') {
                    ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="tambah_petugas.php">
                                <i class="fas fa-fw fa-school"></i> <span class="align-middle">Petugas</span>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
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
                        
                        <li class="sidebar-item ">
                            <a class="sidebar-link" href="koleksi.php">
                                <i class="fas fa-fw fa-book"></i> <span class="align-middle">koleksi</span>
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

					<h2 class="mb-1">Beri Kami Rating dan Ulasan di website Perpus online.</h2>
					<br>
                    
					 <div class="col-12 mt-4">
          <div class="card mb-4">
            <div class="card-header pb-0 p-0">
            </div>
              <div class="row">
                <div class="col-xl-0 col-md-0 mb-xl-0 mb-0">
                  <div class="card card-blog card-plain" style="padding: 20px;">
                  	<h3 class="mb-1" style="font-weight:bold;">Buku Perpus</h3>
              			<p class="text-sm" style="font-size: 14px; opacity: 70%">Today a reader, tomorrow a leader. Happy reading :3</p>
                    <div class="position-relative">
                    </div>
                    <div class="card-body px- pb-0">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="avatar-group mt-2"> 
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
<!-- ... (sebelumnya kode HTML) ... -->

<?php
    include "koneksi.php";
    $qry_buku=mysqli_query($conn,"select * from buku");
    while($dt_buku=mysqli_fetch_array($qry_buku)){
?>

<div class="col-md-3">
    <div class="card" >
        <img src="assets/foto_produk/<?=$dt_buku['foto']?>" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title"><?=$dt_buku['nama_buku']?></h5>
            <p class="card-text"><?=substr($dt_buku['penerbit'],0,150)?></p>

            <!-- Form untuk menambahkan komentar -->
            <form action="tambah_ulasan.php" method="post">
                <input type="hidden" name="id_buku" value="<?=$dt_buku['id_buku']?>">
                <div class="form-group">
                    <label for="ulasan">Ulasan:</label>
                    <textarea class="form-control" name="ulasan" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="rating">Rating:</label>
                    <input type="number" class="form-control" name="rating" min="1" max="10" required>
                </div>
                <button type="submit" class="btn btn-dark">Tambah Ulasan</button>
            </form>

        </div>
    </div>
</div>

<?php
    }
?>

<div class="col-md-12 mt-4">
    <h2 class="mb-1">Komentar Pengguna</h2>
    <hr>
    <?php
    include "koneksi.php";

    $qry_komentar = mysqli_query($conn, "
        SELECT ulasan_buku.*, user.username, buku.nama_buku
        FROM ulasan_buku
        JOIN user ON ulasan_buku.id_user = user.id_user
        JOIN buku ON ulasan_buku.id_buku = buku.id_buku
    ");
    ?>

    <?php
    while ($dt_komentar = mysqli_fetch_array($qry_komentar)) {
    ?>
        <div class="card mb-3 border">
            <div class="card-body">
                <h5 class="card-title"><?= $dt_komentar['username'] ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $dt_komentar['nama_buku'] ?></h6>
                <p class="card-text"><?= $dt_komentar['ulasan'] ?></p>
                <hr>
                <p class="card-text">Rating: <?= $dt_komentar['rating'] ?>/10</p>
            </div>
        </div>
    <?php
    }
    ?>
</div>

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
			</footer>
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