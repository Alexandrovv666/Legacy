<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
if ($_GET['action'] == 'get_time_work_room') {
  $mysql_connect = F_Connect_MySQL();
  global $C_Numberic, $C_Text_noSpace;
  if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
    loging('���� login �� ������ ���������.');
    exit;
  }
  if (!Chek_string_of_mask($_COOKIE['X'], $C_Numberic)) {
    loging('���� X �� ������ ���������.');
    exit;
  }
  if (!Chek_string_of_mask($_COOKIE['Y'], $C_Numberic)) {
    loging('���� Y �� ������ ���������');
    exit;
  }
  if (!Chek_string_of_mask($_COOKIE['Z'], $C_Numberic)) {
    loging('���� Z �� ������ ���������');
    exit;
  }
  if (!F_IF_session()) {
    loging('������ ������ ���������.');
    exit;
  }
  if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
    loging('get �������� num_room �� ������ ���������.');
    exit;
  }
  F_session_extension();
  include $_SERVER['DOCUMENT_ROOT'] . '/server/_get_time_and_res.php';
  mysql_close($mysql_connect);
}
?>