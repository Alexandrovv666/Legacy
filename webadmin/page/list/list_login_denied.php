<?php
            echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
            echo '<center><h1><a href="index.php?page=player&login=' . $_COOKIE['login'] . '">Legacy of Warriors - admin panel</a></h1></center>';
            echo '<hr>';
            echo '<center><h2>Список запрещённых никнеймов.</h2></center>';
            echo '<hr>';
            $res_list_support = mysql_query('SELECT * FROM `privelege` WHERE `support`="1"');
            $count_support    = mysql_num_rows($res_list_support);
            $arr_list_support = array();
            while ($arr_list_support[] = mysql_fetch_array($res_list_support)); {
        }
            echo 'Всего уч записей с правами Техническая поддержка - ' . $count_support;
            echo '<table border="1"><tr><td>Ник игрока</td></tr>';
            for ($i = 0; $i < $count_support; $i++) {
                $nick = F_Get_login($arr_list_support[$i]['id_user']);
                echo '<tr><td><a href="index.php?page=player&login=' . $nick . '">' . $nick . '</a></td></tr>';
            }
            echo '</table>';
            echo '<a href="index.php?page=list&item=none">Посмотреть список всех игроков.</a>';
?> 