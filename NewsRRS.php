<?php 

include ("include/dbconnection.php");

?>
<html lang="en">

    <head>
        <title>QNA</title>
        <?php include_once('include/head.php'); ?>
        <style>
            div.hidden{
                display: none;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
        
        <!--        <link ref="stylesheet" type="text/css" href="dist/snackbar.min.css" /> 
                <script src="dist/snackbar.min.js"></script>-->
    </head>

    <body>

        <?php include_once('include/navbar.php'); ?>
        <br><br>
        <div class="container pt-12">
            <div class="row">
                <div class="col-md-10">
                    <table id="databerita" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="63">No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Link</th>
                                <th>Tanggal</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Lihat datanya di include/data.php
                            $counter = 1;
                            //$query = "SELECT q.question_id, q.submitted_by, q.answered_by, q.question, q.answer, q.email, q.nama, q.is_answered, q.category_id, k.category, k.category_by as 'viewpertanyaan' FROM question q join category k on q.category_id = k.id";
                            $query = "SELECT judul, deskripsi, link, tanggal FROM berita";
                            $stmt = $dbh->query($query);
                            //$stmt = $dbh->query('SELECT * FROM question');
                            
                            while ($row = $stmt->fetch()) {
                                ?><tr>
                                    <td><?= $counter ?></td>
                                    <td><?= $row['judul'] ?></td>
                                    <td><?= $row['deskripsi'] ?></td>
                                    <td><a href="<?= $row['link'] ?>">Lihat Berita</a></td>
                                    <td><?= $row['tanggal'] ?></td>
                                </tr>
                                <?php
                                $counter += 1;
                            }?>
                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
<script>
    $(document).ready(function () {

        $('#databerita').DataTable();
        
    });


</script>
</html> 