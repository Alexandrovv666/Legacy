<?
    include '../API.php';
    include 'API.php';
    Only_Local_IP();
?>
<!DOCTYPE html>
<title>�������� ��������(���)</title>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="default.css">
<div id="site-head">
  <p id="text-head" class="text-head-class">
    Legacy of Warriors - �����-������
  </p>
  <div id="menu">
    <div id="bottom1" class="bottom">
      <p class="bottom-text">
        <a href="index.php">�������</a>
      </p>
    </div>
    <div id="bottom2" class="bottom">
      <p class="bottom-text">
        <a href="index.php?ort=Player">������</a>
      </p>
    </div>
    <div id="bottom3" class="bottom">
      <p class="bottom-text">
        <a href="index.php?ort=1">*</a>
      </p>
    </div>
    <div id="bottom4" class="bottom">
      <p class="bottom-text">
        <a href="index.php?ort=exit">�����</a>
      </p>
    </div>
  </div>
</div>
    <div id="content">
<?
    switch ($_GET['ort']) {
        case 'Player':
            {
                if ($_GET['login']==''){
                    $GlAP = array();
                    $linkss = FConnBase();
                    $list_Player = mysql_query('SELECT * FROM `users`');
                    FClose_mysql_connect($linkss);
                    while ($GlAP[] = mysql_fetch_array($list_Player)); {}
                    $count_player = count($GlAP) - 1;
                    echo '����� ������� �� �������: '.$count_player;
                    echo '<table border="1"><tr><td>�</td><td>��� ������</td><td>���������� ����</td><td>���� �����������</td></tr>';
                    for ($i = 0; $i < ($count_player); $i++)
                        if ($GlAP[$i]['reg_time']!=0)
                            echo '<tr><td>'.$GlAP[$i]['id'].'</td><td><a href="index.php?ort=Player&login='.$GlAP[$i]['login'].'">'.$GlAP[$i]['login'].'</a></td><td>'.$GlAP[$i]['almaz'].'</td><td>'.date("H:i:s Y-m-d", $GlAP[$i]['reg_time']).'</td></tr>';
                        else
                            echo '<tr><td>'.$GlAP[$i]['id'].'</td><td><a href="index.php?ort=Player&login='.$GlAP[$i]['login'].'">'.$GlAP[$i]['login'].'</a></td><td>'.$GlAP[$i]['almaz'].'</td><td><b><font color="#900">Testers account</font></b></td></tr>';
                    echo '</table>';
                }else{
                    $GlAP = array();
                    $linkss = FConnBase();
                    $list_Player = mysql_query('SELECT * FROM `users` where `login`="'.$_GET['login'].'"');
                    if (mysql_num_rows($list_Player)==0)
                        echo '<html><head><meta http-equiv=Refresh content="0; url=index.php?ort=Player"></head></html>';
                    $GlAP = mysql_fetch_array($list_Player);
                    $res_castle = mysql_query('SELECT id FROM `castle` where `id`="'.$GlAP['id'].'"');
                    FClose_mysql_connect($linkss);
                    echo '<table border="1">
                          <tr><td>���</td><td>'.$GlAP['login'].'</td></tr>
                          <tr><td>��� ������</td><td>'.confidential_text(confidential_text('<u>'.$GlAP['password'].'</u>')).'</td></tr>
                          <tr><td>���������� ����</td><td>'.confidential_text($GlAP['almaz']).'</td></tr>
                          <tr><td>���� �����������</td><td>'.confidential_text(date("H:i:s Y-m-d", $GlAP['reg_time'])).'</td></tr>
                          <tr><td>���������� �������</td><td>'.confidential_text(mysql_num_rows($res_castle).'<br><a href="index.php?ort=castle&id='.$GlAP['id'].'">��������� ������</a>').'</td></tr>
                          <tr><td>������� ���������</td><td>'.confidential_text('<a href="aserver.php?action=delete_player&login='.$GlAP['login'].'">X</a>').'</td></tr>
                          </table>';
                }
            }
            break;
        case 'castle':
            $GlobalArrCastle = array();
            $linkss = FConnBase();
            $list_Castle = mysql_query('SELECT * FROM `castle` where `id`="'.$_GET['id'].'"');
            FClose_mysql_connect($linkss);
            $count_Castle = mysql_num_rows($list_Castle);
            while ($GlobalArrCastle[] = mysql_fetch_array($list_Castle)); {}
            echo '<table border="1"><tr><td>X</td><td>Y</td><td>Z</td><td>��������</td><td>�����</td><td>������</td></tr>';
            $num_castle = 0;
            for ($num_castle = 0; $num_castle < ($count_Castle); $num_castle++)
                echo '<tr><td>'.$GlobalArrCastle[$num_castle]['x'].'</td><td>'.$GlobalArrCastle[$num_castle]['y'].'</td><td>'.$GlobalArrCastle[$num_castle]['z'].'</td><td>'.$GlobalArrCastle[$num_castle]['name'].'</td><td>???</td><td>???</td></tr>';
            echo '</table>';
            break;
        default:
            echo '�������� ����� ����';
            break;
    }

































?>
    </div>