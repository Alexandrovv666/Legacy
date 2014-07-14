<?php
    include 'function.php';
    $linkss = FConnBase();
    include 'inc/checkdata.php';
    F_session();
    include 'inc/invisible.php';
    $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID($_COOKIE[ 'login' ]) . '" and `x`="'.$_COOKIE[ 'X' ].'" and `y`="'.$_COOKIE[ 'Y' ].'" and `z`="'.$_COOKIE[ 'Z' ].'"');
    $Global_array_castle = mysql_fetch_array($res_castle);
    echo '<!DOCTYPE html><title>Наследие воителей</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><link rel="stylesheet" href="default.css?'.$Version.'"><script src="api.js?'.$Version.'"></script>';
    echo '<script src="general.js"></script>';
    echo '<script src="jquery.min.js"></script><div id="fon"></div>';
    function_paint_alle_panel();
    switch ($_COOKIE['ort']) {
        case 'castle':
            function_Show_Castle();
            break;
        case 'map':
            function_show_map();
            break;
        default:
            echo 'Что-то пошло не так...';
    }
    echo '<script>setInterval(One, 1000)</script>';
    FClose_mysql_connect($linkss);
?> 
