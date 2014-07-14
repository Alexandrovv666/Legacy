<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'getspeed') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        echo gettime_of_path($_GET['x1'], $_GET['y1'], $_GET['z1'], $_GET['x2'], $_GET['y2'], $_GET['z2']);
    }
    FClose_mysql_connect($mysql_connect);
?>