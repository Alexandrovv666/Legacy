<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
if ($_GET['action'] == 'change') {
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
  $mysql_connect = F_Connect_MySQL();
  if (!F_IF_session()) {
    loging('Сессия игрока неактивна.');
    exit;
  }
  if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
    loging('get параметр num_room не прошёл валидацию.');
    exit;
  }
  if (!Chek_string_of_mask($_GET['men'], $C_Numberic.$C_Znak)) {
    loging('get параметр men не прошёл валидацию.');
    exit;
  }
  F_session_extension();
  $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
  $arr_res_castle = mysql_fetch_array($res_castle);
  $name_room      = $arr_res_castle['c_' . ($_GET['num_room']) . '_n'];
  $arr_res_room   = mysql_fetch_array(mysql_query('SELECT * FROM haus WHERE `new`="' . ($name_room).'"'));
  $Time_Work_all  = $arr_res_room['default_time'];
  $men_to_room    = $arr_res_room['men'];
  $real_men       = $arr_res_castle['c_' . ($_GET['num_room']) . '_2'];
  $before_time    = $arr_res_castle['c_' . ($_GET['num_room']) . '_1'];
  $add_men        = $_GET['men'];
  $new_men        = $real_men + $add_men;
  if ($real_men!=0){
    if ($new_men != 0) {
      $k    = ($add_men+$real_men) / $real_men;
      $time = floor($before_time / $k);
    } else{
      $time      = $before_time * (-1);
      $prz_after = -($Time_Work_all/$before_time);
    }
  }else{
    $time_after = floor($arr_res_castle['c_' . ($_GET['num_room']) . '_4'] * $Time_Work_all);
    $time = floor(($Time_Work_all - $time_after) * ($men_to_room / $new_men)) * (-1);
  }
  F_Transaction();
  mysql_query('UPDATE `game`.`castle` SET `c_' . ($_GET['num_room']) . '_4`="'.$prz_after.'", `c_' . $_GET['num_room'] . '_1` = "' . ($time) . '", `c_' . $_GET['num_room'] . '_2` = "' . ($real_men+$_GET['men']) . '",  `men`=`men`-' . ($add_men) . ' WHERE `id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
  include $_SERVER['DOCUMENT_ROOT'] . '/server/_get_time_and_res.php';
  mysql_close($mysql_connect);
}
?>