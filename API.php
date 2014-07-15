<?
include 'Constant.php';
function FConnBase(){
    global $C_MySQL_Host, $C_MySQL_login;
    $link = mysql_connect($C_MySQL_Host, $C_MySQL_login, "") or die('Пожалуйста, перезагрузите страницу.<br>Если подобное повторяется, свяжитесь с Администрацией и сообщите ей сообщение ошибки.<br>Сообщение <u>'.mysql_error().'</u>');
    mysql_select_db('game') or die('Пожалуйста, перезагрузите страницу.<br>Если подобное повторяется, свяжитесь с Администрацией и сообщите ей сообщение ошибки.<br>Сообщение: <b><u>'.mysql_error().'</u></b>');
    mysql_set_charset("CP1251");
    return $link;
}

function FClose_mysql_connect($link){
    mysql_close($link);
}

function Chek_string_of_mask($String, $Mask){
    $Lenght_String = strlen($String);
    if ($Lenght_String==0)
        return false;
    for ($i = 0; $i < ($Lenght_String); $i++)
        if (substr_count($Mask, $String[$i])==0)
            return false;
    return true;
}

function loging($text){
    $file_name = '../log/gl.log';
    $file = fopen($file_name,"a+");
    fwrite($file, add_length_string(date("Y-m-d H:i:s"),19).$text."\r\n");
    fclose($file);
}
function loging__($text){
    $file_name = 'log/gl.log';
    $file = fopen($file_name,"a+");
    fwrite($file, add_length_string(date("Y-m-d H:i:s"),19).$text."\r\n");
    fclose($file);
}

function F_Loging($namefile,$text){
    $file = fopen($namefile,"a+");
    fwrite($file, add_length_string(date("Y-m-d H:i:s"),19).$text."\r\n");
    fclose($file);
}

function F_Transaction(){
    while (mysql_num_rows(mysql_query('SELECT * FROM `settings` WHERE `name_parametr`="TRANSACTION" and `Value`="1"'))==1)
        sleep(1);
}

function mysql_table_seek($tablename, $dbname){
    $table_list = mysql_query("SHOW TABLES FROM `".$dbname."`");
    while ($row = mysql_fetch_row($table_list))
        if ($tablename==$row[0])
            return true;
    return false;
}

function add_length_string($text, $length){
    while (strlen($text)<$length)
        $text=' '.$text;
    return $text;
}

function F_stepen($x, $n){
    for ($i = 1; $i < ($n); $i++)
        $x=$x*$x;
    return $x;
}
function F_time_tren($name_room){
    $res_army_param     = mysql_query('SELECT * FROM `army_baze` WHERE `name`="' . onlyNoInt($name_room) . '"');
    $arr_res_army_param = mysql_fetch_array($res_army_param);
    return floor(($arr_res_army_param['time_arb'] * (0.25 - ((onlyInt($name_room)-1)/100))));
}

function F_time_towork($name_new_room_mysql){
    $res_room   = mysql_query('SELECT * FROM `haus` WHERE `new_room`="' . $name_new_room_mysql . '"');
    $arr_room   = mysql_fetch_array($res_room);
    return ($arr_room['gold']+$arr_room['tree']*10+$arr_room['stone']*30*onlyInt($name_new_room_mysql));
}

function SQLQWERY_Log($x){
    $res=mysql_query($x);
    $fp = fopen('mysql_query.log', 'a+');
    fwrite($fp, $x.PHP_EOL);
    fclose($fp);
    return $res;
}

function onlyInt($int_text){
    for ($i = 0; $i < strlen($int_text); $i++)
        if (is_numeric($int_text[$i]))
            $res=$res.$int_text[$i];
    return $res;
}
function onlyNoInt($int_text){
    for ($i = 0; $i < strlen($int_text); $i++)
        if (!(is_numeric($int_text[$i])))
            $res=$res.$int_text[$i];
    return $res;
}
function FShowNumInSpace($x){
    return str_replace(",", '  ', number_format($x));
}
function FAlgin($x,$n){
    return str_replace(",", '  ', number_format($x));
}
function F_Text_Login_Password($text){
    $table_list = mysql_query('SELECT * FROM `users`');
    while ($row = mysql_fetch_row($table_list))
        if (strtolower($Login)==strtolower($row[0]))
            return true;
    return false;
}

function F_login_is_now($login){
//requirements: Link to Database is true
    $res = mysql_query('SELECT login FROM `users` WHERE `login`="'.$login.'"');
    if (mysql_num_rows($res)==1)
        return true;
    return false;
}

function F_GetRand_IDLogin(){
//requirements: Link to Database is true
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
//requirements: Link to Database is true
    $arr_res_user = mysql_fetch_array(mysql_query('SELECT id FROM `users` WHERE `login` ="' . $login . '"'));
    return $arr_res_user['id'];
}

function F_Get_login($id){
//requirements: Link to Database is true
    $arr_res_user = mysql_fetch_array(mysql_query('SELECT login FROM `users` WHERE `id` ="' . $id . '"'));
    return $arr_res_user['login'];
}

function F_Is_Root_ID($ID){
//requirements: Link to Database is true
    if (mysql_num_rows(mysql_query('SELECT `value` FROM `privilege` WHERE `ID`="'.$ID.'" and `value`="root"'))==1)
            return true;
    return false;
}

