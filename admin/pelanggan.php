<h2>Data Pelanggan</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Telepon Pelanggan</th>
            <!-- <th>Alamat Pelanggan</th> -->
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php $ambil = $koneksi->query("SELECT * FROM pelanggan") ?>
        <?php $nomor = 1; ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
        <tr>
            <td><?= $nomor; ?></td>
            <td><?= $pecah['username']; ?></td>
            <td><?= $pecah ['email_pelanggan']; ?></td>
            <td><?= $pecah ['nama_pelanggan']; ?></td>
            <td><?= $pecah ['telepon_pelanggan']; ?></td>
            <!-- <td><?= $pecah ['alamat_pelanggan']; ?></td> -->
            <td>
                <a href="index.php?halaman=hapus-pelanggan&id=<?= $pecah['id_pelanggan'];?>" class="btn btn-danger">Hapus</a>
                <a href="index.php?halaman=ubah-pelanggan&id=<?= $pecah['id_pelanggan'];?>" class="btn btn-warning">Ubah</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>
<a href="index.php?halaman=tambah-pelanggan" class="btn btn-success">Tambah Data Pelanggan</a>