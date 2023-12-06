<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> Azjovi Admin : Register</h2>
                 <br />
            </div>
        </div>
         <div class="row">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>  Ayo Daftar </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
<br/>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Username :</span>
                                            <input type="text" class="form-control" placeholder="Username" name="user">
                                        </div>
                                         <div class="form-group input-group">
                                            <span class="input-group-addon">Password :</span>
                                            <input type="text" class="form-control" placeholder="Password" name="pass">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Nama Lengkap :</span>
                                            <input type="text" class="form-control" placeholder="Your Name" name="nama">
                                        </div>
                                     <button class="btn btn-success" name="save">Daftar</button>
                                    <hr />
                                    Sudah Daftar ?  <a href="login.php" >Login Disini</a>
                                    </form>
                                    <!-- script php -->
                                    <?php
                                        if (isset($_POST['save'])) {
                                            $koneksi->query("INSERT INTO admin(username, password, nama_lengkap)
                                            VALUES('$_POST[user]', '$_POST[pass]', '$_POST[nama]')");

                                            echo "<script>alert('Pendaftaran Berhasil');</script>";
                                            echo "<script>location='login.php';</script>";
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
