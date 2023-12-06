<?php
session_start();
require "koneksi.php";

// jika tidak ada session pelanggan
if  (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan Login !');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Riwayat Belanja</title>
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

<!-- section -->
<!-- <pre><?php print_r($_SESSION) ?></pre> -->
<section class="riwayat">
    <div class="container">
        <h2>Riwayat Belanja</h2> <br>

        <h4>Nama Pembeli : <?= $_SESSION['pelanggan']['nama_pelanggan']; ?></h4>
        <div class=" mb-5  grid gap-2">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Opsi</th>
                </tr>
            </thead>

            <tbody>
                <?php $nomor = 1; ?>
                <?php
                // mendapatkan id_pelanggan yang login dari session
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

                $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'");
                while($pecah = $ambil->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $nomor; ?></td>
                    <td><?= $pecah['tanggal_pembelian']; ?></td>
                    <td>
                        <?= $pecah['status_pembelian']; ?> <br>
                        <?php if (!empty($pecah['resi_pengiriman'])): ?>
                        Resi : <?= $pecah['resi_pengiriman']; ?>
                        <?php endif ?>
                    </td>
                    <td>Rp. <?= number_format($pecah['total_pembelian']); ?></td>
                    <td>
                        <a href="nota.php?id=<?= $pecah['id_pembelian']; ?>" class="btn btn-info">Nota</a>

                        <?php if ($pecah['status_pembelian']=="pending") :?>
                        <a href="pembayaran.php?id=<?= $pecah["id_pembelian"]; ?>" class="btn btn-success">Pembayaran</a>
                        <?php else: ?>
                        <a href="lihat-pembayaran.php?id=<?= $pecah['id_pembelian']; ?>" class="btn btn-warning">Lihat Pembayaran</a>
                        <?php endif ?>
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
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
</body>
</html>