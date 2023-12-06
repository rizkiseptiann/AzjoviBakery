<?php 
session_start();

require "koneksi.php";

// jika tidak ada session pelanggan
if  (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan Login !');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// mendapatkan id_pembelian dari url
$idpem = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$idpem'");
$detpem = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detpem);
// echo "</pre>";

// mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
// mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !== $id_pelanggan_beli) {
    echo "<script>alert('Data Anda Tidak Sesuai !');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Konfirmasi Pembayaran</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    
    <link rel="stylesheet" href="style.css" />

  </head>
  <body>
    
<?php require "nav.php"; ?>

<div class="container">
<div class=" m-5  grid gap-2">
    <h2>Konfirmasi Pembayaran</h2>
    <p>Kirim Bukti Pembayaran Anda Disini</p>

    <div class="alert alert-danger">Total tagihan anda sebesar <strong>Rp. <?= number_format($detpem['total_pembelian']); ?></strong></div>

    <form enctype="multipart/form-data" method="post">
        <div class="form-group">
            <label>Nama Penyetor</label>
            <input type="text" name="nama" class="form-control">
        </div>
        <div class="form-group">
            <label>Nama Bank</label>
            <input type="text" name="bank" class="form-control">
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" min="1">
        </div>
        <div class="form-group">
            <label>Upload Bukti Pembayaran</label>
            <input type="file" name="bukti" class="form-control">
            <p class="text-danger">Maksimal 1MB</p>
        </div>
        <div class=" mb-5  grid gap-2">
        <button class="btn btn-primary" name="kirim">Kirim Pembayaran</button>
</div>
    </form>
</div>

<?php
// jika ada tombol kirim
if (isset($_POST['kirim'])) {
    // upload foto bukti pembayaran
    $namaBukti = $_FILES["bukti"]["name"];
    $lokasiBukti = $_FILES["bukti"]["tmp_name"];
    $namaFiks = date("YmdHis").$namaBukti;
    move_uploaded_file($lokasiBukti, "bukti_pembayaran/$namaFiks");

    $nama = $_POST['nama'];
    $bank = $_POST['bank'];
    $jumlah = $_POST['jumlah'];
    $tanggal = date("Y-m-d");

    // simpan bukti pembayaran ke tabel pembayaran
    $koneksi->query("INSERT INTO pembayaran(
        id_pembelian,nama,bank,jumlah,tanggal,bukti)
        VALUES('$idpem', '$nama', '$bank', '$jumlah', '$tanggal', '$namaFiks')");

    // update data pembayaran
    $koneksi->query("UPDATE pembelian SET status_pembelian = 'bukti pembayaran berhasil terkirim'
        WHERE id_pembelian = '$idpem'");

        echo "<script>alert('Pembayaran Berhasil !');</script>";
        echo "<script>location='riwayat.php';</script>";
}
?>


</body>
</html>