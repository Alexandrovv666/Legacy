<?
include $_SERVER['DOCUMENT_ROOT'].'/_api/_api_micro_db.php';
include $_SERVER['DOCUMENT_ROOT'].'/_var/Micro_db.php';
function Micro_DB_connect($name, $login, $Pass, $Mode){
/*
Name - имя базы данных (1..6 символов. ингл символы нижнего регистра.)
Mode - режим подключения 
0 - быстрый. без логов, вообще
1 - логи пользователей без времени
2 - логи пользователей + время
3 - логи доступа к таблицам + пользователи + время
4 - лог запросов + пользователи + время
*/
  if (Micro_DB_if_file_exists('users.mdb')){
  }

}
?>