<?php
session_start();

require "koneksi.php";

// ambil id
$id_pembelian = $_GET['id'];

// ambil data
$ambil = $koneksi->query("SELECT * FROM pembayaran 
    LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
    WHERE pembelian.id_pembelian='$id_pembelian'");
$detail_pembayaran = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detail_pembayaran);
// echo "</pre>";

// jika belum ada data pembayaran
if (empty($detail_pembayaran)) {
    echo "<script>alert('Belum ada data pembayaran!');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

// jika pelanggan yang bayar tidak sesuai
if ($_SESSION["pelanggan"]["id_pelanggan"]!==$detail_pembayaran["id_pelanggan"]) {
    echo "<script>alert('Data ini Bukan milik anda!');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pembayaran</title>
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
    <div class=" mt-3  grid gap-2">
    <div class=" mb-5  grid gap-2">
    <div class="container">
        <h1>Lihat Pembayaran</h1>
        <div class="row">
            <div class="col-md-6">
                <table class=table>
                    <tr>
                        <th>Nama</th>
                        <td><?= $detail_pembayaran['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <td><?= $detail_pembayaran['bank']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= $detail_pembayaran['tanggal']; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>Rp. <?= number_format($detail_pembayaran['jumlah']); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <img src="bukti_pembayaran/<?= $detail_pembayaran['bukti']; ?>" class="img-responsive" width ="500" height ="300">
            </div>
        </div>
    </div>
</div>
</div>

    <section id="about">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-3 logo">
        <h5>Azjovi Cake & Bakery</h5>
        <ul>
          <li>
          <img src="azjov.png" alt="logo" alt="" style="width:150px;height:150px;">
          </li>
        </ul>
      </div>
      <div class="col-xs-12 col-sm-4 alamat">
        <h5>Alamat:</h5>
        <p>Pup Sektor V Blok P13/15, Rt/Rw 005 / 028 Kel.Bahagia Kec.Babelan</p>
        <h5>Kontak Kami: <a href="https://wa.me/6281555820198">+62 815-5582-0198</a></h5>
      </div>
      <div class="col-xs-12 col-sm-5 info">
        <h5>Toko Kue Terbaik Yang Kami Miliki</h5>
        <p>Toko Kue Terbaik Yang Kami Miliki Azjovi Menyediakan produk aneka kue,dengan berbagai jenis kue khas Indonesia yang tersedia dengan harga sangat terjangkau dan rasa yang lezat, keunggulan cita rasa yang kami buat dengan bahan-bahan kualitas terbaik dan diolah dengan mempertimbangkan suhu,takaran adonan,rasa dan aroma.</p>
      </div>
    </div>
  </div>
  </section>
</body>
</html>