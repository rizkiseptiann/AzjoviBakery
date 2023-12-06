<?php
session_start();
// ambil id produk yang akan dihapus
$id_produk = $_GET['id'];
unset($_SESSION['keranjang'][$id_produk]);

// tampilkan pesan
echo "<script>alert('berhasil dihapus dari keranjang');</script>";
echo "<script>location='chart.php';</script>";

?>