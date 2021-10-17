<?php
include_once ('include/dbconnection.php');
include_once ('include/berita.php');

$beritaObj = new Berita();
$rssData = $beritaObj->GetRss();
$xml = json_decode(json_encode(simplexml_load_string($rssData, null, LIBXML_NOCDATA)), true);
$fp = fopen('berita.json', 'w');
foreach ($xml['channel']['item'] as $data_berita) {
    $judul = $data_berita['title'];
    $deskripsi = $data_berita['description'];
    $url_berita = $data_berita['link'];
    $tanggal = $data_berita['pubDate'];
    fwrite($fp, json_encode($xml, JSON_PRETTY_PRINT));

    $stmt = $dbh->prepare('INSERT INTO berita (judul,deskripsi,link,tanggal) VALUES(?,?,?,?)');  
    $stmt->execute([$judul,$deskripsi,$url_berita,$tanggal]);  
}
fclose($fp);
echo 'Sukses Mengupdate Berita';





//json_enconde($array, $options(optional) is the method to convert array into JSON


//close the file
fclose($fp);




header('location: admin.php');





?>
