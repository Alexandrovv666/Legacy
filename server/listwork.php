<?php
    include '../API.php';
    include '../Constant.php';
    if ($_GET['action'] == 'listwork') {
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
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
        $arr_res_castle = mysql_fetch_array($res_castle);
        switch (true) {
            case ($arr_res_castle['c_' . $_GET['num_room'] . '_1'] != 0):
                $name_room     = $arr_res_castle['c_' . ($_GET['num_room']) . '_n'];
                $arr_res_room = mysql_fetch_array(mysql_query('SELECT * FROM haus WHERE `new`="' . ($name_room).'"'));
                echo '<p>������� ��������.</p><p>**��������� ������������� �� <a class="tooltip" href="#" onclick="donat_work(' . $_GET['num_room'] . ')">' . $Cost_work_money_speed . '<span class="classic">����� ������ ������ � ������ ����� �������� ' . $Cost_work_money_speed . ' �������.<br>��� ���� ������������� ��������� ���������.</span></a> �������.</p>';
                $VarMen = floor($arr_res_castle['c_' . $_GET['num_room'] . '_2']);
                $V_MaxMenToWorkOfCastle = $arr_res_castle['c_' . $_GET['num_room'] . '_2']+$arr_res_castle['men'];
                echo '<br><input type=range min=0 max='.$arr_res_room['max_men'].' value='.$VarMen.' id="men_for_work" oninput="CorrectMenForWorkCH('.$arr_res_room['max_men'].','.floor($arr_res_castle['men']).','.$VarMen.')"><br>';
                echo '<p id="men_to_work_user">'.$VarMen.' / '.$arr_res_room['max_men'].'</p><br>';
                echo '[<a class="tooltip class-link" href="#" onclick="StartWorks(\''.$_GET['name'].'\','.$_GET['num_room'].')">������ �������!</a>]<br>';
                echo '����� ���������� <p id="to_works">'.($VarMen).'</p> ������<br>';
                echo '<p class="small-text">����� ��������� �� ����� '.floor($V_MaxMenToWorkOfCastle).'</p><br>';










                break;
            case ($arr_res_castle['c_' . $_GET['num_room'] . '_1'] == 0):
                global $Max_level_HAUS;
                $name_alt_room         = $arr_res_castle['c_' . ($_GET['num_room']) . '_n'];
                $arr_res_room_for_work = array();
                if (onlyInt($name_alt_room)==0)
                    $res_room_for_work     = mysql_query('SELECT * FROM haus WHERE ((id mod ' . $Max_level_HAUS . ')=' . (onlyInt($name_alt_room) + 1) . ')');
                else
                    $res_room_for_work     = mysql_query('SELECT * FROM haus WHERE `new`="' . (onlyNoInt($name_alt_room).(onlyInt($name_alt_room) + 1)).'"');
                while ($arr_res_room_for_work[] = mysql_fetch_array($res_room_for_work)); {
                }
                $count_room_for_work = count($arr_res_room_for_work) - 1;
                echo '<p>��� ������������� ��������:</p>';
                for ($i = 0; $i < $count_room_for_work; $i++) {
                    echo '<p><a class="tooltip class-link" onclick="StartWorkRoom(\'' . $arr_res_room_for_work[$i]['new'] . '\', ' . $_GET['num_room'] . ')">';
                    $res_room_rus  = mysql_query('SELECT * FROM `haus_const` WHERE `name`="' . onlyNoInt($arr_res_room_for_work[$i]['new']) . '"');
                    $arr_name_room_rus = mysql_fetch_array($res_room_rus);
                    if (($arr_res_castle['gold'] >= $arr_res_room_for_work[$i]['gold']) AND ($arr_res_castle['tree'] >= $arr_res_room_for_work[$i]['tree']) AND ($arr_res_castle['stone'] >= $arr_res_room_for_work[$i]['stone']))
                        echo $arr_name_room_rus['name_rus'] . ' ' . onlyInt($arr_res_room_for_work[$i]['new']) . ' ������.';
                    else
                        echo '<strike>' . $arr_name_room_rus['name_rus'] . ' ' . onlyInt($arr_res_room_for_work[$i]['new']) . ' ������.</strike>';
                    echo '<span class="classic"><i>��������: </i>'.$arr_name_room_rus['descr_rus'].'<br><br>��������� ��������:<br><b>';
                    if ($arr_res_castle['gold'] < $arr_res_room_for_work[$i]['gold'])
                        echo '<font color="red">������: ' . $arr_res_room_for_work[$i]['gold'] . '</font><br>';
                    else
                        echo '������: ' . $arr_res_room_for_work[$i]['gold'] . '<br>';
                    if ($arr_res_castle['tree'] < $arr_res_room_for_work[$i]['tree'])
                        echo '<font color="red">������: ' . $arr_res_room_for_work[$i]['tree'] . '</font><br>';
                    else
                        echo '������: ' . $arr_res_room_for_work[$i]['tree'] . '<br>';
                    if ($arr_res_castle['stone'] < $arr_res_room_for_work[$i]['stone'])
                        echo '<font color="red">������: ' . $arr_res_room_for_work[$i]['stone'] . '</font><br>';
                    else
                        echo '������: ' . $arr_res_room_for_work[$i]['stone'] . '<br>';
                    echo '</b>����� ������������: <b>' . int_to_time($arr_res_room_for_work[$i]['default_time']) . '</b><br>';
                }
                break;
        }
    }
    FClose_mysql_connect($mysql_connect);














?>