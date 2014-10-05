<?
include $_SERVER['DOCUMENT_ROOT'].'/_constant/mysql.php';
include $_SERVER['DOCUMENT_ROOT'].'/_constant/_session.php';
function F_Connect_MySQL(){
    global $C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password;
    $link = mysql_connect($C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password);
    mysql_select_db('game');
    mysql_set_charset("CP1251");
    return $link;
}
function F_TranzationUp(){
    mysql_query("UPDATE `settings` SET `Value`='1' WHERE `name_parametr`='TRANSACTION'");
}
function F_TranzationDown(){
    mysql_query("UPDATE `settings` SET `Value`='0' WHERE `name_parametr`='TRANSACTION'");
}
function F_Transaction(){
    while (mysql_num_rows(mysql_query('SELECT * FROM `settings` WHERE `name_parametr`="TRANSACTION" and `Value`="1"'))==1)
        sleep(1);
}
function F_mysql_table_seek($tablename, $dbname){
    $table_list = mysql_query("SHOW TABLES FROM `".$dbname."`");
    while ($row = mysql_fetch_row($table_list))
        if ($tablename==$row[0])
            return true;
    return false;
}
function F_login_is_now($login){
    $arr = mysql_fetch_row(mysql_query('SELECT * FROM `users` WHERE `login`="'.$login.'"'));
    if (strtolower($login)==strtolower($arr[1]))
        return true;
    return false;
}
function F_Get_Rand_ID(){
    $res_user = mysql_query('SELECT id FROM `users`');
    if (mysql_num_rows($res_user)>0){
        $res_user = mysql_query('SELECT id FROM `users` LIMIT '.rand(0,mysql_num_rows($res_user)-1).',1');
        $arr_res_user = mysql_fetch_array($res_user);
        $count_user = mysql_num_rows($res_user);
        return $arr_res_user['id'];
    }
    return '0';
}
function F_Get_ID($login){
    $arr_res_user = mysql_fetch_array(mysql_query('SELECT id FROM `users` WHERE `login` ="' . $login . '"'));
    return $arr_res_user['id'];
}
function F_Get_login($id){
    $arr_res_user = mysql_fetch_array(mysql_query('SELECT login FROM `users` WHERE `id` ="' . $id . '"'));
    return $arr_res_user['login'];
}
function F_Is_Root_ID($ID){
    if (mysql_num_rows(mysql_query('SELECT `id_user` FROM `privelege` WHERE `id_user`="'.$ID.'" and `root`="1"'))==1)
        return true;
    return false;
}
function F_session_extension(){
    global $Lang_session;
    if (mysql_num_rows(mysql_query('SELECT * FROM  `session` WHERE (`login`="'.($_COOKIE['login']).'") AND (`time`>"'.(time()-$Lang_session).'") and (`session`="'.$_COOKIE['session'].'") and (`ip`="'.$_SERVER['REMOTE_ADDR'].'")'))==1){
        mysql_query('UPDATE `session` SET `time`="'.time().'" WHERE `login`="'.($_COOKIE['login']).'"');
    }else{
        echo '<html><head><meta http-equiv=Refresh content="0; url=/Exit.php"></head></html>';
        exit;
    }
}
function F_IF_session(){
    global $Lang_session;
    if (mysql_num_rows(mysql_query('SELECT * FROM  `session` WHERE (`login`="'.($_COOKIE['login']).'") AND (`time`>"'.(time()-$Lang_session).'") and (`session`="'.$_COOKIE['session'].'") and (`ip`="'.$_SERVER['REMOTE_ADDR'].'")'))==1)
        return true;
    else
        return false;
}
?>