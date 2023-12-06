<h2>Data Produk</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Foto</th>
            <th>Deskripsi Produk</th>
            <th>Stok Produk</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
        <?php $nomor = 1; ?>
        <?php while ($pecah = $ambil -> fetch_assoc()) { ?>
        <tr>
            <td><?= $nomor; ?></td>
            <td><?= $pecah ['nama_produk']; ?></td>
            <td><?= $pecah ['harga_produk']; ?></td>
            <td><?= $pecah ['berat']; ?></td>
            <td>
                <img src="../foto_produk/<?= $pecah ['foto_produk']; ?>" width="100">
            </td>
            <td><?= $pecah ['deskripsi_produk']; ?></td>
            <td><?= $pecah ['stok_produk']; ?></td>
            <td>
                <a href="index.php?halaman=hapus-produk&id=<?= $pecah['id_produk']; ?>" class="btn btn-danger">Hapus</a>
                <a href="index.php?halaman=ubah-produk&id=<?= $pecah['id_produk']; ?>" class="btn btn-warning">Ubah</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>

<a href="index.php?halaman=tambah-produk" class="btn btn-success">Tambah Produk</a>