<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/gameserver.php';
if ($_GET['action'] == 'delete_room') {
  $mysql_connect = F_Connect_MySQL();
  global $C_Numberic, $C_Text_noSpace;
  if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
    loging('Кука login не прошла валидацию.');
    exit;
  }
  if (!Chek_string_of_mask($_COOKIE['X'], $C_Numberic)) {
    loging('Кука X не прошла валидацию.');
    exit;
  }
  if (!Chek_string_of_mask($_COOKIE['Y'], $C_Numberic)) {
    loging('Кука Y не прошла валидацию');
    exit;
  }
  if (!Chek_string_of_mask($_COOKIE['Z'], $C_Numberic)) {
    loging('Кука Z не прошла валидацию');
    exit;
  }
  if (!F_IF_session()) {
    loging('Сессия игрока неактивна.');
    exit;
  }
  if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
    loging('get параметр num_room не прошёл валидацию.');
    exit;
  }
  $n = $_GET['num_room'];
  F_session_extension();
  $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
  $arr_res_castle = mysql_fetch_array($res_castle);
  $name_alt_room  = $arr_res_castle['c_' . ($_GET['num_room']) . '_n'];
  $res_room = mysql_query('SELECT * FROM haus WHERE `new`="' . ($name_alt_room) . '"');
  $a_room = mysql_fetch_array($res_room);
  mysql_query('UPDATE `castle` SET `agold`=agold-'.$a_room['agold'].', `atree`=atree-'.$a_room['atree'].', `astone`=astone-'.$a_room['astone'].', `amen`=amen-'.$a_room['amen'].', `maxres`=maxres-'.$a_room['asklad'].', `max_men`=max_men-'.$a_room['amen'].', `c_'.$n.'_n`="", `c_'.$n.'_1`="", `c_'.$n.'_2`="", `c_'.$n.'_3`="", `c_'.$n.'_4`="", `c_'.$n.'_5`="", `c_'.$n.'_6`="", `c_'.$n.'_7`="", `c_'.$n.'_8`="" WHERE (`id`="' . F_Get_ID($_COOKIE['login']) . '") AND (`x`="'.$_COOKIE['X'].'") AND (`y`="'.$_COOKIE['Y'].'") AND (`z`="'.$_COOKIE['Z'].'") ');
  echo '<div class="castle-room-"></div><p class="time-room" id="timer'.$n.'"></p><div id="of-progres-'.$n.'"></div>';
  mysql_close($mysql_connect);
}
?>