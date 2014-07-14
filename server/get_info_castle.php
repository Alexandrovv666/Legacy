<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'get_info_castle') {
        echo 'Здесь скоро будет вся основная информация о замке.';
    }
    FClose_mysql_connect($mysql_connect);
?>