 <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('include/dbconnection.php');



$nrp = $_POST['nrp'];
$pertanyaan = $_POST['pertanyaan'];
$category = (int)$_POST['kategori'];
$email = $_POST['email'];
$nama = $_POST['nama'];
$publikasi = 0;
//$insertdate = date("Y-m-d", strtotime($tanggal_masuk));
$insertdate = date("Y-m-d");
//echo 'Date IS :';
//var_dump($insertdate);

//var_dump($email);
//$query=mysqli_query($dbh,'INSERT INTO question (submitted_by,question,email,category_id) VALUES('.$nrp.','.$pertanyaan.','.$email.','.$category.')');


$stmt = $dbh->prepare('INSERT INTO question (submitted_by,question,email,nama,category_id,'
        . 'tanggal_masuk,is_published) VALUES(?,?,?,?,?,?,?)');
//$stmt->bind_param("sssi",$nrp,$pertanyaan,$email,$category);
$stmt->execute([$nrp,$pertanyaan,$email,$nama,$category,$insertdate,$publikasi]);
/*try {
  
        echo 'masuk';

} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
*/
//header('location: index.php');    
//exit();
echo "<script>location.href='index.php';</script>";

?>
