<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
if ($_GET['act'] == 'null') {
  $mysql_connect = F_Connect_MySQL();
  global $C_Numberic, $C_Text_noSpace;
  if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
    loging('Кука login не прошла валидацию.');
    exit;
  }
  if (!Chek_string_of_mask($_COOKIE['casX'], $C_Numberic)) {
    loging('Кука casX не прошла валидацию.');
    exit;
  }
  if (!Chek_string_of_mask($_COOKIE['casY'], $C_Numberic)) {
    loging('Кука casY не прошла валидацию');
    exit;
  }
  if (!Chek_string_of_mask($_COOKIE['casZ'], $C_Numberic)) {
    loging('Кука casZ не прошла валидацию');
    exit;
  }
  if (!F_IF_session()) {
    loging('Сессия игрока неактивна.');
    exit;
  }
  F_session_extension();
  include $_SERVER['DOCUMENT_ROOT'] . '/server/_get_time_and_res.php';
  mysql_close($mysql_connect);
}
?>