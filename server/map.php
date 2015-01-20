<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
if ($_GET['action'] == 'get_info_cell') {
  $linkss = F_Connect_MySQL();
  global $C_Numberic, $C_Text_noSpace;
        include $_SERVER['DOCUMENT_ROOT'] . '/_api/security.php';
        if (!Chek_string_of_mask($_GET['z'], $C_Numberic)) {
            $log_access .= 'get параметр z не прошёл валидацию.' . PHP_EOL;
            loging($log_access);
            exit;
        } //!Chek_string_of_mask($_GET['num_room'], $C_Numberic)
  F_session_extension();
  echo 'ok|Информация о территории '.$_COOKIE['mapX'].' - '.$_COOKIE['mapY'].' - '.$_GET['z'].'|';
  echo '<span class="txt">';
  if (mysql_query('SELECT id FROM `castle` WHERE `x`="' . $_COOKIE['casX'] . '" AND `y`="' . $_COOKIE['casY'] . '" AND `z`="' . $_GET['z'] . '"')==1)
    echo 'замок';
  echo '</span>';
  mysql_Close($linkss);
}
?>