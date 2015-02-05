<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/head.php';
    global $C_Numberic, $C_Text_noSpace;
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    $linkss = F_Connect_MySQL();
    $enable_access = false;
    $log_access = '';
    if (basename($_SERVER['PHP_SELF'])!='index.php'){
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='                                             W A R N I N G !'.PHP_EOL;
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='[!] -> Файл "webadmin/index.php" включили в файл "'.basename($_SERVER['PHP_SELF']).'"'.PHP_EOL;
        $log_access .='     > Выполнение скрипта остановленно ошибкой "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        http_response_code(404);
        header("404 Not Found");
        exit;
    }
    if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic))
        $log_access .='[!] -> Кука login не прошла валидацию.'.PHP_EOL;
    else{
        $log_access .= '[.] -> Login = '.$_COOKIE['login'].PHP_EOL;
        if (!Chek_string_of_mask($_COOKIE['session'], $C_Text_noSpace . $C_Numberic))
            $log_access .='[!] -> Кука session не прошла валидацию.'.PHP_EOL;
        else{
            $log_access .= '[.] -> Session = '.$_COOKIE['session'].PHP_EOL;
            if (!(F_login_is_now($_COOKIE['login'])))
                $log_access .='[!] -> Логин в базе не числится.'.PHP_EOL;
            else{
                $A = mysql_fetch_array(mysql_query('SELECT * FROM `privelege` WHERE `id_user`="'.F_Get_ID($_COOKIE['login']).'" LIMIT 1'));
                $privelege =  $A['root'] + $A['support'] + $A['cheater'];
                if ($privelege>0)
                    $enable_access = true;
            }
        }
    }
    if (!Chek_string_of_mask($_COOKIE['casX'], $C_Numberic)) {
        $log_access .='[!] -> Кука casX не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casY'], $C_Numberic)) {
        $log_access .='[!] -> Кука casY не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casZ'], $C_Numberic)) {
        $log_access .='[!] -> Кука casZ не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapX'], $C_Numberic)) {
        $log_access .='[!] -> Кука mapX не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapY'], $C_Numberic)) {
        $log_access .='[!] -> Кука mapY не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapZ'], $C_Numberic)) {
        $log_access .='[!] -> Кука mapZ не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!$enable_access){
        header("404 Not Found");
        http_response_code(404);
        $log_access .='     > Выполнение скрипта остановленно ошибкой "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        exit;
    }
    $log_access .='     > Доступ предоставлен.'.PHP_EOL;
    $page = $_GET['page'];
    $action = $_GET['action'];
    switch ($page) {
        case 'player':
            $login = $_GET['login'];
            echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
            echo '<center><h1><a href="index.php?page=player&login='.$_COOKIE['login'].'">Legacy of Warriors - admin panel</a></h1></center>';
            echo '<hr>';
            echo '<center><h2>Пользователь "'.$login.'"</h2></center>';
            echo '<hr>';
            echo 'Права: ';
            $Arr_table_privelege_of_player = mysql_fetch_array(mysql_query('SELECT * FROM `privelege` WHERE `id_user`="'.F_Get_ID($login).'" LIMIT 1'));
            if ($Arr_table_privelege_of_player['root']==1)
                echo '<b><a href="index.php?page=list&item=admin">Админ</a></b>, ';
            if ($Arr_table_privelege_of_player['support']==1)
                echo '<b><a href="index.php?page=list&item=support">Техническая поддержка</a></b>, ';
            if ($Arr_table_privelege_of_player['cheater']==1)
                echo '<b><a href="index.php?page=list&item=cheater">Сотрудник</a></b>, ';
            echo '<a href="index.php?page=list&item=none">Игрок</a><br>';
            $Arr_table_user_of_player = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login`="'.$login.'" LIMIT 1'));
            echo 'Дата регистрации: '.date("Y-m-d H:i:s", $Arr_table_user_of_player['reg_time']).' (Совершённые действия)<br>';
            if (($A['root']==1) or ($A['cheater']==1))
                echo 'Внутренний счёт: '.$Arr_table_user_of_player['almaz'].' алмазов (история платежей)<br>';
            $count_aut_of_player = mysql_num_rows(mysql_query('SELECT ip FROM `aut_history` WHERE `login`="'.$login.'"'));
            if (($A['root']==1) or ($A['cheater']==1))
            echo 'Количество авторизаций: '.$count_aut_of_player.' (<a href="index.php?page=list&item=aut_history&login='.$login.'">История авторизаций</a>)<br>';
        break;
        case 'list':
            $item=$_GET['item'];
            switch ($item) {
                case 'ip_adress':
                    $ip_adress = $_GET['sub_item'];
                    echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
                    echo '<center><h1><a href="index.php?page=player&login='.$_COOKIE['login'].'">Legacy of Warriors - admin panel</a></h1></center>';
                    echo '<hr>';
                    echo '<center><h2>История логинов с адреса "'.$ip_adress.'"</h2></center>';
                    echo '<hr>';
                    $res_list_user = mysql_query('SELECT * FROM `aut_history` WHERE `ip`="'.$ip_adress.'"');
                    $count_user = mysql_num_rows($res_list_user);
                    $A_list   = array();
                    while ($A_list[] = mysql_fetch_array($res_list_user));{}
                    echo 'Всего записей - '.$count_user;
                    if ($count_user>1){//Если в таблитце больше 1й строчи, то есть смысл сравнивать
                        $warning = false;
                        $alt_nick = '';
                        for ($i = 0; $i < $count_user; $i++)
                            if ($alt_nick == '')
                                $alt_nick = $A_list[$i]['login'];
                            else
                                if ($alt_nick != $A_list[$i]['login'])
                                    $warning = true;
                    }
                    if ($warning)
                        echo '<center><h3>Найдены совпадения</h3></center>';
                    echo '<table border="1"><tr><td># п/п</td><td>Логин игрока</td><td>Дата</td><td>Ip-адресс</td><td>Значение сессии</td><td>Значение агента</td></tr>';
                    for ($i = 0; $i < $count_user; $i++){
                        $ip_adress = $A_list[$i]['ip'];
                        $user_agent = $A_list[$i]['user_agent'];
                        $nick = $A_list[$i]['login'];
                        if ($warning)
                            echo '<tr><td>'.($i+1).'</td><td><a href="index.php?page=player&login='.$nick.'"><b><font color="red">'.$nick.'</font></b></a></td><td>'.date("d-F-Y", $A_list[$i]['time']).' '.date("H:i:s", $A_list[$i]['time']).'</td><td><font color="blue">'.$ip_adress.'</font></td><td>'.$A_list[$i]['session'].'</td><td>'.$user_agent.'</td></tr>';
                        else
                            echo '<tr><td>'.($i+1).'</td><td><a href="index.php?page=player&login='.$nick.'">'.$nick.'</a></td><td>'.date("d-F-Y", $A_list[$i]['time']).' '.date("H:i:s", $A_list[$i]['time']).'</td><td><font color="blue">'.$ip_adress.'</font></td><td>'.$A_list[$i]['session'].'</td><td>'.$user_agent.'</td></tr>';
                    }
                    echo '</table>';
                break;
                case 'aut_history':
                    $login = $_GET['login'];
                    echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
                    echo '<center><h1><a href="index.php?page=player&login='.$_COOKIE['login'].'">Legacy of Warriors - admin panel</a></h1></center>';
                    echo '<hr>';
                    echo '<center><h2>История логинов пользователя "'.$login.'"</h2></center>';
                    echo '<hr>';
                    $res_list_user = mysql_query('SELECT * FROM `aut_history` WHERE `login`="'.$login.'"');
                    $count_user = mysql_num_rows($res_list_user);
                    $A_list   = array();
                    while ($A_list[] = mysql_fetch_array($res_list_user));{}
                    echo 'Всего записей - '.$count_user;
                    echo '<table border="1"><tr><td># п/п</td><td>Дата</td><td>Ip-адресс</td><td>Значение сессии</td><td>Значение агента</td></tr>';
                    for ($i = 0; $i < $count_user; $i++){
                        $ip_adress = $A_list[$i]['ip'];
                        $user_agent = $A_list[$i]['user_agent'];
                        echo '<tr><td>'.($i+1).'</td><td>'.date("d-F-Y H:i:s", $A_list[$i]['time']).'</td><td><a href="index.php?page=list&item=ip_adress&sub_item='.$ip_adress.'">'.$ip_adress.'</a></td><td>'.$A_list[$i]['session'].'</td><td>'.$user_agent.'</td></tr>';
                    }
                    echo '</table>';
                break;
                case 'none':
                    echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
                    echo '<center><h1><a href="index.php?page=player&login='.$_COOKIE['login'].'">Legacy of Warriors - admin panel</a></h1></center>';
                    echo '<hr>';
                    echo '<center><h2>Список всех пользователей</h2></center>';
                    echo '<hr>';
                    $res_list_user = mysql_query('SELECT * FROM `users`');
                    $count_user = mysql_num_rows($res_list_user);
                    $arr_list_user   = array();
                    while ($arr_list_user[] = mysql_fetch_array($res_list_user));{}
                    echo 'Всего уч записей - '.$count_user;
                    echo '<table border="1"><tr><td>Ник игрока</td></tr>';
                    for ($i = 0; $i < $count_user; $i++){
                        $nick = ($arr_list_user[$i]['login']);
                        echo '<tr><td><a href="index.php?page=player&login='.$nick.'">'.$nick.'</a></td></tr>';
                    }
                    echo '</table>';
                break;
                case 'support':
                    echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
                    echo '<center><h1><a href="index.php?page=player&login='.$_COOKIE['login'].'">Legacy of Warriors - admin panel</a></h1></center>';
                    echo '<hr>';
                    echo '<center><h2>Список пользователей с правами "Админ"</h2></center>';
                    echo '<hr>';
                    $res_list_support = mysql_query('SELECT * FROM `privelege` WHERE `support`="1"');
                    $count_support = mysql_num_rows($res_list_support);
                    $arr_list_support   = array();
                    while ($arr_list_support[] = mysql_fetch_array($res_list_support));{}
                    echo 'Всего уч записей с правами Техническая поддержка - '.$count_support;
                    echo '<table border="1"><tr><td>Ник игрока</td></tr>';
                    for ($i = 0; $i < $count_support; $i++){
                        $nick = F_Get_login($arr_list_support[$i]['id_user']);
                        echo '<tr><td><a href="index.php?page=player&login='.$nick.'">'.$nick.'</a></td></tr>';
                    }
                    echo '</table>';
                    echo '<a href="index.php?page=list&item=none">Посмотреть список всех игроков.</a>';
                break;
                case 'cheater':
                    echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
                    echo '<center><h1><a href="index.php?page=player&login='.$_COOKIE['login'].'">Legacy of Warriors - admin panel</a></h1></center>';
                    echo '<hr>';
                    echo '<center><h2>Список пользователей с правами "Админ"</h2></center>';
                    echo '<hr>';
                    $res_list_cheater = mysql_query('SELECT * FROM `privelege` WHERE `cheater`="1"');
                    $count_cheater = mysql_num_rows($res_list_cheater);
                    $arr_list_cheater   = array();
                    while ($arr_list_cheater[] = mysql_fetch_array($res_list_cheater));{}
                    echo 'Всего уч записей с правами Сотрудник - '.$count_cheater;
                    echo '<table border="1"><tr><td>Ник игрока</td></tr>';
                    for ($i = 0; $i < $count_cheater; $i++){
                        $nick = F_Get_login($arr_list_cheater[$i]['id_user']);
                        echo '<tr><td><a href="index.php?page=player&login='.$nick.'">'.$nick.'</a></td></tr>';
                    }
                    echo '</table>';
                    echo '<a href="index.php?page=list&item=none">Посмотреть список всех игроков.</a>';
                break;
                case 'admin':
                    echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
                    echo '<center><h1><a href="index.php?page=player&login='.$_COOKIE['login'].'">Legacy of Warriors - admin panel</a></h1></center>';
                    echo '<hr>';
                    echo '<center><h2>Список пользователей с правами "Админ"</h2></center>';
                    echo '<hr>';
                    $res_list_admin = mysql_query('SELECT * FROM `privelege` WHERE `root`="1"');
                    $count_admin = mysql_num_rows($res_list_admin);
                    $arr_list_admin   = array();
                    while ($arr_list_admin[] = mysql_fetch_array($res_list_admin));{}
                    echo 'Всего уч записей с правами Админ - '.$count_admin;
                    echo '<table border="1"><tr><td>Ник игрока</td></tr>';
                    for ($i = 0; $i < $count_admin; $i++){
                        $nick = F_Get_login($arr_list_admin[$i]['id_user']);
                        echo '<tr><td><a href="index.php?page=player&login='.$nick.'">'.$nick.'</a></td></tr>';
                    }
                    echo '</table>';
                    echo '<a href="index.php?page=list&item=none">Посмотреть список всех игроков.</a>';
                break;
                default:
                    header("Location: index.php?page=player&login=".$_COOKIE['login']);
            }
        break;
        default:
            header("Location: index.php?page=player&login=".$_COOKIE['login']);
    }
    log_admin($log_access);
    F_session_extension();
    mysql_close($linkss);
?> 