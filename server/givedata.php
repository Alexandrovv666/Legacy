<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
if ($_GET['act'] == 'null') {
  $mysql_connect = F_Connect_MySQL();
  global $C_Numberic, $C_Text_noSpace;
  $access = true;
  if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
    loging('���� login �� ������ ���������.');
    $access = false;
  }
  if (!Chek_string_of_mask($_COOKIE['casX'], $C_Numberic)) {
    loging('���� casX �� ������ ���������.');
    $access = false;
  }
  if (!Chek_string_of_mask($_COOKIE['casY'], $C_Numberic)) {
    loging('���� casY �� ������ ���������');
    $access = false;
  }
  if (!Chek_string_of_mask($_COOKIE['casZ'], $C_Numberic)) {
    loging('���� casZ �� ������ ���������');
    $access = false;
  }
  if (!F_IF_session()) {
    loging('������ ������ ���������. ������������� �� �� ��������.');
    $access = false;
  }
  if ($access){
    F_session_extension();
    include $_SERVER['DOCUMENT_ROOT'] . '/server/_get_time_and_res.php';
  }else{
    echo 'no;0';
  }
  mysql_close($mysql_connect);
}
?>