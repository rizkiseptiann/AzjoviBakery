<h2>Data Pembelian</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
        <?php $nomor = 1; ?>
        <?php while ($pecah = $ambil -> fetch_assoc()) { ?>
        <tr>
            <td><?= $nomor; ?></td>
            <td><?= $pecah ['nama_pelanggan']; ?></td>
            <td><?= $pecah ['tanggal_pembelian']; ?></td>
            <td><?= $pecah ['status_pembelian']; ?></td>
            <td>Rp. <?= number_format($pecah ['total_pembelian']); ?></td>
            <td>
                <a href="index.php?halaman=detail&id=<?= $pecah['id_pembelian']; ?>" class="btn btn-info">Detail</a>

                <!-- jika pelanggan sudah melakukan pembayaran -->
                <?php if ($pecah['status_pembelian']!=="pending"): ?>
                    <a href="index.php?halaman=pembayaran&id=<?= $pecah['id_pembelian']; ?>" class="btn btn-success">Bukti Pembayaran</a>
                <?php endif ?>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>