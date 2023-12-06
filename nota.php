<?php
session_start();
require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nota</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    
    <link rel="stylesheet" href="style.css" />

  </head>
  <body>

<!-- navbar -->
<?php require "nav.php"; ?>
<!-- akhir navbar -->

<!-- section -->
<section class="konten">
    <div class=" mt-5  grid gap-2">
    <div class="container">

    <h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<!-- <pre><?php print_r($detail); ?></pre> -->

<!-- jika pelanggan yang beli tidak sama dengan yang login -->
<?php 
// mendapatkan id pelanggan yang beli
$id_pelanggan_beli = $detail["id_pelanggan"];

// mendapatkan id pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_beli !== $id_pelanggan_login) {
    // larikan ke riwayat.php
    echo "<script>alert('Gagal ! silahkan cek kembali');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
        <strong>No. Pembelian <?= $detail['id_pembelian']; ?></strong> <br>
        Tanggal : <?= $detail['tanggal_pembelian']; ?> <br>
        Total : Rp. <?= number_format($detail['total_pembelian']); ?>
    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong>Nama : <?php echo $detail['nama_pelanggan']; ?></strong> <br>
        <p>
            Telepon : <?= $detail['telepon_pelanggan']; ?> <br>
            Email : <?= $detail['email_pelanggan']; ?>
        </p>
    </div>
    <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong>Tujuan : <?= $detail['nama_kota']; ?></strong> <br>
        Biaya Pengiriman : Rp. <?= number_format($detail['tarif']); ?> <br>
        Alamat Tujuan : <?= $detail['alamat_pengiriman']; ?>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Jumlah</th>
            <th>Sub Berat</th>
            <th>Sub Total</th>
        </tr>
    </thead>

    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
        <?php while($pecah=$ambil->fetch_assoc()) { ?>
        <tr>
            <td><?= $nomor; ?></td>
            <td><?= $pecah['nama']; ?></td>
            <td>Rp <?= number_format($pecah['harga']); ?></td>
            <td><?= $pecah['berat']; ?> (Gr)</td>
            <td><?= $pecah['jumlah']; ?></td>
            <td><?= $pecah['subberat']; ?> (Gr)</td>
            <td>Rp. <?= number_format($pecah['subharga']); ?></td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>

<div class="row">
    <div class="col-md-7">
        <div class="alert alert-info">   
            <p>
                Silahkan melakukan pembayaran sebesar Rp. <?= number_format($detail['total_pembelian']); ?> ke <br>
                <strong>BANK BCA 5681359975 AN. Azarya Artha Gabriel Lubis</strong>
            </p>
        </div>
    </div>

    
</div>

    </div>
</section>

<!-- akhir section -->
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