<?php
    include 'API.php';
    $linkss = FConnBase();
    $arr_res_castle = mysql_fetch_array(mysql_query('SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID($_GET['login']) . '"'));
    SetCookie("login", $_GET['login']);
    $data_session=mysql_fetch_array(mysql_query('SELECT * FROM `session` WHERE (`login`="'.($_GET['login']).'") AND (`time`>"'.(time()-$Lang_session).'") and (`ip`="'.$_SERVER['REMOTE_ADDR'].'") and (`status`="1")'));
    SetCookie("session", $data_session['session']);
    SetCookie("X", $arr_res_castle['x']);
    SetCookie("Y", $arr_res_castle['y']);
    SetCookie("Z", $arr_res_castle['z']);
    FClose_mysql_connect($linkss);
  echo '<script language = \'javascript\'> var delay = 100; setTimeout("document.location.href=\'game/index.php\'", delay); </script>';

?>  