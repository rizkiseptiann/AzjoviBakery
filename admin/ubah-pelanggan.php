<h2>Ubah Data Pelanggan</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post">
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= $pecah['username']; ?>">
    </div>

    <div class="form-group">
        <label>Nama Pelanggan</label>
        <input type="text" name="nama" class="form-control" value="<?= $pecah['nama_pelanggan']; ?>">
    </div>

    <div class="form-group">
        <label>Email Pelanggan</label>
        <input type="text" name="email" class="form-control" value="<?= $pecah['email_pelanggan']; ?>">
    </div>

    <div class="form-group">
        <label>Password Pelanggan</label>
        <input type="text" name="password" class="form-control" value="<?= $pecah['password_pelanggan']; ?>">
    </div>

    <div class="form-group">
        <label>Telepon Pelanggan</label>
        <input type="number" name="telepon" class="form-control" value="<?= $pecah['telepon_pelanggan']; ?>">
    </div>

    <div class="form">
        <label>Alamat Lengkap</label>
        <textarea name="alamat" class="form-control"><?= $pecah['alamat_pelanggan']; ?></textarea>
    </div>

    <button class="btn btn-primary" name="ubah">Simpan</button>
</form>

<?php
if ( isset($_POST['ubah']) ) {
    $koneksi->query("UPDATE pelanggan SET username='$_POST[username]', nama_pelanggan='$_POST[nama]',
        email_pelanggan='$_POST[email]', password_pelanggan='$_POST[password]',
        telepon_pelanggan='$_POST[telepon]', alamat_pelanggan='$_POST[alamat]' WHERE id_pelanggan='$_GET[id]'");

    echo "<script>alert('Data berhasil diubah!');</script>";
    echo "<script>location='index.php?halaman=pelanggan';</script>";   
}
?>