<?php
//switch ($page) case 'player':
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
?> 