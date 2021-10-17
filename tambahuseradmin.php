<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('include/dbconnection.php');



$nip = $_POST['nip'];
$password = $_POST['password'];
$simpan = password_hash($password, PASSWORD_DEFAULT);
$nama = $_POST['nama'];

$stmt = $dbh->prepare('INSERT INTO admin (nip,password,nama) VALUES(?,?,?) ');
//$stmt->bind_param("ssi",$nrp,$pertanyaan,$kategori);
$stmt->execute([$nip,$simpan,$nama]);
header('location: login.php');
?>