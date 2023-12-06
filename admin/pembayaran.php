<h2>Nota Pembayaran Pelanggan</h2>

<?php
// mendapatkan id_pembelian dari url
$id_pembelian = $_GET['id'];

// ambil data pembayaran berdasarkan id_pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
$detail = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detail);
// echo "</pre>";

?>

<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Nama</th>
                <td><?= $detail['nama']; ?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?= $detail['bank']; ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp. <?= number_format($detail['jumlah']); ?></td>
            </tr>
            <tr>
                <th>Tanggal Pembayaran</th>
                <td><?= $detail['tanggal']; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../bukti_pembayaran/<?= $detail['bukti']; ?>" class="img-responsive">
    </div>
</div>

<form action="" method="post">
    <div class="form-group">
        <label>No Resi Pengiriman</label>
        <input type="text" class="form-control" name="resi">
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="">Pilih Status</option>
            <option value="lunas">Lunas</option>
            <option value="dikirim">Dikirim</option>
            <option value="batal">Batal</option>
            <option value="selesai">Selesai</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php
if (isset($_POST['proses'])) {
    $resi = $_POST['resi'];
    $status = $_POST['status'];

    $koneksi->query("UPDATE pembelian SET resi_pengiriman = '$resi', status_pembelian = '$status'
        WHERE id_pembelian = '$id_pembelian'");

        echo "<script>alert('Data berhasil di update');</script>";
        echo "<script>location='index.php?halaman=pembelian';</script>";
}
?>