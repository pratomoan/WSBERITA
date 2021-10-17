<?php
//require_once("include/data.php");
//require_once("include/category.php");
//require_once ("dbfunct/db_function.php");
include ("include/dbconnection.php");

session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === null) {
    header("location: login.php");
    exit;
}
$admin_name = $_SESSION["name"];
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>QNA Admin</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include_once('include/head.php'); ?>


        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
        <!--        <link rel="stylesheet" href="assets/datatable/dataTables.bootstrap4.min.css">
                <script src="assets/datatable/jquery.dataTables.min.js"></script>-->
        <!--        <link ref="stylesheet" type="text/css" href="dist/snackbar.min.css" > 
                <script src="dist/snackbar.min.js"></script>-->
    </head>

    <body>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <!-- Brand/logo -->
            <a class="navbar-brand" href="#">QNA Admin | <?= $admin_name ?></a>

            <!-- Links -->
            <ul class="navbar-nav"> 
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
            </ul>
        </nav>
        &nbsp;&nbsp;&nbsp;
        <div class="container">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalkategori">
                Fungsi Mata Kuliah
            </button>

            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#csvmodal">
                Export Data
            </button>

            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#rrsmodal">
                RRS
            </button>
        

        <form action="logout.php">
            <button type="submit" class="btn btn-danger float-right">
                Keluar
            </button>
        </form>


    </div>


    <div class="container pt-12">
        <div class="row">
            <div class="col-md-10">
                <table id="datapertanyaan" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <!--                                Fix susunan grid       -->
                            <th width="63">No</th>
                            <th>NRP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>MK</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th>Di Jawab Oleh</th>
                            <th>Tgl Jawab</th>
                            <th>Tgl Masuk</th>
                            <th>Pusblished</th> 
                            <th width="120">Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Lihat datanya di include/data.php
                        $counter = 1;
                        //$query = "SELECT q.question_id, q.submitted_by, q.answered_by, q.question, q.answer, q.email, q.nama, q.is_answered, q.category_id, k.category, k.category_by as 'viewpertanyaan' FROM question q join category k on q.category_id = k.id";
                        $query = "SELECT q.question_id, q.submitted_by, q.answered_by, q.question, q.answer, q.email, q.nama, q.tanggal_jawab, "
                                . "q.tanggal_masuk, q.is_published, q.is_answered, q.category_id, "
                                . "k.category, k.category_by AS 'viewpertanyaan' FROM question q JOIN category k on q.category_id = k.id";
                        $stmt = $dbh->query($query);
                        //$stmt = $dbh->query('SELECT * FROM question');
                        while ($row = $stmt->fetch()) {
                            $publishedstring = $row['is_published'];
                            ?><tr>
                                <td id="id-<?= $row['question_id'] ?>" ><?= $counter ?></td>
                                <td><?= $row['submitted_by'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td style="max-width: 400px;"><textarea style="resize: none" rows="3" cols="12" readonly><?= $row['email'] ?></textarea></td>
                                <td id="category-<?= $row['question_id'] ?>"><?= $row['category'] ?></td>
                                <td style="max-width: 400px;" id="question-<?= $row['question_id'] ?>"><textarea rows="5" cols="15" style="resize:none; border:0px;" readonly><?= $row['question'] ?></textarea></td>
                                <td style="max-width: 400px;"><textarea rows="5" cols="15" id="answerid-<?= $row['question_id'] ?>" style="resize:none; border:0px;" readonly><?= $row['answer'] ?></textarea></td>
                                <td><?= $row['answered_by'] ?></td>
                                <td><?= $row['tanggal_jawab'] ?></td>
                                <td><?= $row['tanggal_masuk'] ?></td>
                                <td><?php
                                    if ($publishedstring === "1") {
                                        echo 'Published';
                                    } else {
                                        echo 'Un Published';
                                    }
                                    ?>
                                </td>


                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary btn-sm float-right jawab" data-id="<?= $row['question_id'] ?>" data-toggle="modal" data-target="#jawabmodal">Jawab/Edit</button>
                                        <div>  &nbsp;&nbsp; </div>
                                        <button type="button" class="btn btn-danger btn-sm float-right hapus" data-id="<?= $row['question_id'] ?>" data-toggle="modal" data-target="#hapusmodal">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $counter += 1;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Jawab Pertanyaan -->
    <div class="modal fade" id="jawabmodal" tabindex="-1" role="dialog" aria-labelledby="JawabPertanyaanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jawabmodal">Jawab Pertanyaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="jawabpertanyaan.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="categoryjawab">Mata Kuliah</label>
                            <input id="idjawaban" type="text" name="categoryjawab" placeholder="INIMATKUL" class="form-control readonly" readonly>

                            <label for="modaltanya">Pertanyaan</label>
                            <textarea id="idpertanyaan" name="modaltanya" rows="5" placeholder="INIPERTANYAAN" class="form-control" style="resize: none" readonly></textarea>

                            <label for="modaljawab">Jawaban</label>
                            <textarea id="idjawab" name="modaljawab" rows="5" maxlength="800" class="form-control" style="resize: none"></textarea>

                            <div><br></div>
                            <label for="published">Ubah Status Publikasi</label>
<!--                            <input type="hidden" id="published_id" name="published" value="">-->
                            <div></div>
                            <select name="publikasi" class="form-select" aria-label="Pilih Publikasi">
                                <option value="" selected>Pilih Status Publikasi</option>
                                <option value="0">Un Publish</option>
                                <option value="1">Publish</option>
                            </select>

                            <div> <br> </div>
                            <label for="matkul_pilih">Ubah Mata Kulliah?</label>
                            <input type="hidden" id="jawab_matkul_id" name="question" value="">
                            <div></div>

                            <select name="matkul_pilih" class="form-select" aria-label="Pilih Matkul">
                                <option value="" selected>Pilih Mata Kuliah</option>
                                <?php
                                $stmt = $dbh->query('SELECT * FROM category');
                                while ($row = $stmt->fetch()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['category'] . '</option>';
                                }
                                ?>
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

    <?php
    $delete_notification = 0;
    if (isset($_GET['error'])) {
        $delete_notification = $_GET['error'];
    }
    if ($delete_notification == 1) {
        echo'
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Gagal Menghapus Mata Kuliah Karena Sedang Terpakai.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          </button>';
    }
    ?>

    <!-- Hapus Pertanyaan -->
    <div class="modal fade" id="hapusmodal" tabindex="-1" role="dialog" aria-labelledby="HapusPertanyaanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusmodal">Hapus Pertanyaan?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="hapuspertanyaan.php" method="POST">

                    <input type="hidden" id="hapus_question_id" name="question" value="">

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>        


    <!-- EXPORTCSVXML-->
    <div class="modal fade" id="csvmodal" tabindex="-1" role="dialog" aria-labelledby="ExportCSVLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusmodal">Export Data Pertanyaan Ke CSV/XML</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="exportDataCSV.php" method="POST">


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Export CSV</button>
                    </div>
                </form>
                <form action="exportDataXML.php" method="POST">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Export XML</button>
                    </div>
                </form>
            </div>
        </div>
    </div>        


    <!-- RRSMODAL-->
    <div class="modal fade" id="rrsmodal" tabindex="-1" role="dialog" aria-labelledby="RSSModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusmodal">RSS Update/Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="UpdateRRSAdmin.php" method="POST">


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Update RRS</button>
                    </div>
                </form>
                <form action="HapusSemuaRRS.php" method="POST">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus RRS</button>
                    </div>
                </form>
            </div>
        </div>
    </div>        



    <!-- Tambah/Hapus Lessons -->
    <div class="modal fade" id="modalkategori" tabindex="-1" role="dialog" aria-labelledby="kategorilabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalkategori">Hapus, Tambah & Lihat Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="tambahkategori.php" method="POST">
                        <div class="form-group">
                            <label for="kategoriinput">Tambah Mata Kuliah</label>
                            <input type="text" name="kategori" class="form-control">
                            <div> <br> </div>
                            <button type="submit" class="btn btn-secondary btn-sm">Kirim</button>
                        </div>
                    </form>
                    <form action="hapuskategori.php" method="POST">
                        <div class="form-group">
                            <select  name="kategori" class="form-select" aria-label="Default select example">
                                <option value="" selected>Hapus Mata Kuliah</option>
                                <?php
                                $stmt = $dbh->query('SELECT * FROM category');
                                while ($row = $stmt->fetch()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['category'] . '</option>';
                                }
                                ?>
                            </select>
                            <div> <br> </div>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                </div>

                <div class="container pt-5">

                    <div class="row">
                        <div class="col-md-12">
                            <table id="datakategori" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="63">No</th>
                                        <th>Mata Kuliah</th>
                                        <th>Di Input Oleh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
//Lihat datanya di include/data.php
                                    $query = "SELECT * FROM category";
                                    $stmt = $dbh->query($query);
//$stmt = $dbh->query('SELECT * FROM question');
                                    while ($row = $stmt->fetch()) {
                                        echo '<tr>
                                <td>' . $counter . '</td>
                                <td>' . $row['category'] . '</td>
                                <td>' . $row['category_by'] . '</td>
                            </tr>';
                                        $counter += 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>



<script>
    $(document).ready(function () {
        $('.alert').alert()
        $('#datapertanyaan').DataTable();
        $('#datakategori').DataTable();
        $('.jawab').click(function (e) {
            let question_id = e.target.getAttribute('data-id');
            var question = document.getElementById("question-" + question_id).childNodes[0];
            var courses = document.getElementById("category-" + question_id)
            var answer = document.getElementById("answerid-" + question_id).value;
            document.getElementById('idjawaban').value = courses.innerHTML;
            document.getElementById("idpertanyaan").value = question.innerHTML;
            document.getElementById("idjawab").value = answer;
            document.getElementById("jawab_matkul_id").value = question_id;

        })
        $('.hapus').click(function (e) {
            let question_id = e.target.getAttribute('data-id');
            document.getElementById("hapus_question_id").value = question_id;

        })

    });


</script>

</html>