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
        $log_access .='[!] -> ���� "webadmin/index.php" �������� � ���� "'.basename($_SERVER['PHP_SELF']).'"'.PHP_EOL;
        $log_access .='     > ���������� ������� ������������ ������� "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        http_response_code(404);
        header("404 Not Found");
        exit;
    }
    if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic))
        $log_access .='[!] -> ���� login �� ������ ���������.'.PHP_EOL;
    else{
        $log_access .= '[.] -> Login = '.$_COOKIE['login'].PHP_EOL;
        if (!Chek_string_of_mask($_COOKIE['session'], $C_Text_noSpace . $C_Numberic))
            $log_access .='[!] -> ���� session �� ������ ���������.'.PHP_EOL;
        else{
            $log_access .= '[.] -> Session = '.$_COOKIE['session'].PHP_EOL;
            if (!(F_login_is_now($_COOKIE['login'])))
                $log_access .='[!] -> ����� � ���� �� ��������.'.PHP_EOL;
            else{
                $A = mysql_fetch_array(mysql_query('SELECT * FROM `privelege` WHERE `id_user`="'.F_Get_ID($_COOKIE['login']).'" LIMIT 1'));
                $privelege =  $A['root'] + $A['support'] + $A['cheater'];
                if ($privelege>0)
                    $enable_access = true;
            }
        }
    }
    if (!Chek_string_of_mask($_COOKIE['casX'], $C_Numberic)) {
        $log_access .='[!] -> ���� casX �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casY'], $C_Numberic)) {
        $log_access .='[!] -> ���� casY �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casZ'], $C_Numberic)) {
        $log_access .='[!] -> ���� casZ �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapX'], $C_Numberic)) {
        $log_access .='[!] -> ���� mapX �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapY'], $C_Numberic)) {
        $log_access .='[!] -> ���� mapY �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapZ'], $C_Numberic)) {
        $log_access .='[!] -> ���� mapZ �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!$enable_access){
        header("404 Not Found");
        http_response_code(404);
        $log_access .='     > ���������� ������� ������������ ������� "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        exit;
    }
    $log_access .='     > ������ ������������.'.PHP_EOL;
    $page = $_GET['page'];
    $action = $_GET['action'];
    switch ($page) {
        case 'player':
            $login = $_GET['login'];
            echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
            echo '<center><h1><a href="index.php?page=player&login='.$_COOKIE['login'].'">Legacy of Warriors - admin panel</a></h1></center>';
            echo '<hr>';
            echo '<center><h2>������������ "'.$login.'"</h2></center>';
            echo '<hr>';
            echo '�����: ';
            $Arr_table_privelege_of_player = mysql_fetch_array(mysql_query('SELECT * FROM `privelege` WHERE `id_user`="'.F_Get_ID($login).'" LIMIT 1'));
            if ($Arr_table_privelege_of_player['root']==1)
                echo '<b><a href="index.php?page=list&item=admin">�����</a></b>, ';
            if ($Arr_table_privelege_of_player['support']==1)
                echo '<b><a href="index.php?page=list&item=support">����������� ���������</a></b>, ';
            if ($Arr_table_privelege_of_player['cheater']==1)
                echo '<b><a href="index.php?page=list&item=cheater">���������</a></b>, ';
            echo '<a href="index.php?page=list&item=none">�����</a><br>';
            $Arr_table_user_of_player = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login`="'.$login.'" LIMIT 1'));
            echo '���� �����������: '.date("Y-m-d H:i:s", $Arr_table_user_of_player['reg_time']).' (����������� ��������)<br>';
            if (($A['root']==1) or ($A['cheater']==1))
                echo '���������� ����: '.$Arr_table_user_of_player['almaz'].' ������� (������� ��������)<br>';
            $count_aut_of_player = mysql_num_rows(mysql_query('SELECT ip FROM `aut_history` WHERE `login`="'.$login.'"'));
            if (($A['root']==1) or ($A['cheater']==1))
            echo '���������� �����������: '.$count_aut_of_player.' (<a href="index.php?page=list&item=aut_history&login='.$login.'">������� �����������</a>)<br>';
        break;
        case 'list':
            $item=$_GET['item'];
            switch ($item) {
                case 'ip_adress':
                    $ip_adress = $_GET['sub_item'];
                    echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
                    echo '<center><h1><a href="index.php?page=player&login='.$_COOKIE['login'].'">Legacy of Warriors - admin panel</a></h1></center>';
                    echo '<hr>';
                    echo '<center><h2>������� ������� � ������ "'.$ip_adress.'"</h2></center>';
                    echo '<hr>';
                    $res_list_user = mysql_query('SELECT * FROM `aut_history` WHERE `ip`="'.$ip_adress.'"');
                    $count_user = mysql_num_rows($res_list_user);
                    $A_list   = array();
                    while ($A_list[] = mysql_fetch_array($res_list_user));{}
                    echo '����� ������� - '.$count_user;
                    if ($count_user>1){//���� � �������� ������ 1� ������, �� ���� ����� ����������
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
                        echo '<center><h3>������� ����������</h3></center>';
                    echo '<table border="1"><tr><td># �/�</td><td>����� ������</td><td>����</td><td>Ip-������</td><td>�������� ������</td><td>�������� ������</td></tr>';
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
                    echo '<center><h2>������� ������� ������������ "'.$login.'"</h2></center>';
                    echo '<hr>';
                    $res_list_user = mysql_query('SELECT * FROM `aut_history` WHERE `login`="'.$login.'"');
                    $count_user = mysql_num_rows($res_list_user);
                    $A_list   = array();
                    while ($A_list[] = mysql_fetch_array($res_list_user));{}
                    echo '����� ������� - '.$count_user;
                    echo '<table border="1"><tr><td># �/�</td><td>����</td><td>Ip-������</td><td>�������� ������</td><td>�������� ������</td></tr>';
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
                    echo '<center><h2>������ ���� �������������</h2></center>';
                    echo '<hr>';
                    $res_list_user = mysql_query('SELECT * FROM `users`');
                    $count_user = mysql_num_rows($res_list_user);
                    $arr_list_user   = array();
                    while ($arr_list_user[] = mysql_fetch_array($res_list_user));{}
                    echo '����� �� ������� - '.$count_user;
                    echo '<table border="1"><tr><td>��� ������</td></tr>';
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
                    echo '<center><h2>������ ������������� � ������� "�����"</h2></center>';
                    echo '<hr>';
                    $res_list_support = mysql_query('SELECT * FROM `privelege` WHERE `support`="1"');
                    $count_support = mysql_num_rows($res_list_support);
                    $arr_list_support   = array();
                    while ($arr_list_support[] = mysql_fetch_array($res_list_support));{}
                    echo '����� �� ������� � ������� ����������� ��������� - '.$count_support;
                    echo '<table border="1"><tr><td>��� ������</td></tr>';
                    for ($i = 0; $i < $count_support; $i++){
                        $nick = F_Get_login($arr_list_support[$i]['id_user']);
                        echo '<tr><td><a href="index.php?page=player&login='.$nick.'">'.$nick.'</a></td></tr>';
                    }
                    echo '</table>';
                    echo '<a href="index.php?page=list&item=none">���������� ������ ���� �������.</a>';
                break;
                case 'cheater':
                    echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
                    echo '<center><h1><a href="index.php?page=player&login='.$_COOKIE['login'].'">Legacy of Warriors - admin panel</a></h1></center>';
                    echo '<hr>';
                    echo '<center><h2>������ ������������� � ������� "�����"</h2></center>';
                    echo '<hr>';
                    $res_list_cheater = mysql_query('SELECT * FROM `privelege` WHERE `cheater`="1"');
                    $count_cheater = mysql_num_rows($res_list_cheater);
                    $arr_list_cheater   = array();
                    while ($arr_list_cheater[] = mysql_fetch_array($res_list_cheater));{}
                    echo '����� �� ������� � ������� ��������� - '.$count_cheater;
                    echo '<table border="1"><tr><td>��� ������</td></tr>';
                    for ($i = 0; $i < $count_cheater; $i++){
                        $nick = F_Get_login($arr_list_cheater[$i]['id_user']);
                        echo '<tr><td><a href="index.php?page=player&login='.$nick.'">'.$nick.'</a></td></tr>';
                    }
                    echo '</table>';
                    echo '<a href="index.php?page=list&item=none">���������� ������ ���� �������.</a>';
                break;
                case 'admin':
                    echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
                    echo '<center><h1><a href="index.php?page=player&login='.$_COOKIE['login'].'">Legacy of Warriors - admin panel</a></h1></center>';
                    echo '<hr>';
                    echo '<center><h2>������ ������������� � ������� "�����"</h2></center>';
                    echo '<hr>';
                    $res_list_admin = mysql_query('SELECT * FROM `privelege` WHERE `root`="1"');
                    $count_admin = mysql_num_rows($res_list_admin);
                    $arr_list_admin   = array();
                    while ($arr_list_admin[] = mysql_fetch_array($res_list_admin));{}
                    echo '����� �� ������� � ������� ����� - '.$count_admin;
                    echo '<table border="1"><tr><td>��� ������</td></tr>';
                    for ($i = 0; $i < $count_admin; $i++){
                        $nick = F_Get_login($arr_list_admin[$i]['id_user']);
                        echo '<tr><td><a href="index.php?page=player&login='.$nick.'">'.$nick.'</a></td></tr>';
                    }
                    echo '</table>';
                    echo '<a href="index.php?page=list&item=none">���������� ������ ���� �������.</a>';
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