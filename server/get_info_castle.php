<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'get_info_castle') {
        echo '����� ����� ����� ��� �������� ���������� � �����.';
    }
    FClose_mysql_connect($mysql_connect);
?>