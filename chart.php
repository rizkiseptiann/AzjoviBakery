<?php
session_start();

// echo "<pre>";
//     print_r($_SESSION ['keranjang']);
// echo "</pre>";
require 'koneksi.php';

// jika keranjang kosong langsung redirect ke halaman belanja
if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])) {
    echo "<script>alert('Upss, keranjang kosong!');</script>";
    echo "<script>location='index.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Keranjang</title>
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

<section class="konten">
    <div class="container mt-3">
        <h1>Keranjang</h1>
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Sub Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php $nomor = 1; ?>
            <?php foreach ($_SESSION ['keranjang'] as $id_produk => $jumlah): ?>
            <!-- menampikan produk berdasarkan id produk -->
            <?php
            $ambil = $koneksi->query("SELECT *FROM produk WHERE id_produk = '$id_produk'");
            $pecah = $ambil->fetch_assoc();
           if (is_numeric($pecah['harga_produk']) && is_numeric($jumlah)) {
              $subHarga = $pecah['harga_produk'] * $jumlah;
          } else {
              // Handle jika salah satu atau kedua variabel bukan numerik
              $subHarga = 0; // Atau atur nilai default yang sesuai
          }
            // echo "<pre>";
            // print_r($pecah);
            // echo "</pre>";
            ?>
                <tr>
                    <td><?= $nomor; ?></td>
                    <td><?= $pecah['nama_produk']; ?></td>
                    <td>Rp. <?= number_format( $pecah['harga_produk'] ); ?></td>
                    <td><?= $jumlah; ?></td>
                    <td>Rp. <?= number_format( $subHarga ); ?></td>
                    <td>
                        <a href="hapus-chart.php?id=<?= $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
                    </td>
                </tr>
            <?php $nomor++; ?>
            <?php endforeach ?>
            </tbody>
        </table>
        
        <div class=" mb-5  grid gap-2">
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
        <a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
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
