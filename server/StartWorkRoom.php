<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
if ($_GET['action'] == 'StartWorkRoom') {
  $linkss = F_Connect_MySQL();
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
    loging('get �������� "num_room" �� ������ ���������.');
    exit;
  }
  if (!Chek_string_of_mask($_GET['name'], ($C_Text_noSpace . $C_Numberic))) {
    loging('get �������� "name" �� ������ ���������.');
    exit;
  }
  F_session_extension();
  echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
  $res_castle            = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
  $a_castle        = mysql_fetch_array($res_castle);
  $res_room_for_work     = mysql_query('SELECT * FROM haus WHERE `new`="' . $_GET['name'] . '"');
  $a_room_for_work = mysql_fetch_array($res_room_for_work);
  echo '<p><a class="tooltip class-link" href="#" onclick="StartWorkRoom(\'' . $a_room_for_work[$i]['new'] . '\', ' . $_GET['num_room'] . ')">';
  $res_room_rus      = mysql_query('SELECT * FROM `haus_const` WHERE `name`="' . onlyNoInt($a_room_for_work['new']) . '"');
  $a_room_rus = mysql_fetch_array($res_room_rus);
  echo $a_room_rus['name_rus'] . ' ' . onlyInt($a_room_for_work['new']) . ' ������.</a></p>';
  echo '<i>��������:</i>' . $a_room_rus['descr_rus'] . '<br>��������� ��������:<br><b>';
  if ($a_castle['gold'] < $a_room_for_work['gold'])
    echo '<font color="red">������: ' . $a_room_for_work['gold'] . '</font><br>';
  else
    echo '������: ' . $a_room_for_work['gold'] . '<br>';
  if ($a_castle['tree'] < $a_room_for_work[$i]['tree'])
    echo '<font color="red">������: ' . $a_room_for_work['tree'] . '</font><br>';
  else
    echo '������: ' . $a_room_for_work['tree'] . '<br>';
  if ($a_castle['gold'] < $a_room_for_work[$i]['gold'])
    echo '<font color="red">������: ' . $a_room_for_work['stone'] . '</font><br>';
  else
    echo '������: ' . $a_room_for_work['stone'] . '<br>';
  $VarMen = floor($a_room_for_work['men']);
  if (floor($a_castle['men']) < $VarMen)
    $VarMen = floor($a_castle['men']);
  echo '<br><input class="slider" type=range min=0 max=' . $a_room_for_work['men'] . ' value=' . $VarMen . ' id="men_for_work" oninput="CorrectMenForWork(' . $a_room_for_work['men'] . ',' . floor($a_castle['men']) . ')"><br>';
  echo '<span id="men_to_work_user">' . $VarMen . ' / ' . $a_room_for_work['men'] . '</span><br>';
  echo '����� ���������� <span id="to_works">' . ($VarMen) . '</span> ������<br>';
  echo '<center>����� ���������: <span id="time_of_work">'.int_to_time($a_room_for_work['default_time']).'</span> �� <span id="def_time_of_work">'.int_to_time($a_room_for_work['default_time']).'</span></center><br>';
  echo '<center><a class="tooltip class-link big-text" href="#" onclick="StartWorks(\'' . $_GET['name'] . '\',' . $_GET['num_room'] . ')">������ �������!</a></center>';
  mysql_Close($linkss);
}
?>