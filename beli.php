<?php
session_start();
// mendapatkan id produk berdasarkan url
$id_produk =  $_GET['id'];

// jika sudah ada di keranjang, maka nilainya +1
if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] +=1;
} else {
    // jika belum ada, maka nilainya 1
    $_SESSION['keranjang'][$id_produk] = 1;
}

// echo "<pre>";
//     print_r($_SESSION);
// echo "</pre>"


// direct ke halaman keranjang
echo "<script>alert('produk berhasil ditambahkan');</script>";
echo "<script>location='chart.php';</script>";

?>