<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
if ($_GET['action'] == 'list') {
  global $C_Numberic, $C_Text_noSpace;
  if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
    loging('Кука login не прошла валидацию.');
    exit;
  }
  $mysql_connect = F_Connect_MySQL();
  if (!F_IF_session()) {
    loging('Сессия игрока неактивна.');
    exit;
  }
  F_session_extension();
  echo '<center>Список квестов</center><br>';
  $GA_quest_status          = array();
  $res_alle_quest_status    = mysql_query('SELECT * FROM `quest_status` WHERE `id_user`="'.F_Get_ID($_COOKIE['login']).'"');
  while ($GA_quest_status[] = mysql_fetch_array($res_alle_quest_status)); {
  }
  $count_quest_status   = count($GA_quest_status) - 1;
  $GA_quest_const          = array();
  $res_alle_quest_const    = mysql_query('SELECT * FROM `quest_const`');
  while ($GA_quest_const[] = mysql_fetch_array($res_alle_quest_const)); {
  }
  $count_quest_const    = count($GA_quest_const) - 1;
  for ($num_quest = 0; $num_quest < ($count_quest_status); $num_quest++){
      for ($num = 0; $num < ($count_quest_const); $num++){
          if ($GA_quest_status[$num_quest]['id_quest']==$GA_quest_const[$num]['id_quest']){
              echo '<div class="txt" id="quest_box'.$GA_quest_status[$num_quest]['id_quest'].'" onclick="get_quest_text('.$GA_quest_status[$num_quest]['id_quest'].')">';
              echo '<b>'.$GA_quest_const[$num]['name_quest'].'</b><br>';
              echo '</div><br>';

          }
      }
  }
  mysql_close($mysql_connect);
}
if ($_GET['action'] == 'one') {
  global $C_Numberic, $C_Text_noSpace;
  if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
    loging('Кука login не прошла валидацию.');
    exit;
  }
  if (!Chek_string_of_mask($_GET['num'], $C_Numberic)) {
    loging('get параметр num не прошёл валидацию.');
    exit;
  }
  $mysql_connect = F_Connect_MySQL();
  if (!F_IF_session()) {
    loging('Сессия игрока неактивна.');
    exit;
  }
  F_session_extension();
  $GA_quest_status          = array();
  $res_alle_quest_status    = mysql_query('SELECT * FROM `quest_status` WHERE `id_user`="'.F_Get_ID($_COOKIE['login']).'" and `id_quest`="'.$_GET['num'].'"');
  while ($GA_quest_status[] = mysql_fetch_array($res_alle_quest_status)); {
  }
  $count_quest_status       = count($GA_quest_status) - 1;
  if ($count_quest_status!=1)
      exit;
  $GA_quest_const          = array();
  $res_alle_quest_const    = mysql_query('SELECT * FROM `quest_const`');
  while ($GA_quest_const[] = mysql_fetch_array($res_alle_quest_const)); {
  }
  $count_quest_const    = count($GA_quest_const) - 1;
  $res_alle_progress    = mysql_query('SELECT * FROM `progress` WHERE `id_login`="'.F_Get_ID($_COOKIE['login']).'" LIMIT 1');
  $A_progress = mysql_fetch_array($res_alle_progress);
  for ($num_quest = 0; $num_quest < ($count_quest_status); $num_quest++){
      for ($num = 0; $num < ($count_quest_const); $num++){
          if ($GA_quest_status[$num_quest]['id_quest']==$GA_quest_const[$num]['id_quest']){
              echo '<table border="1"><tr><td>'.$GA_quest_const[$num]['name_quest'].'</td></tr><tr><td>';
              echo $GA_quest_const[$num]['descriptin_quest'].'</td></tr><tr><td>';
              if ($GA_quest_status[$num_quest]['id_quest']==1)
                  echo $A_progress['input'].'/10';
              if ($GA_quest_status[$num_quest]['id_quest']==2)
                  echo $A_progress['golden_room_worked'].'/2';
              echo '</td></tr></table>';
          }
      }
  }
  mysql_close($mysql_connect);
}
?>