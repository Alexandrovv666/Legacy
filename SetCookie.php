<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/log.php';
    $enable_access = false;
    $log_access = '';
    if (basename($_SERVER['PHP_SELF'])!='SetCookie.php'){
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='                                             W A R N I N G !'.PHP_EOL;
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='[!] -> Файл "SetCookie.php" включили в файл "'.basename($_SERVER['PHP_SELF']).'"'.PHP_EOL;
        $log_access .='     > Выполнение скрипта остановленно ошибкой "404 Not Found".'.PHP_EOL;
        loging($log_access);
        http_response_code(404);
        header("404 Not Found");
        exit;
    }
    $linkss = F_Connect_MySQL();
    if (!Chek_string_of_mask($_GET['login'], $C_Text_eng . $C_Numberic))
        $log_access .='[!] -> Кука login не прошла валидацию.'.PHP_EOL;
    else{
        $log_access .= '[.] -> Login = '.$_GET['login'].PHP_EOL;
        if (!(F_login_is_now($_GET['login']))){
            $log_access .='[!] -> Логин "'.$_GET['login'].'" в базе не числится.'.PHP_EOL;
        }else
            $enable_access = true;
    }
    $res_opening_Session = mysql_query('SELECT * FROM `session` WHERE (`login`="'.($_GET['login']).'") AND (`time`>"'.(time()-$Time_For_Open_Session).'") and (`ip`="'.$_SERVER['REMOTE_ADDR'].'") and (`status`="0pen") LIMIT 1');
    if (mysql_num_rows($res_opening_Session)!=1){
        echo 'Странно, для вас нет игры((';
        $log_access .='[!] -> Нет открывающихся сессий...'.PHP_EOL;
        loging($log_access);
        exit;
    }
    $data_session = mysql_fetch_array($res_opening_Session);
    mysql_query('UPDATE `session` SET `status`="open" WHERE (`time`="'.$data_session['time'].'") AND (`session`="'.$data_session['session'].'")');
    $arr_res_castle = mysql_fetch_array(mysql_query('SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID($_GET['login']) . '" LIMIT 1'));
    mysql_Close($linkss);
    SetCookie("login", $_GET['login']);
    SetCookie("session", $data_session['session']);
    SetCookie("casX",    $arr_res_castle['x']);
    SetCookie("casY",    $arr_res_castle['y']);
    SetCookie("casZ",    $arr_res_castle['z']);
    SetCookie("mapX",    $arr_res_castle['x']);
    SetCookie("mapY",    $arr_res_castle['y']);
    SetCookie("mapZ",    $arr_res_castle['z']);
    SetCookie("ort",     'castle');
    if (!$enable_access){
        http_response_code(404);
        header("404 Not Found");
        loging($log_access);
        exit;
    }
    header("Location: game.php");
?>  