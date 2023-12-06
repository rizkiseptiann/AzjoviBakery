<?php
session_start();

// hancurkan riwayat login pelanggan
session_destroy();

echo "<script>alert('anda yakin?');</script>";
echo "<script>location='index.php';</script>";

?>