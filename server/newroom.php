<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
if ($_GET['action'] == 'newroom') {
  $mysql_connect = F_Connect_MySQL();
  global $C_Numberic, $C_Text_noSpace;
  if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
    loging('���� login �� ������ ���������.');
    exit;
  }
  if (!Chek_string_of_mask($_GET['namenewroomroom'], $C_Text_noSpace . $C_Numberic)) {
    loging('get �������� name �� ������ ���������: "' . $_GET['namenewroomroom'] . '"');
    exit;
  }
  if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
    loging('get �������� namenewroomroom �� ������ ���������.');
    exit;
  }
  if (!Chek_string_of_mask($_GET['men'], $C_Numberic)) {
    loging('get �������� namenewroomroom �� ������ ���������.');
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
  //WORK!
  $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
  $arr_res_castle = mysql_fetch_array($res_castle);
  $res_new_room   = mysql_query('SELECT * FROM `haus` WHERE `new`="' . $_GET['namenewroomroom'] . '" LIMIT 1');
  if (mysql_num_rows($res_new_room) != 1) {
    loging('���������� ������� �� ���� ������ "' . $_GET['namenewroomroom'] . '" ��� ���������');
    exit;
  }
  $arr_res_new_room = mysql_fetch_array($res_new_room);
  if (($arr_res_castle['gold'] >= $arr_res_new_room['gold']) AND ($arr_res_castle['stone'] >= $arr_res_new_room['stone']) AND ($arr_res_castle['tree'] >= $arr_res_new_room['tree'])) {
    $VMenForWork = $_GET['men'];
    if ($arr_res_castle['men'] < $VMenForWork) {
      loging('���������� ��������� ������, ��� ���� � �������.');
      $VMenForWork = $arr_res_castle['men'];
    }
    if ($VMenForWork == 0)
      $VTimeForWork = ($arr_res_new_room['default_time'] * (-1)); //������������� ����� - ����������� �������
    else
      $VTimeForWork = floor($arr_res_new_room['default_time'] * ($arr_res_new_room['men'] / $VMenForWork));
    F_Transaction();
    mysql_query('UPDATE `game`.`castle` SET `c_' . $_GET['num_room'] . '_n` = "' . $arr_res_new_room['new'] . '",  `c_' . $_GET['num_room'] . '_1` = "' . ($VTimeForWork * (-1)) . '", `c_' . $_GET['num_room'] . '_2` = "' . $VMenForWork . '", `c_' . $_GET['num_room'] . '_3` = "' . $arr_res_new_room['id'] . '", `gold` = `gold`-' . $arr_res_new_room['gold'] . ', `tree` = `tree`-' . $arr_res_new_room['tree'] . ', `stone` = `stone`-' . $arr_res_new_room['stone'] . ', `men`=`men`-"' . $VMenForWork . '" WHERE `castle`.`id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
  } else {
    loging('������� ��������� ������� "' . $_GET['namenewroomroom'] . '" ��� ���������� ��������');
    exit;
  }
  include $_SERVER['DOCUMENT_ROOT'] . '/server/_get_time_and_res.php';
  echo '|<div class="castle-room-' . onlyNoInt($arr_res_new_room['new']) . '"></div><p class="level-room">' . onlyInt($arr_res_new_room['new']) . '</p><p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($VTimeForWork) . '</p>';
  mysql_close($mysql_connect);
}
?>