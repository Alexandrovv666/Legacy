<?php
    include '../API.php';
    include '../Constant.php';
    if ($_GET['action'] == 'StartWorkRoom') {
        $mysql_connect = FConnBase();
        global $C_Numberic, $C_Text_noSpace;
        if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
            loging('���� login �� ������ ���������.');
            exit;
        }
        if (!Chek_string_of_mask($_COOKIE['X'], $C_Numberic)) {
            loging('���� X �� ������ ���������.');
            exit;
        }
        if (!Chek_string_of_mask($_COOKIE['Y'], $C_Numberic)) {
            loging('���� Y �� ������ ���������');
            exit;
        }
        if (!Chek_string_of_mask($_COOKIE['Z'], $C_Numberic)) {
            loging('���� Z �� ������ ���������');
            exit;
        }
        if (!F_IF_session()) {
            loging('������ ������ ���������.');
            exit;
        }
        if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
            loging('get �������� num_room �� ������ ���������.');
            exit;
        }
        if (!Chek_string_of_mask($_GET['name'], $C_Text_noSpace.$C_Numberic)) {
            loging('get �������� name �� ������ ���������.');
            exit;
        }
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
        $arr_res_castle = mysql_fetch_array($res_castle);
                $res_room_for_work     = mysql_query('SELECT * FROM haus WHERE `new`="' . $_GET['name'] . '"');
                $arr_res_room_for_work = mysql_fetch_array($res_room_for_work);
                    echo '<p><a class="tooltip class-link" href="#" onclick="StartWorkRoom(\'' . $arr_res_room_for_work[$i]['new'] . '\', ' . $_GET['num_room'] . ')">';
                    $res_room_rus      = mysql_query('SELECT * FROM `haus_const` WHERE `name`="' . onlyNoInt($arr_res_room_for_work['new']) . '"');
                    $arr_name_room_rus = mysql_fetch_array($res_room_rus);
                    echo $arr_name_room_rus['name_rus'] . ' ' . onlyInt($arr_res_room_for_work['new']) . ' ������.</a></p>';
                    echo '<i>��������:</i>'.$arr_name_room_rus['descr_rus'].'<br>��������� ��������:<br><b>';
                    if ($arr_res_castle['gold'] < $arr_res_room_for_work['gold'])
                        echo '<font color="red">������: ' . $arr_res_room_for_work['gold'] . '</font><br>';
                    else
                        echo '������: ' . $arr_res_room_for_work['gold'] . '<br>';
                    if ($arr_res_castle['tree'] < $arr_res_room_for_work[$i]['tree'])
                        echo '<font color="red">������: ' . $arr_res_room_for_work['tree'] . '</font><br>';
                    else
                        echo '������: ' . $arr_res_room_for_work['tree'] . '<br>';
                    
                    if ($arr_res_castle['gold'] < $arr_res_room_for_work[$i]['gold'])
                        echo '<font color="red">������: ' . $arr_res_room_for_work['stone'] . '</font><br>';
                    else
                        echo '������: ' . $arr_res_room_for_work['stone'] . '<br>';
                    $VarMen = $arr_res_room_for_work['men'];
                    if ($arr_res_castle['men']<$VarMen)
                        $VarMen=$arr_res_castle['men'];
                    echo '<br><input type=range min=0 max='.$arr_res_room_for_work['men'].' value='.$VarMen.' id="men_for_work" oninput="CorrectMenForWork('.$arr_res_room_for_work['men'].','.$arr_res_castle['men'].')"><br>';
                    echo '<p id="men_to_work_user">'.$VarMen.'/'.$arr_res_room_for_work['men'].'</p><br>';

    }
    FClose_mysql_connect($mysql_connect);


?>