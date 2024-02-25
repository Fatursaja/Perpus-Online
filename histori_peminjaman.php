<?php
    session_start();
    if($_SESSION['status_login']!=true){
        header('location: index.php');
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

    <title>Histori Peminjaman Buku</title>

    <link href="css/app.css" rel="stylesheet">
    <style>
        .highlight {
    background-color: #ffcccb; /* Ganti dengan warna yang Anda inginkan */
}

    </style>
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
            <li class="sidebar-item active">
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
            </div>
        </nav>

        <div class="main">
            

            <!--main konten-->
            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Histori Peminjaman Buku</h1>
            <a href="cetak_laporan.php" class="btn btn-primary">cetak</a>
                    <div class="container-fluid py-4">
            <div class="row">
              <div class="col-12">
                <div class="card mb-4">
                  <div class="card-header pb-0">
            <!-- Tambahkan input field dan tombol pencarian -->
            <form method="GET" action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari berdasarkan kode buku" name="search">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                </div>
            </form>


           <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-bordered">
                  <thead>
                    <tr class="text-xs font-weight-bold opacity-6">
                      <th>No</th>
                      <th class="align-middle text-left">Tanggal Pinjam</th>
                      <th class="align-middle text-left">Tanggal Kembali</th>
                      <th class="align-middle text-left">Kode Pinjam</th>
                      <th class="align-middle text-left">Judul Buku</th>
                      <th class="align-middle text-left">Status</th>
                      <th class="align-middle text-left">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                                        <?php
                        include "koneksi.php";
                        $search = isset($_GET['search']) ? $_GET['search'] : ''; // Mendapatkan kata kunci pencarian dari URL

                        $qry_histori = mysqli_query($conn, "SELECT * FROM peminjaman_buku ORDER BY id_peminjaman_buku DESC");
                        $no = 0;
                        while ($dt_histori = mysqli_fetch_array($qry_histori)) {
                            $no++;

                            // Memeriksa apakah kode buku cocok dengan kata kunci pencarian
                            if ($search != '' && strpos($dt_histori['kd_pinjam'], $search) !== false) {
                                $highlight_class = 'highlight'; // Menambahkan kelas CSS tambahan untuk menandai baris yang cocok
                            } else {
                                $highlight_class = ''; // Reset kelas CSS jika tidak ada yang cocok
                            }

                            // Anda dapat menggunakan kelas CSS 'highlight' untuk menyesuaikannya dengan desain Anda
    

                        //menampilkan buku yang dipinjam
                       
                        $qry_buku=mysqli_query($conn,"select * from peminjaman_buku join buku on buku.id_buku = peminjaman_buku.id_buku where id_peminjaman_buku = '".$dt_histori['id_peminjaman_buku']."'");
                        while($dt_buku=mysqli_fetch_array($qry_buku)){
                            $buku_dipinjam=$dt_buku['nama_buku'];
                        }
                        

                        //menampilkan status sudah kembali atau belum
                        $qry_cek_kembali=mysqli_query($conn,"select * from pengembalian_buku where id_peminjaman_buku = '".$dt_histori['id_peminjaman_buku']."'");
                        if(mysqli_num_rows($qry_cek_kembali)>0){
                            $dt_kembali=mysqli_fetch_array($qry_cek_kembali);
                            $denda="denda Rp. ".$dt_kembali['denda'];
                            $status_kembali="<label class='alert alert-success'>Sudah kembali <br>".$denda."</label>";
                            $button_kembali="";
                        } else {
                            $status_kembali="<label class='alert alert-danger'>Belum kembali</label>";
                            $button_kembali="<a href='kembali.php?id=".$dt_histori['id_peminjaman_buku']."' class='btn btn-warning' 
                            onclick='return confirm(\"Apakah Anda yakin ingin mengembalikan buku?\")'>Kembalikan</a>";
                        }
                    ?>
                    <tr class="<?= $highlight_class ?>">
        <td><?= $no ?></td>
        <td><?= $dt_histori['tanggal_pinjam'] ?></td>
        <td><?= $dt_histori['tanggal_kembali'] ?></td>
        <td><?= $dt_histori['kd_pinjam'] ?></td>
        <td><?= $buku_dipinjam ?></td>
        <td><?= $status_kembali ?></td>
        <td><?= $button_kembali ?></td>
    </tr>
<?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
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