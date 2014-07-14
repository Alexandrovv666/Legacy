<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ( $act == 'mission' ) {
        if ($_GET['d']!=''){
            $A_r_m = mysql_fetch_array(mysql_query("SELECT * FROM `missions` WHERE ((`vladelez`='" . ($_COOKIE['login']) . "') and (`id`='".$_GET['d']."'))"));
            mysql_query('UPDATE `missions` SET `time_finish`="'.($A_r_m['dlina']-$A_r_m['time_finish']).'",`napravlen`="1" WHERE `id`="'.$_GET['d'].'"');
        }
        $count_Mission = 0;
        $res_user      = mysql_query('SELECT id FROM  `users` WHERE  `id` =  "' . $_COOKIE['login'] . '"');
        $Array_user    = mysql_fetch_array($res_user);
        $res           = mysql_query("SELECT * FROM `castle` WHERE (`id` = '" . $Array_user['id'] . "')");
        $a_stadt       = mysql_fetch_array($res);
        $result_miss   = mysql_query("SELECT * FROM `missions` WHERE ((`vladelez`='" . ($_COOKIE['login']) . "') OR (`id_ziel`='" . ($_COOKIE['login']) . "')) ORDER BY `time_finish` ASC")or die(mysql_error());
        $count_Mission = mysql_num_rows($result_miss);
        if ($count_Mission!=0){
            global $Max_Player_Mission;
            echo '<br>всего миссий '.F_GetCount_mission_of_login($_COOKIE['login']).'/'.$Max_Player_Mission.'<br>';
            echo '<div class="scroll"><table border="1" cellpadding="0" bgcolor="F0F8F9" width="760px">';
            for ($i = 0; $i < ($count_Mission); $i++) {
                $arr_result_miss = mysql_fetch_array($result_miss);
                if ($arr_result_miss['napravlen'] == 1){
                   echo '<tr><td width="500px">[' . $arr_result_miss['k_x'] . '-' . $arr_result_miss['k_y'] . '-' . $arr_result_miss['k_z'] . '] => [' . $arr_result_miss['ist_x'] . '-' . $arr_result_miss['ist_y'] . '-' . $arr_result_miss['ist_z'] . '](Возвращение)</td><td width="80px">Осталось </td><td width="30px"><p id="timer_miss'.($i+1).'">'.int_to_time($arr_result_miss['time_finish']).'</p></td></tr>';
                }else{
                   echo '<tr><td width="500px">[' . $arr_result_miss['ist_x'] . '-' . $arr_result_miss['ist_y'] . '-' . $arr_result_miss['ist_z'] . '] => [' . $arr_result_miss['k_x'] . '-' . $arr_result_miss['k_y'] . '-' . $arr_result_miss['k_z'] . ']             </td><td width="80px">Осталось </td><td width="30px"><p id="timer_miss'.($i+1).'">'.int_to_time($arr_result_miss['time_finish']).'</p></td> <td width="20"><a onclick="CMission('.$arr_result_miss['id'].')"><=</a></td>  </tr>';
                }
            }
            echo '</table></div>';
        }else
            echo '<br><br>Нет ниодной миссии.<br><br>';
    }
    FClose_mysql_connect($mysql_connect);
?>