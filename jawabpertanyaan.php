<?php
session_start();
$admin_name = $_SESSION["name"];
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('include/dbconnection.php');

$category = $_POST['matkul_pilih'];
$answer = $_POST['modaljawab'];
$question_id = $_POST['question'];
$publikasi = $_POST['publikasi'];
$insertdate = date("Y-m-d");







if($category== null ){
    //echo 'UPDATE question SET answer="'.$answer.'", answered_by="'.$admin_name.'", is_published="'.$publikasi.'",tanggal_jawab="'.$insertdate.'" is_answered=1  WHERE question_id="'.$question_id.'"</br>';
    $stmt = $dbh->prepare('UPDATE question SET answer=?, answered_by=?, is_published=?,tanggal_jawab=?, is_answered=1  WHERE question_id=?');
    $stmt->execute([$answer,$admin_name,$publikasi,$insertdate,$question_id]);
    //var_dump($stmt);
    
    //echo '|NOTE : Category Null';
}elseif($question_id && $publikasi == null){
    $stmt = $dbh->prepare('UPDATE question SET answer=?, answered_by=?, tanggal_jawab=?, is_answered=1  WHERE question_id=?');
    $stmt->execute([$answer,$admin_name,$insertdate,$question_id]);
    //var_dump($stmt);
    
    //echo '|NOTE : Category & Publikasi Null';
    
}else{
    $stmt = $dbh->prepare('UPDATE question SET answer=?,answered_by=?, is_answered=1, category_id=?, is_published=?, tanggal_jawab=? WHERE question_id=?');
    $stmt->execute([$answer,$admin_name,$category,$publikasi,$insertdate,$question_id]);   
    //var_dump($stmt);
    //echo '|NOTE : Category & Publikasi Not Null';
    
}


//$stmt = $dbh->prepare('UPDATE question SET answer=?, answered_by=?, is_answered=1  WHERE question_id=?');

//$stmt->bind_param("ssi",$nrp,$pertanyaan,$kategori);

//$stmt->execute([$jawaban,$namauser,$question]);
header('location: admin.php');
?>