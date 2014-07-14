<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'room_name') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        $arr_res_castle = mysql_fetch_array($res_castle);
        $name_room      = ($arr_res_castle['room_name_' . $_GET['num_room']]);
        if ($name_room == '')
            echo '(Пустая)';
        if (onlyNoInt($name_room) == "lesop")
            echo '(Комната мастера по дереву ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "kamen")
            echo '(Комната мастера по камню ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "lavka")
            echo '(Комната торговца ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "issled")
            echo '(Комната исследователя ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "nos")
            echo '(Комната щитоносцов ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "voin")
            echo '(Комната ополченцов ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "kon")
            echo '(Комната конников ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "tank")
            echo '(Комната танков ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "bival")
            echo '(Комната бывалых ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "lekar")
            echo '(Комната лекарей ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "naim")
            echo '(Комната сорвиголов ' . onlyInt($name_room) . ' уровня)';
    }
    FClose_mysql_connect($mysql_connect);
?>