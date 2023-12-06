<h2>Tambah Data Pelanggan</h2> <br>

<form method="post">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" name="email">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" name="password">
    </div>

    <div class="form-group">
        <label>Telepon</label>
        <input type="number" class="form-control" name="telepon">
    </div>

    <button class="btn btn-primary" name="save">Simpan</button>
</form>

<?php
if (isset($_POST['save'])) {
    $koneksi->query("INSERT INTO pelanggan
        (nama_pelanggan, email_pelanggan, password_pelanggan, telepon_pelanggan)
        VALUES('$_POST[nama]', '$_POST[email]', '$_POST[password]', '$_POST[telepon]')");

    echo "<script>alert('Data Pelanggan Berhasil Disimpan');</script>";
    echo "<script>location='index.php?halaman=pelanggan';</script>";
}
?>