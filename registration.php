<?php
require 'koneksi.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Pelanggan</title>
    <link rel="stylesheet" href="coba.css" />

</head>
<body>

<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email"  required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Nama Lengkap" name="nama"  required>
			</div>
            <div class="input-group">
                <input type="number" placeholder="Telepon" name="telepon"  required>
			</div>
			<div class="input-group">
				<button name="daftar" class="btn">Daftar</button>
			</div>
			<p class="login-register-text">Sudah Punya Akun? <a href="login.php">Login Disini</a>.</p>
		</form>
                                    <!-- script php -->
                                    <?php
                                        if (isset($_POST['daftar'])) {
                                            // mengambil value nama, emali, password, alamat, telepon
                                            $username = $_POST['username'];
                                            $email = $_POST['email'];
                                            $password = $_POST['password'];
                                            $nama = $_POST['nama'];
                                            $telepon = $_POST['telepon'];
                                            // $alamat = $_POST['alamat'];

                                            // lakukan perintah query
                                            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE username = '$username'");
                                            $usernamecocok = $ambil->num_rows;

                                            // cek jika email sudah ada yang menggunakan
                                            if ($usernamecocok == 1) {
                                                echo "<script>alert('username sudah digunakan');</script>";
                                                echo "<script>location='registeration.php';</script>";
                                            } else {
                                                // jika berhasil, lakukan insert ke tabel pelanggan
                                                $koneksi->query("INSERT INTO pelanggan(username, email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, alamat_pelanggan)
                                                VALUES('$username', '$email', '$password', '$nama', '$telepon', '$alamat')");

                                                echo "<script>alert('Pendaftaran Berhasil');</script>";
                                                echo "<script>location='login.php';</script>";
                                            }
                                        }
                                    ?>
                                    <!-- Akhir -->
                            </div>
                        </div>
                    </div>
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
