<?php session_start();?>
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

	<title>Tambah Buku</title>

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

                        <li class="sidebar-item active">
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

		<div class="main">
			

			<!--main konten-->
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Pengisian Data Buku</h1>

					<div class="row">
						<div class="col-8">
							<div class="card">
								<div class="card-header">

            <form action="proses_tambah_buku.php" method="post" enctype="multipart/form-data">
        				<section class="base">
                        <div class="row mb-4">
                                   <div class="col-md-3">Kategori</div>
                                   <div class="col-md-8">
                                        <select name ="id_kategori" class="form-control">
                                             <?php 
                                             include "koneksi.php";
                                             $kat = mysqli_query($conn, "SELECT * FROM kategoribuku");
                                             while($kategori = mysqli_fetch_array($kat)){
                                                  ?>
                                                  <option value="<?php echo $kategori['id_kategori'];?>"> <?php echo $kategori['NamaKategori'];?></option>
                                                  <?php
                                             }
                                             ?>
                                        </select>
                                   </div>
                                   </div>
        							<div class="mb-3">
                          <label for="nama_buku" class="form-label">Nama Buku</label>
                          <input type="text" name="nama_buku" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="penulis" class="form-label">Penulis</label>
                          <input type="text" name="penulis" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="penerbit" class="form-label">Penerbit</label>
                          <input type="text" name="penerbit" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                          <input type="text" name="tahun_terbit" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="deskripsi" class="form-label">Deskripsi</label>
                          <input type="text" name="deskripsi" class="form-control">
                        </div>
						<div class="mb-3">
                          <label for="stok" class="form-label">stok buku</label>
                          <input type="number" name="stok" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="foto" class="form-label">Foto Buku</label>
                          <input type="file" name="file" class="form-control"> <br>
                        </div>
                        <div>
                            <input type="submit" name="simpan" value="Tambah Buku" class="btn btn-outline-primary">
                            <a href="buku.php"><button type="button" class="btn btn-dark">Kembali</button></a>
                        </div>
                      </section>
						        </form>


								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>

			 

				</div>
			</main>




			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="index.html" class="text-muted"><strong>Perpus Native</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-right">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms</a>
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