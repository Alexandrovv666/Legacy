<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'getsvariants_mission') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';

        if (mysql_num_rows(mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_GET['x2'] . '" and `y`="' . $_GET['y2'] . '" and `z`="' . $_GET['z2'] . '"')) == 1){
            if (mysql_num_rows(mysql_query('SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_GET['x2'] . '" and `y`="' . $_GET['y2'] . '" and `z`="' . $_GET['z2'] . '"')) == 1)
                echo '<div href="#close" onclick="go_to_castle()">����� � ���� �����</div>';
            else
                echo '<div>������� ������ ������� ������</div>';
        }
        if (mysql_num_rows(mysql_query('SELECT * FROM `see_lager` WHERE `' . ($_COOKIE['login']) . '` = "1" and `x`="' . $_GET['x2'] . '" and `y`="' . $_GET['y2'] . '" and `z`="' . $_GET['z2'] . '"')) == 1)
            echo '<div onclick="StartAtack('.$_GET['z2'].')">��������� ������</div><div onclick="StartSpy('.$_GET['z2'].')">�������� ������</div>';
        if (F_Is_Root_ID(F_Get_ID($_COOKIE['login'])))
            echo '<br><br><br><font color="#C99"><b><i><a onclick="rechangemap('.$_GET['z2'].', 0)">�����.</a><br><a onclick="rechangemap('.$_GET['z2'].', 1)">�����.</a><br><a onclick="rechangemap('.$_GET['z2'].', 2)">����� �����.</a><br><a onclick="rechangemap('.$_GET['z2'].', 3)">���.</a><br><a onclick="rechangemap('.$_GET['z2'].', 4)">����.</a><br><a onclick="rechangemap('.$_GET['z2'].', 5)">�������.</a><br><a onclick="rechangemap('.$_GET['z2'].', 6)">�����.</a><br><a onclick="rechangemap('.$_GET['z2'].', 7)">������� �����.</a><br></i></b></font>';
    }
    FClose_mysql_connect($mysql_connect);
?>