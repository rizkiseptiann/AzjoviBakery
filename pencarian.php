<?php require "koneksi.php"; ?>
<?php
$keyword = $_GET["keyword"];

$semuaData = array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' 
    OR deskripsi_produk LIKE '%$keyword%'");
while($pecah = $ambil->fetch_assoc()) {
    $semuaData[] = $pecah;
}

// echo "<pre>";
// print_r($semuaData);
// echo "</pre>";
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

<?php require "nav.php"; ?>

<div class="container">
<div class=" mt-5  grid gap-2">
    <h3>Hasil Pencarian : <?= $keyword ?></h3>

    <?php if (empty($semuaData)): ?>
        <div class="alert alert-danger">
            <strong>Produk dengan nama <?= $keyword ?> tidak ditemukan</strong>
        </div>
    <?php endif ?>

    <div class="row">

    <?php foreach($semuaData as $key => $value): ?>
      <div class=" mb-5  grid gap-2">
        <div class="col-md-3">
            <div class="thumbnail">
                <img src="foto_produk/<?= $value['foto_produk']; ?>" class="img-responsive" alt="">
                <div class="caption">
                    <h3><?= $value['nama_produk']; ?></h3>
                    <h5>Rp. <?= number_format($value['harga_produk']); ?></h5>
                    <a href="beli.php?id=<?= $value['id_produk']; ?>" class="btn btn-primary">Beli</a>
                    <a href="detail.php?id=<?= $value['id_produk']; ?>" class="btn btn-success">Detail</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php endforeach ?>
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
    
</body>
</html>