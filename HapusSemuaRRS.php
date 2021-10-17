<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('include/dbconnection.php');

$stmt = $dbh->prepare('DELETE FROM berita');

//$stmt->bind_param("ssi",$nrp,$pertanyaan,$kategori);

$stmt->execute();

header('location: admin.php');

?>