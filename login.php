<?php
session_start();
require 'koneksi.php';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="coba.css" />
    <title>Login</title>

</head>
<body>



<!-- Form-->

    <div class="container">
    <form method="post" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" required>
			</div>
			<div class="input-group">
				<button class="btn" name="login">Login</button>
			</div>
			<p class="login-register-text">Belum Punya Akun? <a href="registration.php">Register Disini</a></p>
		</form>
    <?php
                                        // jika ada tombol login
                                        if (isset($_POST['login'])) {
                                            // ambil data
                                            $username = $_POST['username'];
                                            $password = $_POST['password'];
                                            // lakukan query untuk cek di tabel pelanggan
                                            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE username='$username'
                                            AND password_pelanggan='$password'");

                                            // hitung akun yang berhasil diambil
                                            $akuncocok = $ambil->num_rows;

                                            // jika ada 1 akun yang cocok
                                            if ($akuncocok == 1) {
                                                // berhasil login, lalu dapatkan akun dalam bentuk array
                                                $akuncocok = $ambil->fetch_assoc();
                                                // simpan di session pelanggan
                                                $_SESSION['pelanggan'] = $akuncocok;

                                                echo "<script>alert('login berhasil!');</script>";
                                                // jika sudah belanja
                                                if (isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])) {
                                                    echo "<script>location='checkout.php';</script>";
                                                } else {
                                                    echo "<script>location='riwayat.php';</script>";
                                                }

                                            } else {
                                                echo "<script>alert('username atau password salah!');</script>";
                                                echo "<script>location='login.php';</script>";
                                            }
                                        }
                                    ?>
    </div>
   
</body>
</html>