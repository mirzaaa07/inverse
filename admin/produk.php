<?php
session_start(); // Memulai sesi
include "koneksi.php"; // Menyertakan file koneksi database

// Cek apakah sudah login
if (!isset($_SESSION["login"])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit; // Menghentikan script
}

// Cek apakah status tersedia dan pastikan user adalah admin
if (!isset($_SESSION["status"]) || $_SESSION["status"] !== "admin") {
    echo "<script>
        alert('Akses ditolak! Halaman ini hanya untuk Admin.');
        window.location.href='login.php'; // Arahkan ke halaman login
    </script>";
    exit; // Menghentikan script
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Produk - inverse</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/AAA.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/AAA.png" alt="">
                <span class="d-none d-lg-block">inverse</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="GET" action="">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/meme.jpg" alt="Profile" class="rounded-circle">
                        <!-- profile-img.jpg diganti dengan foto kalian -->
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo isset($_SESSION['username']) ? htmlspecialchars(($_SESSION['username'])) : 'Guest'; ?></h6>
                            <span>Admin</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Beranda</span>
                </a>
            </li><!-- End Beranda Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" href="kategori.php">
                    <i class="bi bi-alexa"></i>
                    <span>Kategori Produk</span>
                </a>
            </li><!-- End kategori Page Nav -->

            <li class="nav-item">
                <a class="nav-link" href="produk.php">
                    <i class="bi bi-bag"></i>
                    <span>Produk</span>
                </a>
            </li><!-- End produk Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="keranjang.php">
                    <i class="bi bi-bag-plus"></i>
                    <span>Keranjang</span>
                </a>
            </li><!-- End keranjang Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="transaksi.php">
                    <i class="bi bi-card-list"></i>
                    <span>Transaksi</span>
                </a>
            </li><!-- End transaksi Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="laporan.php">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Laporan</span>
                </a>
            </li><!-- End laporan Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pengguna.php">
                    <i class="bi bi-dash-circle"></i>
                    <span>Pengguna</span>
                </a>
            </li><!-- End pengguna Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Produk</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Produk</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href="t_produk.php" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-lg"></i> Tambah Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table table-striped mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Nama Kategori</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "koneksi.php";
                                    $no = 1;

                                    // Ambil keyword pencarian dari GET
                                    $query = isset($_GET['query']) ? mysqli_real_escape_string($koneksi, $_GET['query']) : '';

                                    // Tambahkan WHERE jia query tidak kososng
                                    $sql_query = "SELECT tb_produk.*, tb_kategori.nm_kategori FROM tb_produk LEFT JOIN tb_kategori ON tb_produk.id_kategori = tb_kategori.id_kategori";

                                    if (!empty($query)) {
                                        $sql_query .= "WHERE tb_produk.nm_produk LIKE '%$query%' OR tb_kategori.nm_kategori LIKE '%$query%' OR tb_produk.desk LIKE '%$query%'";
                                    }

                                    $sql = mysqli_query($koneksi, $sql_query);

                                    if (mysqli_num_rows($sql) > 0) {
                                        while ($hasil = mysqli_fetch_array($sql)) {
                                    ?>

                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $hasil['nm_produk']; ?></td>
                                                <td>Rp <?php echo number_format($hasil['harga'], 0, ',', '.'); ?></td>
                                                <td><?php echo $hasil['stok']; ?></td>
                                                <td><?php echo $hasil['desk']; ?></td>
                                                <td><?php echo $hasil['nm_kategori']; ?></td>
                                                <td>
                                                    <?php if (!empty($hasil['gambar'])) { ?>
                                                        <img src="produk_img/<?php echo $hasil['gambar']; ?>" width="100">
                                                    <?php } else { ?>
                                                        Tidak ada gambar
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="e_produk.php?id=<?php echo $hasil['id_produk']; ?>" class="btn btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="h_produk.php?id=<?php echo $hasil['id_produk']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="8" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>inverse</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href=https://www.instagram.com/mirzaaa.i/"
                target="_blank">mirzaaa</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>