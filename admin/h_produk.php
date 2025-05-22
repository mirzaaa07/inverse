<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Cek apakah produk memiliki gambar
    $query = mysqli_query($koneksi, "SELECT gambar FROM tb_produk WHERE id_produk ='$id_produk'");
    $data = mysqli_fetch_array($query);

    if ($data) {
        $gambar = $data['gambar'];
        $dir = "produk_img/";

        //hapus gambar jika ada
        if ($gambar && file_exists($dir . $gambar)) {
            unlink($dir . $gambar);
        }

        //hapus produk dari database
        $delete = mysqli_query($koneksi, "DELETE FROM tb_produk WHERE id_produk ='$id_produk'");

        if ($delete) {
            echo "<script>alert('produk berhasil dihapus!');</script>";
            header("refresh:0 , produk.php");
        } else {
            echo "<script>alert('produk gagal dihapus!');</script>";
            header("refresh:0 , produk.php");
        }
    } else {
        echo "<script>alert('produk tidak ditemukan!');</script>";
        header("refresh:0 , produk.php");
    }
} else {
    echo "<script>alert('Akses tidak valid!');</script>";
    header("refresh:0 , produk.php");
}
?>