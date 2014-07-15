<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    $arr  = mysql_fetch_array(mysql_query('SELECT * FROM `castle` WHERE `id`="' . F_Get_ID($_POST['login']) . '"'));
    echo $arr[$_POST['line']];
    FClose_mysql_connect($mysql_connect);
?>