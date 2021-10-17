<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('include/dbconnection.php');

$question = $_POST['question'];

$stmt = $dbh->prepare('DELETE FROM question WHERE question_id=?');

//$stmt->bind_param("ssi",$nrp,$pertanyaan,$kategori);

$stmt->execute([$question]);
header('location: admin.php');









?>