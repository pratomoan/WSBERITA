<?php
//require_once("include/data.php");
//require_once("include/category.php");
include ("include/dbconnection.php");





session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>QNA - Admin Register</title>
        <?php include_once('include/head.php');?>
        <link rel="stylesheet" href="assets/custom.css">
    </head>

    <body>

        <?php include_once('include/navbar.php');?>

        
        <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-12">

      </div>

      <div class="col-lg-4 col-md-6">
          <div class="wrapper">
        <div class="col-md-13">
        <h2>Register</h2>
        <p>Masukan data untuk daftar.</p>
        <form action="tambahuseradmin.php" method="POST">
            <div class="form-group">
                <label>NIP</label>
                <input type="text" name="nip" id="nip" class="form-control" placeholder="1111110" required>
                
            </div>    
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Andi Danial" required>
                
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
                
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register">
            </div>
           
        </form>
    </div>
      </div>

      <div class="col-lg-4 col-md-6">

      </div>
    </div>
</div>
    
        </div>
        
        
    <body/>
</html>