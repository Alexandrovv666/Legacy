<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'room_name') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        $arr_res_castle = mysql_fetch_array($res_castle);
        $name_room      = ($arr_res_castle['room_name_' . $_GET['num_room']]);
        if ($name_room == '')
            echo '(������)';
        if (onlyNoInt($name_room) == "lesop")
            echo '(������� ������� �� ������ ' . onlyInt($name_room) . ' ������)';
        if (onlyNoInt($name_room) == "kamen")
            echo '(������� ������� �� ����� ' . onlyInt($name_room) . ' ������)';
        if (onlyNoInt($name_room) == "lavka")
            echo '(������� �������� ' . onlyInt($name_room) . ' ������)';
        if (onlyNoInt($name_room) == "issled")
            echo '(������� ������������� ' . onlyInt($name_room) . ' ������)';
        if (onlyNoInt($name_room) == "nos")
            echo '(������� ���������� ' . onlyInt($name_room) . ' ������)';
        if (onlyNoInt($name_room) == "voin")
            echo '(������� ���������� ' . onlyInt($name_room) . ' ������)';
        if (onlyNoInt($name_room) == "kon")
            echo '(������� �������� ' . onlyInt($name_room) . ' ������)';
        if (onlyNoInt($name_room) == "tank")
            echo '(������� ������ ' . onlyInt($name_room) . ' ������)';
        if (onlyNoInt($name_room) == "bival")
            echo '(������� ������� ' . onlyInt($name_room) . ' ������)';
        if (onlyNoInt($name_room) == "lekar")
            echo '(������� ������� ' . onlyInt($name_room) . ' ������)';
        if (onlyNoInt($name_room) == "naim")
            echo '(������� ���������� ' . onlyInt($name_room) . ' ������)';
    }
    FClose_mysql_connect($mysql_connect);
?>