<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/gameserver.php';
if ($_GET['action'] == 'listwork') {
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
  echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
  $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
  $arr_res_castle = mysql_fetch_array($res_castle);
  switch (true) {
    case ($arr_res_castle['c_' . $_GET['num_room'] . '_1'] != 0):
      $name_room    = $arr_res_castle['c_' . ($_GET['num_room']) . '_n'];
      $arr_res_room = mysql_fetch_array(mysql_query('SELECT * FROM haus WHERE `new`="' . ($name_room) . '"'));
      $worked       = floor($arr_res_castle['c_' . $_GET['num_room'] . '_2']);
      echo '<br><br><br>';
      echo '<input class="slider" type="range" min="0" max="' . $arr_res_room['max_men'] . '" value="' . $worked . '" id="range_people_at_work" oninput="CorrectMenForWorkCH(' . $arr_res_room['men'] . ', ' . $arr_res_room['max_men'] . ',' . floor($arr_res_castle['men']) . ',' . $worked . ', '.-($arr_res_castle['c_' . $_GET['num_room'] . '_1']).', '.$arr_res_castle['c_' . $_GET['num_room'] . '_2'].')"><br>';
      echo '<span id="will_men_to_work">' . $worked . ' из ' . $arr_res_room['max_men'] . '</span><br>';
      echo 'Будет дополнительно отправлено: <span id="add_to_works">0</span><br>';
      echo '<center>Останется времени до озавершения: <span id="time_of_work">'.int_to_time(-($arr_res_castle['c_' . $_GET['num_room'] . '_1'])).'</span> из <span id="def_time_of_work">'.int_to_time($arr_res_room['default_time']).'</span></center><br>';
      echo '<center><a class="tooltip class-link big-text" href="#" onclick="ChangeMen(' . $_GET['num_room'] . ')">Принять</a></center>';
      break;
    case ($arr_res_castle['c_' . $_GET['num_room'] . '_1'] == 0):
      global $Max_level_HAUS;
      $name_alt_room         = $arr_res_castle['c_' . ($_GET['num_room']) . '_n'];
      $arr_res_room_for_work = array();
      if (onlyInt($name_alt_room) == 0)
        $res_room_for_work = mysql_query('SELECT * FROM haus WHERE ((id mod ' . $Max_level_HAUS . ')=' . (onlyInt($name_alt_room) + 1) . ')');
      else
        $res_room_for_work = mysql_query('SELECT * FROM haus WHERE `new`="' . (onlyNoInt($name_alt_room) . (onlyInt($name_alt_room) + 1)) . '"');
      while ($arr_res_room_for_work[] = mysql_fetch_array($res_room_for_work)); {
      }
      $count_room_for_work = count($arr_res_room_for_work) - 1;
      echo '<p>Для строительства доступно:</p>';
      for ($i = 0; $i < $count_room_for_work; $i++) {
        echo '<p><a class="tooltip class-link" onclick="StartWorkRoom(\'' . $arr_res_room_for_work[$i]['new'] . '\', ' . $_GET['num_room'] . ')">';
        $res_room_rus      = mysql_query('SELECT * FROM `haus_const` WHERE `name`="' . onlyNoInt($arr_res_room_for_work[$i]['new']) . '"');
        $arr_name_room_rus = mysql_fetch_array($res_room_rus);
        if (($arr_res_castle['gold'] >= $arr_res_room_for_work[$i]['gold']) AND ($arr_res_castle['tree'] >= $arr_res_room_for_work[$i]['tree']) AND ($arr_res_castle['stone'] >= $arr_res_room_for_work[$i]['stone']))
          echo $arr_name_room_rus['name_rus'] . ' ' . onlyInt($arr_res_room_for_work[$i]['new']) . ' уровня.';
        else
          echo '<strike>' . $arr_name_room_rus['name_rus'] . ' ' . onlyInt($arr_res_room_for_work[$i]['new']) . ' уровня.</strike>';
        echo '<span class="classic"><i>Описание: </i>' . $arr_name_room_rus['descr_rus'] . '<br><br>Требуется ресурсов:<br><b>';
        if ($arr_res_castle['gold'] < $arr_res_room_for_work[$i]['gold'])
          echo '<font color="red">Золото: ' . $arr_res_room_for_work[$i]['gold'] . '</font><br>';
        else
          echo 'Золото: ' . $arr_res_room_for_work[$i]['gold'] . '<br>';
        if ($arr_res_castle['tree'] < $arr_res_room_for_work[$i]['tree'])
          echo '<font color="red">Дерево: ' . $arr_res_room_for_work[$i]['tree'] . '</font><br>';
        else
          echo 'Дерево: ' . $arr_res_room_for_work[$i]['tree'] . '<br>';
        if ($arr_res_castle['stone'] < $arr_res_room_for_work[$i]['stone'])
          echo '<font color="red">Камень: ' . $arr_res_room_for_work[$i]['stone'] . '</font><br>';
        else
          echo 'Камень: ' . $arr_res_room_for_work[$i]['stone'] . '<br>';
        echo '</b>Время строительста: <b>' . int_to_time($arr_res_room_for_work[$i]['default_time']) . '</b><br>';
      }
      break;
  }
  mysql_close($mysql_connect);
}
?>