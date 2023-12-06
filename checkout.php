<?php
session_start();
require 'koneksi.php';

// mengatasi pelanggan yang nakal atau tidak ada session pelanggan
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Anda Harus Login!');</script>";
    echo "<script>location='login.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Checkout</title>
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

<!-- <pre>
    <?php print_r($_SESSION['pelanggan']); ?>
</pre> -->

<section class="konten">
    <div class="container">
        <h1>Chart</h1>
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Sub Harga</th>
                </tr>
            </thead>

            <tbody>
            <?php $nomor = 0; ?>
            <?php $totalBelanja = 0; ?>
            <?php foreach ($_SESSION ['keranjang'] as $id_produk => $jumlah): ?>
            <!-- menampikan produk berdasarkan id produk -->
            <?php
            $ambil = $koneksi->query("SELECT *FROM produk WHERE
                id_produk = '$id_produk'");
            $pecah = $ambil->fetch_assoc();
            $subHarga = $pecah['harga_produk'] * $jumlah;
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
                </tr>
            <?php $nomor++; ?>
            <?php $totalBelanja += $subHarga; ?>
            <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total Belanja</th>
                    <th>Rp. <?= number_format($totalBelanja); ?></th>
                </tr>
            </tfoot>
        </table>

        <form action="" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly class="form-control" value="<?= $_SESSION['pelanggan']['nama_pelanggan']; ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                    <input type="text" readonly class="form-control" value="<?= $_SESSION['pelanggan']['telepon_pelanggan']; ?>">
                    </div>
                </div>
                    
                <div class="col-md-4">
                    <select name="id_ongkir" class="form-control">
                        <option value="">Pilih Ongkir</option>
                        <?php
                        $ambil = $koneksi->query("SELECT * FROM ongkir");
                        while($perongkir = $ambil->fetch_assoc()) {
                        ?>
                        <option value="<?= $perongkir['id_ongkir'] ?>">
                            <?= $perongkir['nama_kota']; ?> -
                            Rp. <?= number_format($perongkir['tarif']); ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class=" mb-3  grid gap-2">
            <div class="form-group">
                <div class=" mb-3  grid gap-2">
                <label>Alamat Tujuan</label>
                <textarea name="alamat_pengiriman" class="form-control" placeholder="Masukan alamat lengkap tujuan pengiriman" required></textarea>
                        </div>
            </div>
            <div class=" mb-5  grid gap-2">
            <button class="btn btn-primary" name="checkout">Checkout</button>
                        </div>
        </form>

        <?php
        if(isset($_POST['checkout'])) {
           $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
           $id_ongkir = $_POST['id_ongkir'];
           $tanggal_pembelian = date("Y-m-d");
           $alamatPengiriman = $_POST['alamat_pengiriman'];

           $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
           $arrayongkir = $ambil->fetch_assoc();
           $namaKota = $arrayongkir['nama_kota'];
           $tarif = $arrayongkir['tarif'];

           $totalPembelian = $totalBelanja + $tarif;

            // menyimpan data ke tabel pembelian
            $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$totalPembelian','$namaKota','$tarif','$alamatPengiriman')");

            // mendapatkan id pembelian yang baru saja checkout
            $id_pembelian_baru = $koneksi->insert_id;

            foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
                // mendapatkan data produk berdasarkan id_produk
                $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                $perProduk = $ambil->fetch_assoc();

                $nama = $perProduk['nama_produk'];
                $harga = $perProduk['harga_produk'];
                $berat = $perProduk['berat'];

                $subBerat = $perProduk['berat'] * $jumlah;
                $subHarga = $perProduk['harga_produk'] * $jumlah;

                $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
                VALUES ('$id_pembelian_baru','$id_produk','$nama', '$harga', '$berat', '$subBerat', '$subHarga', '$jumlah')");


                // update stok produk
                $koneksi->query("UPDATE produk SET stok_produk = stok_produk -$jumlah
                WHERE id_produk = '$id_produk'");
            }

            // jika pembelian berhasil maka harus mengkosongkan keranjang
            unset($_SESSION["keranjang"]);

            // redirect ke halaman nota
            echo "<script>alert('pembelian sukses');</script>";
            echo "<script>location='nota.php?id=$id_pembelian_baru';</script>";
        }
        ?>

    </div>
</section>
<!-- <pre><?php print_r($_SESSION['keranjang']); ?></pre> -->
<!-- <pre><?php print_r($_SESSION['pelanggan']); ?></pre> -->

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