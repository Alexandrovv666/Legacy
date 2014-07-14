<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'loadwindowspy'){
    $res_lager = mysql_query('SELECT * FROM `lager` WHERE `x`="'.$_GET['x2'].'" and `y`="' . $_GET['y2'] . '" and `z`="' . $_GET['z2'] . '"');
    if (mysql_num_rows($res_lager)==1){
        $A_lager = mysql_fetch_array($res_lager);
        $mail_adresat = $_COOKIE['login'];
        $mail_autor = 'Шпион';
        $mail_type = 3;
        $mail_theme = 'Результаты шпионажа';
        $mail_text = 'В лагере ['.$_GET['x2'].'-'.$_GET['y2'].'-'.$_GET['z2'].'] обнаружены следующие войска:<br>';
        $mail_text=$mail_text.$A_lager['army_1'].' - '.$A_lager['army_2'].' - '.$A_lager['army_3'].' - '.$A_lager['army_4'].' - '.$A_lager['army_5'].' - '.$A_lager['army_6'].' - '.$A_lager['army_7'].' - '.$A_lager['army_8'];
        $mail_text=$mail_text.'<br>Они охраняют следующее количество ресурсов:<br>';
        $mail_text=$mail_text.'<br>золото - '.F_distortion($A_lager['gold']);
        $mail_text=$mail_text.'<br>дерево - '.F_distortion($A_lager['tree']);
        $mail_text=$mail_text.'<br>камень - '.F_distortion($A_lager['stone']);

        F_Create_Mail($mail_adresat, $mail_autor, $mail_type, $mail_theme,$mail_text);
        echo '<br><br><center>Отчёт сохранён в почтовом ящике.</center>';
        }
    else
        echo '<br><br><center><b><u>Модуль "Шпионаж" не введён.</u><b></center>';
    }
    FClose_mysql_connect($mysql_connect);
?>