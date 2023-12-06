<?php
$tanggalMulai = "-";
$tanggalSelesai = "-";
$semuaData = array();
if (isset($_POST['kirim'])) {
    $tanggalMulai = $_POST["tglm"];
    $tanggalSelesai = $_POST["tgls"];
    $ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON 
        pm.id_pelanggan=pl.id_pelanggan WHERE tanggal_pembelian BETWEEN '$tanggalMulai' AND '$tanggalSelesai'");
    while($pecah = $ambil->fetch_assoc())
    {
        $semuaData[] = $pecah;
    }

    // echo "<pre>";
    // print_r($semuaData);
    // echo "</pre>";
}
?>



<h2>Laporan Pembelian <?= $tanggalMulai ?> Hingga <?= $tanggalSelesai ?></h2>
<br>

<form action="" method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" class="form-control" name="tglm" value="<?= $tanggalMulai ?>">
            </div>
        </div>
        <div class="col-md-5">
            <label>Tanggal Selesai</label>
            <input type="date" class="form-control" name="tgls" value="<?= $tanggalSelesai ?>">
        </div>
        <div class="col-md-2">
            <br>
            <button class="btn btn-primary" name="kirim">Lihat</button>
        </div>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach($semuaData as $key => $value): ?>
        <?php $total += $value['total_pembelian']; ?>
        <tr>
            <td><?= $key+1; ?></td>
            <td><?= $value['nama_pelanggan']; ?></td>
            <td><?= $value['tanggal_pembelian']; ?></td>
            <td><?= $value['status_pembelian']; ?></td>
            <td>Rp. <?= number_format($value['total_pembelian']); ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total</th>
            <th>Rp. <?= number_format($total); ?></th>
        </tr>
    </tfoot>
</table>