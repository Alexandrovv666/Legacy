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
            case ($arr_res_castle['c_' . $_GET['num_room'] . '_1'] < 0):
                echo '<p>������� ��������.</p><p>**��������� ������������� �� <a class="tooltip" href="#" onclick="donat_work(' . $_GET['num_room'] . ')">' . $Cost_work_money_speed . '<span class="classic">����� ������ ������ � ������ ����� �������� ' . $Cost_work_money_speed . ' �������.<br>��� ���� ������������� ��������� ���������.</span></a> �������.</p>';
                break;
            case ($arr_res_castle['c_' . $_GET['num_room'] . '_1'] > 0):
                echo "���-�� ��������";
                break;
            case ($arr_res_castle['c_' . $_GET['num_room'] . '_1'] == 0):
                global $Max_level_HAUS;
                $name_alt_room         = $arr_res_castle['c_' . ($_GET['num_room']) . '_n'];
                $arr_res_room_for_work = array();
                $res_room_for_work     = mysql_query('SELECT * FROM haus WHERE ((id mod ' . $Max_level_HAUS . ')=' . (onlyInt($name_alt_room) + 1) . ')');
                while ($arr_res_room_for_work[] = mysql_fetch_array($res_room_for_work)); {
            }
                $count_room_for_work = count($arr_res_room_for_work) - 1;
                echo '<p>��� ������������� ��������:</p>';
                for ($i = 0; $i < $count_room_for_work; $i++) {
                    echo '<p><a class="tooltip class-link" href="#" onclick="StartWorks(\'' . $arr_res_room_for_work[$i]['new'] . '\', ' . $_GET['num_room'] . ')">';
                    if (($arr_res_castle['gold'] >= $arr_res_room_for_work[$i]['gold']) AND ($arr_res_castle['tree'] >= $arr_res_room_for_work[$i]['tree']) AND ($arr_res_castle['stone'] >= $arr_res_room_for_work[$i]['stone']))
                        echo onlyNoInt($arr_res_room_for_work[$i]['new']) . ' ' . onlyInt($arr_res_room_for_work[$i]['new']) . ' ������.';
                    else
                        echo '<strike>' . onlyNoInt($arr_res_room_for_work[$i]['new']) . ' ' . onlyInt($arr_res_room_for_work[$i]['new']) . ' ������.</strike>';
                    echo '<span class="classic">��������� ��������:<br><b>';
                    if ($arr_res_castle['gold'] < $arr_res_room_for_work[$i]['gold'])
                        echo '<font color="red">������: ' . $arr_res_room_for_work[$i]['gold'] . '</font><br>';
                    else
                        echo '������: ' . $arr_res_room_for_work[$i]['gold'] . '<br>';
                    if ($arr_res_castle['tree'] < $arr_res_room_for_work[$i]['tree'])
                        echo '<font color="red">������: ' . $arr_res_room_for_work[$i]['tree'] . '</font><br>';
                    else
                        echo '������: ' . $arr_res_room_for_work[$i]['tree'] . '<br>';
                    
                    if ($arr_res_castle['gold'] < $arr_res_room_for_work[$i]['gold'])
                        echo '<font color="red">������: ' . $arr_res_room_for_work[$i]['stone'] . '</font><br>';
                    else
                        echo '������: ' . $arr_res_room_for_work[$i]['stone'] . '<br>';
                    /*
                    echo '['.$arr_res_room_for_work[$i]['new'].'] ���������: <br>';
                    echo 'gold='.$arr_res_room_for_work[$i]['gold'].'<br>';
                    echo 'tree='.$arr_res_room_for_work[$i]['tree'].'<br>';
                    echo 'stone='.$arr_res_room_for_work[$i]['stone'].'<br>';
                    echo 'men='.$arr_res_room_for_work[$i]['men'].'<br>';
                    echo 'default_time='.$arr_res_room_for_work[$i]['default_time'].'<br>';
                    echo '<br>';*/
                    $true_time = $arr_res_room_for_work[$i]['default_time'];
                    $real_time = floor(100/$arr_res_castle['men']/100*$arr_res_room_for_work[$i]['men']);
                    if ($real_time<1)
                        $real_time=1;
                    echo '</b>����� ������������: <b>' . int_to_time($arr_res_room_for_work[$i]['default_time']*$real_time) . '</b>';
                    if ($real_time>1)
                        echo '<br>(~� '.$real_time.' ��� ������.)<br>';
                    echo '</span></a></del></p>';
                }
                break;
        }
    }
    FClose_mysql_connect($mysql_connect);














?>