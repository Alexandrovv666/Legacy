<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    $linkss = F_Connect_MySQL();
    global $C_Numberic, $C_Text_noSpace;
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/security.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/security_loop.php';
    F_session_extension();
    if ($_GET['action'] == 'list') {
        $R_mail = mysql_query('SELECT * FROM `mail` WHERE `id_ziel`="' . (F_Get_ID($_COOKIE['login'])) . '" AND `time_end`<"' . time() . '" ORDER BY `time_end` DESC');
        $A_mail       = array();
        while ($A_mail[] = mysql_fetch_array($R_mail)); { }
        $count_mail           = count($A_mail) - 1;
        echo 'ok|����� - ��������|';
        if ($count_mail>0){
            echo '<table border="1"><tr><td>���</td><td width="170px">���������</td><td>����</td><td width="90px">�����</td></tr>';
            for ($num_mail = 0; $num_mail < ($count_mail); $num_mail++){
                $icon = $A_mail[$num_mail]['icon'];
                $caption = $A_mail[$num_mail]['caption'];
                $text = $A_mail[$num_mail]['text'];
                $id_autor = $A_mail[$num_mail]['id_autor'];
                $time_end = $A_mail[$num_mail]['time_end'];
                echo '<tr><td>'.$icon.'</td><td><details><summary><strong>'.$caption.'</strong></summary>'.$text.'</details></td><td>'.date("d F   H:i:s",$time_end).'</td><td>'.F_Get_Login($id_autor).'</td></tr>';
            }
            echo '</table>';
        }else
            echo '����� ���<br>';
        echo '<text onclick="api_window_modal_message_get_data(\'server/mail.php?action=new\')">(��������)</text>';
    }
    if ($_GET['action'] == 'new') {
        echo 'ok|����� - ����� ������|';
        echo '<center>��������!<br>� ������ ������/��������� ��������� ������ ������� ��������, �������� ����� � �����.<br>� ������� ��������� - ������ ���������� �� �����.</center>';
        echo '<textarea id="z" cols="50" rows="1">����������</textarea>';
        echo '<textarea id="cap" cols="50" rows="1">����</textarea>';
        echo '<textarea id="txt" cols="80" rows="4">�����</textarea>';
        echo '<text onclick="api_window_modal_message_send_data(\'server/mail.php?action=plus\',\'mail\')">���������</text><br><br><br>';
        echo '<text onclick="api_window_modal_message_get_data(\'server/mail.php?action=list\')">��������� �� ��������</text>';
    }
    if ($_GET['action'] == 'get_info') {
        echo 'ok|����� - ������ - �������������� ��������|';
        echo '<center>��������!<br>� ������ ������/��������� ��������� ������ ������� ��������, �������� ����� � �����.<br>� ������� ��������� - ������ ���������� �� �����.</center>';
        echo '<textarea id="z" cols="50" rows="1">����������</textarea>';
        echo '<textarea id="cap" cols="50" rows="1">����</textarea>';
        echo '<textarea id="txt" cols="80" rows="4">�����</textarea>';
        echo '<text onclick="api_window_modal_message_send_data(\'server/mail.php?action=plus\',\'mail\')">���������</text><br><br><br>';
        echo '<text onclick="api_window_modal_message_get_data(\'server/mail.php?action=list\')">��������� �� ��������</text>';
    }
    if ($_GET['action'] == 'plus') {
        mysql_query('INSERT INTO `mail` (`time_start`, `time_end`, `caption`, `text`, `id_autor`, `id_ziel`) VALUES 
                                ("'.time().'","'.(time()+1).'","'.($_GET['cap']).'","'.($_GET['txt']).'","'.(F_Get_ID($_COOKIE['login'])).'","'.(F_Get_ID($_GET['z'])).'")');
        echo 'ok|����� - ������ ����������|';
        echo '<text onclick="api_window_modal_message_get_data(\'server/mail.php?action=list\')">��������� �� ��������</text>';
    }
    mysql_Close($linkss);
?>