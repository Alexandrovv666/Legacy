<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/head.php';
    $linkss = F_Connect_MySQL();
    include $_SERVER['DOCUMENT_ROOT'].'/game/inc/checkdata.php';
    F_session_extension();
    include 'function.php';
    $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID($_COOKIE[ 'login' ]) . '" and `x`="'.$_COOKIE[ 'X' ].'" and `y`="'.$_COOKIE[ 'Y' ].'" and `z`="'.$_COOKIE[ 'Z' ].'"');
    $Global_array_castle = mysql_fetch_array($res_castle);
    F_echo_html_head();
?>
<link rel="stylesheet" href="default.css">
<script src="js\api.js"></script>
<script src="js\general.js"></script>
<script src="js\castle.js"></script>
<script src="js\debug.js"></script>
<script src="js\jquery.min.js"></script>
<script src="js\map.js"></script>
<script src="js\navigation.js"></script>
<script src="js\processed.js"></script>
<script src="js\var.js"></script>

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
            echo 'Что-то пошло не так...';
    }
    mysql_close($linkss);
?> 
<script>setInterval(One, 1000)</script>