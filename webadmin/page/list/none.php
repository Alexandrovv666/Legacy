<?php
            echo '<!DOCTYPE html lang="ru" xml:lang="ru"><title>Legacy of Warriors - admin panel</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="webadmin.js"></script>';
            echo '<center><h1><a href="index.php?page=player&login=' . $_COOKIE['login'] . '">Legacy of Warriors - admin panel</a></h1></center>';
            echo '<hr>';
            echo '<center><h2>Список всех пользователей</h2></center>';
            echo '<hr>';
            $res_list_user = mysql_query('SELECT * FROM `users`');
            $count_user    = mysql_num_rows($res_list_user);
            $arr_list_user = array();
            while ($arr_list_user[] = mysql_fetch_array($res_list_user)); {
        }
            echo 'Всего уч записей - ' . $count_user;
            echo '<table border="1"><tr><td>Ник игрока</td></tr>';
            for ($i = 0; $i < $count_user; $i++) {
                $nick = ($arr_list_user[$i]['login']);
                echo '<tr><td><a href="index.php?page=player&login=' . $nick . '">' . $nick . '</a></td></tr>';
            }
            echo '</table>';
?> 