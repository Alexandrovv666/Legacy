<?php
//SECURITY TAB
    if (basename($_SERVER['PHP_SELF'])!='SetCookie.php'){
        http_response_code(404);
        header("404 Not Found");
        exit;
    }

    if ($_COOKIE['test']!='yes'){
        echo 'У вас обнаружена проблема с куками.<br>Для решения проблем зайдите <a href="help/index.php?site=cookie">сюда</a>.';
        exit;
    }
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    $linkss = F_Connect_MySQL();
    $arr_res_castle = mysql_fetch_array(mysql_query('SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID($_GET['login']) . '" LIMIT 1'));
    SetCookie("login", $_GET['login']);
    $data_session=mysql_fetch_array(mysql_query('SELECT * FROM `session` WHERE (`login`="'.($_GET['login']).'") AND (`time`>"'.(time()-$Lang_session).'") and (`ip`="'.$_SERVER['REMOTE_ADDR'].'") and (`status`="1")'));
    SetCookie("session", $data_session['session']);
    SetCookie("casX",    $arr_res_castle['x']);
    SetCookie("casY",    $arr_res_castle['y']);
    SetCookie("casZ",    $arr_res_castle['z']);
    SetCookie("mapX",    $arr_res_castle['x']);
    SetCookie("mapY",    $arr_res_castle['y']);
    SetCookie("mapZ",    $arr_res_castle['z']);
    SetCookie("ort",     'castle');
    mysql_Close($linkss);
    header("Location: game.php");
?>  