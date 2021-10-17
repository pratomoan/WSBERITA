<?php
//require_once("include/data.php");
//require_once("include/category.php");
include ("include/dbconnection.php");

//$cari = $_GET['cari'];
$stmt = $stmtcari = null;


if (!isset($_GET['cari']) || $_GET['cari'] === null) {
    $stmt = $dbh->prepare('SELECT * FROM question WHERE is_answered=1');
    $stmt->execute();
//    var_dump($stmt);
//    echo 'Masuk If Pertama';
} else {
    
//    if($_GET['metodecari']==0){
//        $cari = '%'.$_GET['cari'].'%';
//        $matkul = (int) $_GET['carimatkul'];
//
//        $search_like = $cari;
//        $stmtcari = $dbh->prepare("SELECT q.question_id, q.submitted_by, q.answered_by, q.question, q.answer, q.email, q.nama, q.is_answered, q.is_published, q.category_id, k.category, k.category_by as 'viewpertanyaan' FROM question q join category k on q.category_id = k.id WHERE submitted_by LIKE ? AND category_id LIKE ? AND is_answered=1 AND is_published=1");
//        //$stmtcari = $dbh->prepare("SELECT * FROM question WHERE submitted_by LIKE ? AND category_id LIKE ? AND is_answered=1");
//        $stmtcari->execute([$search_like, $matkul]);
//    }else{
        $search = '%'.$_GET['cari'].'%';
        //var_dump($cari);
        $category = (int) $_GET['carimatkul'];
        //var_dump($matkul);
        $search_like = $search;
        //var_dump($search_like);
        
        //echo 'SELECT q.question_id, q.submitted_by, q.answered_by, q.question, q.answer, q.email, q.nama, q.is_answered, q.is_published, q.category_id, k.category, k.category_by as \'viewpertanyaan\' FROM question q join category k on q.category_id = k.id WHERE (question LIKE "'.$search_like.'" OR submitted_by LIKE "'.$search_like.'") AND (category_id LIKE "'.$matkul.'" AND is_answered=1 AND is_published=1) </br>';
        
        $stmtcari = $dbh->prepare("SELECT q.question_id, q.submitted_by, q.answered_by, q.question, q.answer, q.email, q.nama, q.is_answered, "
                . "q.is_published, q.category_id, k.category, k.category_by as "
                . "'viewpertanyaan' FROM question q join category k on q.category_id "
                . "= k.id WHERE (question LIKE ? OR submitted_by LIKE ?) AND (category_id LIKE ? AND is_answered=1 AND is_published=1)");
        //$stmtcari = $dbh->prepare("SELECT * FROM question WHERE submitted_by LIKE ? AND category_id LIKE ? AND is_answered=1");
        $stmtcari->execute([$search_like, $search_like, $category]);
        //var_dump($stmtcari);
//        echo 'Masuk Else';
//    }
}




session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>QNA</title>
        <?php include_once('include/head.php'); ?>
        <style>
            div.hidden{
                   display: none;
            }
        </style>
<!--        <link ref="stylesheet" type="text/css" href="dist/snackbar.min.css" /> 
        <script src="dist/snackbar.min.js"></script>-->
    </head>

    <body>

        <?php include_once('include/navbar.php'); ?>
        <div class="container pt-5">
            <div class="row mb-3">
                <div class="col-md-12">
                    <form action="index.php" method="GET">
                        <div class="input-group">
<!--                            <select  name="metodecari" class="form-select">
                                <option value="" selected>Pilih Metode Pencarian</option>
                                <option value="0">Berdasarkan NRP</option>
                                <option value="1">Berdasarkan Pertanyaan</option>
                            </select>-->
                            <label for="cari"></label>
                            <input type="text" name="cari" placeholder="Apa Yang Ingin Anda Ketahui?" class="form-control">
                            <select  name="carimatkul" class="form-select">
                                <option value="" selected>Pilih Mata Kuliah</option>
                                <?php
                                $stmt = $dbh->query('SELECT * FROM category');
                                while ($row = $stmt->fetch()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['category'] . '</option>';
                                }
                                ?>
                            </select>

                            <button type="submit" class="btn btn-primary">Cari</button>



                        </div>
                    </form>
                </div>
                 <div class="row mb-2">
                
            </div>
                </form>
            </div>
           
            <div class="container-fluid">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalajukanpertanyaan">
                    Tambah Pertanyaan
                </button>
                
            </div>
            
        </div>

            <div class="row">
                <div class="col-md-12">
                    <div id="accordion">
                        <?php
                        //Lihat datanya di include/data.php
                        //$stmt = $dbh->query('SELECT * FROM question WHERE is_answered=1');
                        
                        //print_r($row);
//                        if (isset($_GET['cari']) && isset($_GET['carimatkul']) && isset($_GET['metodecari'])) {
                        if (isset($_GET['cari']) && isset($_GET['carimatkul'])) {
                        while ($row = $stmtcari->fetch()) {
                            
                                    echo '
                                        <br></br>
                                        <div class="card mb-1">
                                        <div class="card-header" id="heading-' . $row['question_id'] . '">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-' . $row['question_id'] . '" aria-expanded="false" aria-controls="collapse-' . $row['question_id'] . '">
                                                    | Oleh : ' . $row['nama'] . ' | NRP :  ' . $row['submitted_by'] . ' | ' . $row['question'] . ' 
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse-' . $row['question_id'] . '" class="collapse" aria-labelledby="heading-' . $row['question_id'] . '" data-parent="#accordion">
                                            <div class="card-body">
                                                ' . $row['answer'] . ' | Di Jawab Oleh : ' . $row['answered_by'] . '
                                            </div>
                                        </div>
                                    </div>';
                                }
                        
                            }else{?>
                        <div class="row">
<!--                            <script>
                            
                            $(document).ready(function() {
                                    $("div#notfound").removeClass("hidden");
                                });
                            </script>
                            <div id="notfound" class="alert alert-danger hidden" role="alert">
                                Data Not found
                            </div>-->   
                        </div>   
                            <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalajukanpertanyaan" tabindex="-1" role="dialog" aria-labelledby="modalajukanpertanyaanLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalajukanpertanyaanLabel">Tambah Pertanyaan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="submitpertanyaan.php" method="POST">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="nrp">NRP</label>
                                <input type="text" name="nrp" class="form-control">
                                
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control">

                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control">

                                <label for="pertanyaan">Pertanyaan</label>
                                <textarea name="pertanyaan" rows="5" maxlength="800" class="form-control" style="resize: none"></textarea>


                                <select  name="kategori" class="form-select">
                                    <option value="" selected>Pilih Mata Kuliah</option>
                                    <?php
                                    $stmt = $dbh->query('SELECT * FROM category');
                                    while ($row = $stmt->fetch()) {
                                        echo '<option value="' . $row['id'] . '">' . $row['category'] . '</option>';
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </body>
<!--<script>
//$('.button').click(function() {
//   Snackbar.show({text: 'Example notification text.'});
//});
//
//</script>-->
</html> 