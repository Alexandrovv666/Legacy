<?php
    include '../FUNC.php';
    $linkss = FConnBase();
    echo '<!DOCTYPE html><title>����������� ���������.</title>';
    echo '<div style="position: absolute; top: 10px; left: 10px">';
    echo '<table border="1" cellpadding="1" width="1200" bgcolor="F0F8F9"><tr><td>���������</td><td width="170">����� ���������</td></tr>';
    $res_mail = mysql_query("SELECT * FROM `mail` WHERE (`adresat` =  '�������������') ORDER BY `mail`.`date` DESC ");
    for ($i = 0;$i < mysql_num_rows($res_mail);$i++) {
        $arr_mail = mysql_fetch_array($res_mail);
        $txt_mail = $arr_mail['text'];
        $txt_mail = str_replace('_���������_�������_', "'", $txt_mail);
        $txt_mail = str_replace('_�������_�������_', '"', $txt_mail);
        echo '<tr id="Mail"><td>
        <b>' . $arr_mail['zagolowok'] . '</b>
        <div id="load_mail_'.$arr_mail['date'].'">'.$txt_mail.'</div>
        <details>
         <summary>��������</summary>
          <form action="send.php" method="post">
           <p><i>��������</i></p>
           <p><input type="text" name="nick" value="'.$arr_mail['autor'].'"></p>
           <p><textarea rows="10" cols="45" name="text">'.$txt_mail."\r\n"."\r\n".'����� �������������:'."\r\n".'</textarea></p>
           <p><input type="submit" value="��������"></p>
          </form>
        </details>
        </td><td>' . (date('Y-m-d H:i:s', $arr_mail['date'])) . '</td></tr>';
    }
    echo '</table>';
    echo '</div>';
    FClose_mysql_connect($linkss);
?>