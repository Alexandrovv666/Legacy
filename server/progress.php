<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/gameserver.php';
if ($_GET['action'] == 'get') {
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
  F_session_extension();
  $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
  $arr_res_castle = mysql_fetch_array($res_castle);
  $res_room_for_work = mysql_query('SELECT * FROM haus WHERE `new`="'.$arr_res_castle['c_' . ($_GET['num_room']) . '_n'].'"');
  $arr_res_room_for_work = mysql_fetch_array($res_room_for_work);
  if ($arr_res_castle['c_' . $_GET['num_room'] . '_1'] < 0) {
      $time             = $arr_res_room_for_work['default_time'];
      $max              = $arr_res_room_for_work['men'];
      $men              = $arr_res_castle['c_' . ($_GET['num_room']) . '_2'];
      $before_time      = -$arr_res_castle['c_' . $_GET['num_room'] . '_1'];
      $k                = $max/$men;
      $true_before_time = $before_time/$k;
      $progress         = 100-($true_before_time/$time)*100;
      echo '<progress max="100" value="'.($progress).'" id="prgbar-'.$_GET['num_room'].'"></progress>';
  }
  echo ' ';
}















?>