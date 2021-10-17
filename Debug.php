<?php

echo ''
. '<head>
        <title>DEBUG</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include_once("include/head.php"); ?>
        

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<!--        <link rel="stylesheet" href="assets/datatable/dataTables.bootstrap4.min.css">
        <script src="assets/datatable/jquery.dataTables.min.js"></script>-->
<!--        <link ref="stylesheet" type="text/css" href="dist/snackbar.min.css" > 
        <script src="dist/snackbar.min.js"></script>-->
    </head>

    <body>
    <div class="container">';
echo '<h1>Debug MODE</h1>';
echo 'Category :'.$category.'</br>';
echo 'Answer :'.$answer.'</br>';
echo 'Question ID :'.$question_id.'</br>';
echo 'Publication Status :'.$publikasi.'</br>';
echo 'Question Answered Date :'.$insertdate.'</br>';
echo 'User Name :'.$admin_name.'</br>';
echo '</br></div>';


echo '</body>
</html>';?>