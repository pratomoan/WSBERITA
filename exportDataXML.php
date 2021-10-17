<?php

//mysqli_connect('localhost', 'root', '');
//mysqli_select_db('qnamhs');

include_once ('include/dbconnection.php');
$query = $dbh->query("SELECT * FROM question ORDER BY question_id ASC"); 
//$sql = "SELECT nama,question,answer,answered_by,tanggal_jawab FROM question ORDER BY question_id";
//$res = mysqli_query($sql);

$xml = new XMLWriter();

$xml->openURI("php://output");
$xml->startDocument();
$xml->setIndent(true);

$xml->startElement('datamhs');

//while ($row = mysql_fetch_assoc($res)) {
while($row = $query->fetch()){ 
    $status = ($row['is_published'] == 1)?'Published':'Not Published'; 
    $xml->startElement("publikasi");
    $xml->writeRaw($status);
    $xml->endElement();
    $xml->startElement("namapenanya");
    $xml->writeRaw($row['nama']);
    $xml->endElement();
    $xml->startElement("pertanyaan");
    $xml->writeRaw($row['question']);
    $xml->endElement();
    $xml->startElement("jawaban");
    $xml->writeRaw($row['answer']);
    $xml->endElement();
    $xml->startElement("penjawab");
    $xml->writeRaw($row['answered_by']);
    $xml->endElement();
    $xml->startElement("tanggaljawab");
    $xml->writeRaw($row['tanggal_jawab']);
    $xml->endElement();
    $xml->startElement("pemisah");
    $xml->writeRaw('--------------');
    $xml->endElement();
}

$xml->endElement();

header('Content-type: text/xml');
$xml->flush();