function F_login_ban_is_now($Login){
//requirements: Link to Database is true
    $table_list = mysql_query('SELECT * FROM `ban_list` WHERE `time_end`>"'.time().'"');
    while ($row = mysql_fetch_row($table_list))
        if (strtolower($Login)==strtolower($row[1]))
            return true;
    return false;
}

function Is_Local_IP(){
    if ($_SERVER['REMOTE_ADDR'] == $_SERVER['SERVER_ADDR'])
        return true;
    return false;
}

function Only_Local_IP(){
    if (!Is_Local_IP()){
        header("HTTP/1.0 404 Not Found");
        echo 'Страница не найдена';
        exit;
    }
}

function Shans($x){
    if ($x>=100)
        return true;
    if ($x<=0)
        return false;
    if (rand(0,100)<=$x)
        return true;
    return false;
}

function Is_Local_Subnetwork(){
    $ip_client = $_SERVER['REMOTE_ADDR'];
    $results   = strripos($ip_client, '192.168.1.');
    if ($results !== false)
        return true;
    $results   = strripos($ip_client, '192.168.0.');
    if ($results !== false)
        return true;
    return false;
}

function F_session(){
//requirements: Link to Database is true
    global $Lang_session;
    if (mysql_table_seek("session","game")){
        if (mysql_num_rows(mysql_query('SELECT * FROM  `session` WHERE (`login`="'.($_COOKIE['login']).'") AND (`time`>"'.(time()-$Lang_session).'") and (`session`="'.$_COOKIE['session'].'") and (`ip`="'.$_SERVER['REMOTE_ADDR'].'") and (`status`="1")'))==1){//session is active?
            mysql_query('UPDATE `session` SET `time`="'.time().'" WHERE `login`="'.($_COOKIE['login']).'"');
        }else{
            echo '<html><head><meta http-equiv=Refresh content="0; url=/Exit.php"></head></html>';
            exit;
        }
    }else{
        mysql_query('CREATE TABLE IF NOT EXISTS `session` ( `time` int(11) NOT NULL, `login` text NOT NULL, `status` int(11) NOT NULL, `ip` text NOT NULL, `session` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
        echo '<html><head><meta http-equiv=Refresh content="0; url=/Exit.php"></head></html>';
    }
}

function ShowMessage_and_exit($text){
    echo $text;
    $fp = fopen('error.txt', 'a+');
    fwrite($fp, int_to_time(time()).' > '.$text.PHP_EOL);
    fclose($fp);
    exit;
}

function F_distortion($num){
    if (rand(0,2)==1)
        return incPrz($num,rand(0,20));
    else
        return decPrz($num,rand(0,20));
}


function F_Create_Mail($adresat, $autor, $type, $theme,$text){
    SQLQWERY_Log('INSERT INTO `mail`(`adresat`, `autor`, `time`, `type`, `theme`, `text`) VALUES ("'.$adresat.'","'.$autor.'","'.time().'","'.$type.'","'.$theme.'","'.$text.'")');
}

function Function_gettime_for_databaze($x1,$y1,$z1,$x2,$y2,$z2){
    global $SpeedMission, $Addtime;
    $global_x1 = 15*$x1+($z1 % 15);
    $global_y1 = 07*$y1+floor($z1/15);
    $global_x2 = 15*$x2+($z2 % 15);
    $global_y2 = 07*$y2+floor($z2/15);
    $t = floor(sqrt(($global_x1 - $global_x2) * ($global_x1 - $global_x2) + ($global_y1 - $global_y2) * ($global_y1 - $global_y2)) * $SpeedMission) + $Addtime;
    return $t;
}
function gettime_of_path($x1,$y1,$z1,$x2,$y2,$z2){
    return 'Время в пути: ' . int_to_time(Function_gettime_for_databaze($x1,$y1,$z1,$x2,$y2,$z2));
}
function incPrz($chislo, $prz){
    return floor($chislo + ($chislo / 100 * $prz));
}
function decPrz($chislo, $prz){
    if ($prz>=100)
        return 0;
    return floor($chislo - ($chislo / 100 * $prz));
}
function FSowZnak($chislo){
    if ($chislo > 0)
        return '+' . $chislo . '%';
    if ($chislo < 0)
        return '-'.$chislo . '%';
    if ($chislo = 0)
        return '';
}
function int_to_time($int){
    if ($int==0)
        return "";
    $sec  = 0;
    $min  = 0;
    $hour = 0;
    $day  = 0;
    if ($int >= 86400){
        $day = floor($int / 86400);
        $int = $int - $day*86400;
    }
    if ($int >= 60*60*1){
        $hour = floor($int / (60*60));
        $int  = $int - $hour*60*60*1;
    }
    if ($int >= 60*1){
        $min = floor($int / 60);
        $int = $int - $min*60*1;
    }
    if ($int > 0)
        $sec = $int;
    if ($sec < 10)
        $sec = '0'.$sec;
    if ($min < 10)
        $min = '0'.$min;
    if ($hour < 10)
        $hour = '0'.$hour;
    if ($day < 10)
        $day = '0'.$day;
    return $day . ':'.$hour . ':'.$min . ':'.$sec;
}
function F_GetCount_mission_of_login($id){
    $res = mysql_query('SELECT * FROM  `missions` where `vladelez`="'.$id.'"');
    return mysql_num_rows($res);
}

?>