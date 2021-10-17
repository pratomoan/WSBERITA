<?php 
 
// Load the database configuration file 
include_once ('include/dbconnection.php');
 
// Fetch records from database 
$query = $dbh->query("SELECT * FROM question ORDER BY question_id ASC"); 
//$data = $query->num_rows;
//if($data > 0){ 
    $delimiter = ","; 
    $filename = "data-pertanyaan_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('NAMA PENGIRIM', 'PERTANYAAN', 'JAWABAN', 'DI JAWAB OLEH', 'TANGGAL DI JAWAB', 'PUBLIKASI'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch()){ 
        $status = ($row['is_published'] == 1)?'Published':'Not Published'; 
        $lineData = array($row['nama'],$row['question'], $row['answer'], $row['answered_by'], $row['tanggal_jawab'], $status); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
//}

//header('location: admin.php');
exit; 
 
?>