<?php session_start(); ?>
<?php
require 'koneksi.php';

// mendapatkan id produk berdasarkan url
$id_produk = $_GET['id'];

// ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detail);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail</title>
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
<div class=" mt-5  grid gap-2">
<div class=" mb-5  grid gap-2">
<section class="konten">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="foto_produk/<?= $detail['foto_produk']; ?>" class="img-responsive" alt="" width ="500" height ="300">
            </div>
            <div class="col-md-6">
                <h2><?= $detail['nama_produk']; ?></h2>
                <h4>Rp. <?= number_format($detail['harga_produk']); ?></h4>

                <h5>Stok : <?= $detail['stok_produk']; ?></h5>

                <form action="" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" min="1" class="form-control" name="jumlah" max="<?= $detail['stok_produk']; ?>">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" name="beli">Beli</button>
                            </div>
                        </div>
                    </div>
                </form>

                <?php
                // jika ada tombol beli
                if(isset($_POST['beli'])) {
                    // mendapatkan jumlah yang di input
                    $jumlah = $_POST['jumlah'];
                    // masukan ke dalam keranjang
                    $_SESSION['keranjang'][$id_produk] = $jumlah;

                    echo "<script>alert('Produk berhasil ditambahkan!');</script>";
                    echo "<script>location='chart.php';</script>";
                }
                ?>

                <p><?= $detail['deskripsi_produk']; ?></p>
            </div>
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