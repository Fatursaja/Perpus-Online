<?php
include "koneksi.php"; // Sertakan file koneksi.php untuk menghubungkan ke database

// Query untuk mendapatkan data histori peminjaman buku
$qry_histori = mysqli_query($conn, "SELECT * FROM peminjaman_buku ORDER BY id_peminjaman_buku DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Buku</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: orange;
        }
    </style>
</head>

<body onload="window.print(); redirectToLaporan()"> <!-- Panggil fungsi pencetakan dan redirect setelah pencetakan selesai -->
    <h2>Laporan Peminjaman Buku</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Kode Pinjam</th>
                <th>Judul Buku</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            while ($dt_histori = mysqli_fetch_array($qry_histori)) {
                $no++;

                //menampilkan buku yang dipinjam
                $buku_dipinjam = "";
                $qry_buku = mysqli_query($conn, "select * from detail_peminjaman_buku join buku on buku.id_buku = detail_peminjaman_buku.id_buku where id_peminjaman_buku = '" . $dt_histori['id_peminjaman_buku'] . "'");
                while ($dt_buku = mysqli_fetch_array($qry_buku)) {
                    $buku_dipinjam .= $dt_buku['nama_buku'] . "<br>";
                }

                //menampilkan status sudah kembali atau belum
                $qry_cek_kembali = mysqli_query($conn, "select * from pengembalian_buku where id_peminjaman_buku = '" . $dt_histori['id_peminjaman_buku'] . "'");
                if (mysqli_num_rows($qry_cek_kembali) > 0) {
                    $dt_kembali = mysqli_fetch_array($qry_cek_kembali);
                    $denda = "denda Rp. " . $dt_kembali['denda'];
                    $status_kembali = "Sudah kembali <br>" . $denda;
                } else {
                    $status_kembali = "Belum kembali";
                }
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $dt_histori['tanggal_pinjam'] ?></td>
                    <td><?= $dt_histori['tanggal_kembali'] ?></td>
                    <td><?= $dt_histori['kd_pinjam'] ?></td>
                    <td><?= $buku_dipinjam ?></td>
                    <td><?= $status_kembali ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        // Fungsi untuk memulai pencetakan dan menangani peristiwa sebelum pencetakan dimulai
        function startPrinting() {
            window.print(); // Mulai pencetakan
            redirectToLaporan(); // Panggil fungsi untuk mengarahkan kembali ke halaman laporan setelah pencetakan
        }

        // Fungsi untuk mengarahkan kembali ke halaman laporan
        function redirectToLaporan() {
            setTimeout(function() {
                window.location.href = 'histori_peminjaman.php'; // Redirect ke halaman laporan
            }, 1000); // Waktu delay sebelum redirect (dalam milidetik)
        }

        // Event listener untuk menangani peristiwa sebelum pencetakan dimulai
        window.onbeforeprint = function(event) {
            startPrinting(); // Panggil fungsi untuk memulai pencetakan
        };
    </script>
</body>

</html>
