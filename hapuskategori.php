<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('include/dbconnection.php');

$category = $_POST['kategori'];

$stmt = $dbh->prepare('DELETE FROM category WHERE id=?');






//$stmt->bind_param("ssi",$nrp,$pertanyaan,$kategori);

$result=$stmt->execute([$category]);


if(!$result){
    $notice = 'error=1';
}else{
    $notice = 'error=0';
}

header('location: admin.php?'.$notice);










?>