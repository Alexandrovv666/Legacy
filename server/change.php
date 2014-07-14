<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'change') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        if (F_Is_Root_ID(F_Get_ID($_COOKIE['login']))){
            mysql_query('UPDATE `map` SET `terrain`="'.$_GET['n'].'" WHERE `x`="'.$_GET['X_map'].'" and `y`="'.$_GET['Y_map'].'" and `z`="'.$_GET['z_map'].'"');
            echo "<meta http-equiv=\"refresh\" content=\"0;url=http://legacyofwarriors/game\">".'<img src="Img/interface/other/loading.gif" width="34px">';
        }
    }
    FClose_mysql_connect($mysql_connect);
?>