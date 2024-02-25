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
    <style>
        .logo {
    width: 40px; /* Ubah lebar logo sesuai kebutuhan */
    height: auto; /* Biarkan tinggi logo menyesuaikan dengan lebarnya */
    margin-right: 10px; /* Atur margin kanan agar teks tidak terlalu dekat dengan logo */
    /* Tambahkan properti CSS lainnya sesuai kebutuhan */
}

    </style>
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
        <a class="sidebar-brand" href="dashboard.php">
            <img src="src/img/photos/logo.png" alt="Perpus Online Logo" class="logo align-middle">
            <span class="align-middle">Perpus online</span>
        </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Fitur
                    </li>

                    <li class="sidebar-item active">
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
				<div class="sidebar-footer">
   			 <div class="text-muted small">
        				Logged in as: <strong><?php echo $_SESSION['level']; ?></strong>
    			</div>
					</div>

            </div>
        </nav>

        <!-- Main Content -->
        <?php
            // Query untuk menghitung jumlah buku
            $queryJumlahBuku = "SELECT COUNT(*) AS total_buku FROM buku";
            $resultJumlahBuku = mysqli_query($conn, $queryJumlahBuku);
            $rowJumlahBuku = mysqli_fetch_assoc($resultJumlahBuku);

            // Query untuk menghitung jumlah user
            $queryJumlahUser = "SELECT COUNT(*) AS total_user FROM user";
            $resultJumlahUser = mysqli_query($conn, $queryJumlahUser);
            $rowJumlahUser = mysqli_fetch_assoc($resultJumlahUser);
 
// Query untuk menghitung jumlah buku yang dipinjam
            $queryJumlahPinjam = "SELECT COUNT(*) AS total_pinjam FROM peminjaman_buku";
            $resultJumlahPinjam = mysqli_query($conn, $queryJumlahPinjam);
            $rowJumlahPinjam = mysqli_fetch_assoc($resultJumlahPinjam);

            // Query untuk menghitung jumlah ulasan yang dikirim
            $queryJumlahUlasan = "SELECT COUNT(*) AS total_ulasan FROM ulasan_buku";
            $resultJumlahUlasan = mysqli_query($conn, $queryJumlahUlasan);
            $rowJumlahUlasan = mysqli_fetch_assoc($resultJumlahUlasan);

            $queryJumlahkategori = "SELECT COUNT(*) AS total_kategori FROM kategoribuku";
            $resultJumlahkategori = mysqli_query($conn, $queryJumlahkategori);
            $rowJumlahkategori = mysqli_fetch_assoc($resultJumlahkategori);
            ?>

<div class="main">
            <main class="content">
                <div class="container-fluid p-0">
                    <!-- Konten utama -->
                    <h2 class="mb-1">Selamat datang <?php echo $_SESSION['nama_lengkap']; ?> di website Perpus online.</h2>
                    <br>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Buku</h5>
                                    <p class="card-text">Total Buku: <?php echo $rowJumlahBuku['total_buku']; ?></p>
                                    <p class="card-text">Kategori Buku: <?php echo $rowJumlahkategori['total_kategori']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Aktivitas Terbaru</h5>
                                    <p class="card-text">Buku Dipinjam: <?php echo $rowJumlahPinjam['total_pinjam']; ?></p>
                                    <p class="card-text">Ulasan: <?php echo $rowJumlahUlasan['total_ulasan']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah User</h5>
                                    <p class="card-text">Total User: <?php echo $rowJumlahUser['total_user']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Informasi Pengguna</h5>
                                    <p class="card-text">Level: <?php echo $_SESSION['level']; ?></p>
                                    <!-- Add more user-related information here -->
                                    <?php if ($_SESSION['level'] == 'peminjam') { ?>
                                <h5 class="card-title">Buku yang Dipinjam</h5>
                                <?php
                                include "koneksi.php";
                                $queryBukuDipinjam = "SELECT buku.nama_buku
                                    FROM buku 
                                    INNER JOIN peminjaman_buku ON buku.id_buku = peminjaman_buku.id_buku 
                                    WHERE peminjaman_buku.id_user = '".$_SESSION['id_user']."'";

                                $resultBukuDipinjam = mysqli_query($conn, $queryBukuDipinjam);
                                $nomorUrut = 1;
                                while ($rowBukuDipinjam = mysqli_fetch_assoc($resultBukuDipinjam)) {
                                    echo "<div class='mb-2'>" . $nomorUrut . ". " . $rowBukuDipinjam['nama_buku'] . "</div>";
                                    $nomorUrut++;
                                }
                                ?>
                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           
            <!-- Footer -->
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
