<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    $linkss = F_Connect_MySQL();
    include $_SERVER['DOCUMENT_ROOT'].'/game/inc/checkdata.php';
    F_session_extension();
    include 'function.php';
    $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID($_COOKIE[ 'login' ]) . '" and `x`="'.$_COOKIE[ 'X' ].'" and `y`="'.$_COOKIE[ 'Y' ].'" and `z`="'.$_COOKIE[ 'Z' ].'"');
    $Global_array_castle = mysql_fetch_array($res_castle);?> 
<!DOCTYPE html lang="ru" xml:lang="ru">
<title>�������� ��������</title>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="default.css">
<script src="api.js"></script>';
<script src="general.js"></script>
<script src="jquery.min.js"></script>
<div id="fon"></div>
<?php
    include 'inc/invisible.php';
    function_paint_alle_panel();
    switch ($_COOKIE['ort']) {
        case 'castle':
            function_Show_Castle();
            break;
        case 'map':
            function_show_map();
            break;
        default:
            echo '���-�� ����� �� ���...';
    }
    mysql_close($linkss);
?> 
<script>setInterval(One, 1000)</script>