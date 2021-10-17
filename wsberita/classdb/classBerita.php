<?php
    class Classberita{

        public function create($judul,$deskripsi,$url_berita,$tanggal){
            include 'dbconnection.php';
//            $sql = "INSERT INTO berita (kategori_buku) VALUES (?)";
//            $stmt = $conn->prepare($sql);
//            $stmt->bind_param('s',$kategori_buku);
//            $query = $stmt->execute();
            $stmt = $dbh->prepare('INSERT INTO berita (judul,deskripsi,link,tanggal) VALUES(?,?,?,?)');  
            $query->execute([$judul,$deskripsi,$url_berita,$tanggal]);  
            $stmt->close();
            $dbh->close();
            return $query;
        }
        public function readAll(){
            include 'dbconnection.php';
            $sql = "SELECT * FROM berita";
            $query = $dbh->query($sql);
            $dbh->close();
            return $query;
        }
        public function deleteAll(){
            include 'dbconnection.php';
            $sql = "DELETE FROM tbl_kategori";
            $stmt = $dbh->query($sql);
            $query = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $query;
        }
    }
 ?>