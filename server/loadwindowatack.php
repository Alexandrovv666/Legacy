<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'loadwindowatack') {
        $arr_res_castle = mysql_fetch_array($res_castle);
        echo '<table border="1" cellpadding="1"><tr>';
        for ($i = 1; $i <= 8; $i++)
            echo '
<td>
    <table>
        <tr>
            <td>
                <img src="Img/Units/army/' . $i . '.png" width="63">
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <input type="range" min="0" max="' . $arr_res_castle['army_' . $i] . '" id="rangearmy' . $i . '" oninput="correct_army()" value="0" style="width:38px">
                </center>
                <div id="army_in_atack' . $i . '">
                    ***
                </div>
                ����: ' . $arr_res_castle['army_' . $i] . '
            </td>
        </tr>
    </table>
</td>';
        echo '</tr></table>';
        $summ_count_army = 0;
        for ($i = 1; $i <= 8; $i++)
            $summ_count_army = $summ_count_army + $arr_res_castle['army_' . $i];
        if ($summ_count_army > 0)
            echo '<br><center><div onclick="Start_atack_mission('.$_GET['z2'].')">��������� � �����!</div></center><br><b><u>��� ������������ ������ "�����".<br>����������, ����������� ��� � ����� �������. ��� ������, ��� �����.<br>������� �� ���������.</u><b>';
        else
            echo '<br><center><b><u>�� �������� ����������� ������.</u><b></center>';
    }
    FClose_mysql_connect($mysql_connect);
?>