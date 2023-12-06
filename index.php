<?php
session_start();
require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Azjovi Bakery</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    
    <link rel="stylesheet" href="style.css" />

  </head>
  <body>
    <!-- Navbar -->
  <?php require "nav.php"; ?>

  <!-- Isi -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>

    <section class="isi">
    <div class="container">
        <div class="row">

        <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
        <?php while ($perproduk = $ambil->fetch_assoc()) { ?>
            <div class="col-md-4 mb-3">
            <div class="card border-warning h-100">
                    <img src="foto_produk/<?= $perproduk['foto_produk']; ?>" alt="" class="card-img-top kue">
                    <div class="card-body">
                        <p class= "fs-3 mb-1 fw-semibold"><?= $perproduk['nama_produk']; ?></p>
                        <p class= "fs-5">Rp. <?= number_format($perproduk ['harga_produk']); ?></p>

                        <div class="grid gap-2 d-flex justify-content-end">
                        <a href="beli.php?id=<?= $perproduk['id_produk']; ?>" class="btn btn-primary btn-lg">Beli</a>
                        <a href="detail.php?id=<?= $perproduk['id_produk']; ?>" class="btn btn-success btn-lg">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        </div>
    </div>
</section>

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