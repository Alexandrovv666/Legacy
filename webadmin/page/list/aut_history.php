<?php
           $login = $_GET['login'];
            echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
            echo '<center><h1><a href="index.php?page=player&login=' . $_COOKIE['login'] . '">Legacy of Warriors - admin panel</a></h1></center>';
            echo '<hr>';
            echo '<center><h2>История логинов пользователя "' . $login . '"</h2></center>';
            echo '<hr>';
            $res_list_user = mysql_query('SELECT * FROM `aut_history` WHERE `login`="' . $login . '"');
            $count_user    = mysql_num_rows($res_list_user);
            $A_list        = array();
            while ($A_list[] = mysql_fetch_array($res_list_user)); {
        }
            echo 'Всего записей - ' . $count_user;
            echo '<table border="1"><tr><td># п/п</td><td>Дата</td><td>Ip-адресс</td><td>Значение сессии</td><td>Значение агента</td></tr>';
            for ($i = 0; $i < $count_user; $i++) {
                $ip_adress  = $A_list[$i]['ip'];
                $user_agent = $A_list[$i]['user_agent'];
                echo '<tr><td>' . ($i + 1) . '</td><td>' . date("d-F-Y H:i:s", $A_list[$i]['time']) . '</td><td><a href="index.php?page=list&item=ip_adress&sub_item=' . $ip_adress . '">' . $ip_adress . '</a></td><td>' . $A_list[$i]['session'] . '</td><td>' . $user_agent . '</td></tr>';
            }
            echo '</table>';
?> 