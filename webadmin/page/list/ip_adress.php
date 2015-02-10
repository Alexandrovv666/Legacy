<?php
    //switch ($page) case 'player':
    $item = $_GET['item'];
    //switch ($item)case 'ip_adress':
            $ip_adress = $_GET['sub_item'];
            echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
            echo '<center><h1><a href="index.php?page=player&login=' . $_COOKIE['login'] . '">Legacy of Warriors - admin panel</a></h1></center>';
            echo '<hr>';
            echo '<center><h2>История логинов с адреса "' . $ip_adress . '"</h2></center>';
            echo '<hr>';
            $res_list_user = mysql_query('SELECT * FROM `aut_history` WHERE `ip`="' . $ip_adress . '"');
            $count_user    = mysql_num_rows($res_list_user);
            $A_list        = array();
            while ($A_list[] = mysql_fetch_array($res_list_user)); {
        }
            echo 'Всего записей - ' . $count_user;
            if ($count_user > 1) { //Если в таблитце больше 1й строчи, то есть смысл сравнивать
                $warning  = false;
                $alt_nick = '';
                for ($i = 0; $i < $count_user; $i++)
                    if ($alt_nick == '')
                        $alt_nick = $A_list[$i]['login'];
                    else if ($alt_nick != $A_list[$i]['login'])
                        $warning = true;
            }
            if ($warning)
                echo '<center><h3>Найдены совпадения</h3></center>';
            echo '<table border="1"><tr><td># п/п</td><td>Логин игрока</td><td>Дата</td><td>Ip-адресс</td><td>Значение сессии</td><td>Значение агента</td></tr>';
            for ($i = 0; $i < $count_user; $i++) {
                $ip_adress  = $A_list[$i]['ip'];
                $user_agent = $A_list[$i]['user_agent'];
                $nick       = $A_list[$i]['login'];
                if ($warning)
                    echo '<tr><td>' . ($i + 1) . '</td><td><a href="index.php?page=player&login=' . $nick . '"><b><font color="red">' . $nick . '</font></b></a></td><td>' . date("d-F-Y", $A_list[$i]['time']) . ' ' . date("H:i:s", $A_list[$i]['time']) . '</td><td><font color="blue">' . $ip_adress . '</font></td><td>' . $A_list[$i]['session'] . '</td><td>' . $user_agent . '</td></tr>';
                else
                    echo '<tr><td>' . ($i + 1) . '</td><td><a href="index.php?page=player&login=' . $nick . '">' . $nick . '</a></td><td>' . date("d-F-Y", $A_list[$i]['time']) . ' ' . date("H:i:s", $A_list[$i]['time']) . '</td><td><font color="blue">' . $ip_adress . '</font></td><td>' . $A_list[$i]['session'] . '</td><td>' . $user_agent . '</td></tr>';
            }
            echo '</table>';
?> 