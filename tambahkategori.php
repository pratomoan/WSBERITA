<?php
session_start();
$admin_name = $_SESSION["name"];

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('include/dbconnection.php');


$category = $_POST['kategori'];


$stmt = $dbh->prepare('INSERT INTO category (category,category_by) VALUES(?,?) ');
//$stmt->bind_param("ssi",$nrp,$pertanyaan,$kategori);
$stmt->execute([$category,$admin_name]);
header('location: admin.php');
?>