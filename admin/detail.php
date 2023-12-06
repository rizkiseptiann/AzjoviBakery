<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<!-- <pre><?php print_r($detail); ?></pre> -->

<strong>Nama : <?php echo $detail['nama_pelanggan']; ?></strong> <br>
<p>
    <strong>Telepon : <?= $detail['telepon_pelanggan']; ?></strong> <br>
    <strong>Email : <?= $detail['email_pelanggan']; ?></strong>
</p>
<p>
    <strong>tanggal : <?= $detail['tanggal_pembelian']; ?></strong> <br>
    <strong>Total : <?= number_format($detail['total_pembelian']); ?></strong>
</p>
<p>
    <strong>Biaya Pengiriman : Rp. <?= number_format($detail['tarif']); ?></strong> <br>
    <strong>Alamat Tujuan : <?= $detail['alamat_pengiriman']; ?></strong>
</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Sub Total</th>
        </tr>
    </thead>

    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
        <?php while($pecah=$ambil->fetch_assoc()) { ?>
        <tr>
            <td><?= $nomor; ?></td>
            <td><?= $pecah['nama_produk']; ?></td>
            <td>Rp <?= number_format($pecah['harga_produk']); ?></td>
            <td><?= $pecah['jumlah']; ?></td>
            <td>
                Rp <?= number_format($pecah['harga_produk'] * $pecah['jumlah']); ?>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>