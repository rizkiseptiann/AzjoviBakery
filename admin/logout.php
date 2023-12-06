<?php
// hancurkan sesi login
session_destroy();
// tampilkan alert
echo "<script>alert('Logout Berhasil !');</script>";
// redirect ke halaman login
echo "<script>location='login.php';</script>";
?>