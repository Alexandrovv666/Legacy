<?php
    include '../FUNC.php';
    FConnBase();
    mysql_query( 'INSERT INTO `history`(`login`, `ip`, `uid`, `uuid`, `url`, `time`) VALUES ("' . addslashes( $_COOKIE[ 'Login' ] ) . '","' . $_SERVER[ 'REMOTE_ADDR' ] . '","' . addslashes( $_COOKIE[ 'UID' ] ) . '","' . addslashes( $_COOKIE[ 'UUID' ] ) . '","' . addslashes( $_SERVER[ 'REQUEST_URI' ] ) . '","' . time() . '")' );
    echo '<div style="position: absolute; top: 0px; left: 60px"><img src="../img/interface/panel.png" width="450"></div>';
    echo '<div style="position: absolute; top: 010px; left: 50px"><b>����������</b></div>';
    echo '<div style="position: absolute; top: 030px; left: 10px"><a href="index.php">�������</a></div>';
    echo '<div style="position: absolute; top: 050px; left: 10px"><a href="index.php?site=castle">�����</a></div>';
    echo '<div style="position: absolute; top: 070px; left: 10px"><a href="index.php?site=panel">������ ��������</a></div>';
    echo '<div style="position: absolute; top: 090px; left: 10px"><a href="index.php?site=arbeit">�������</a></div>';
    echo '<div style="position: absolute; top: 110px; left: 10px"><a href="index.php?site=add">������ � ���������� ��������</a></div>';
    echo '<div style="position: absolute; top: 130px; left: 10px"><b>������ ��������</b></div>';
    echo '<div style="position: absolute; top: 150px; left: 10px"><a href="index.php?site=cookie">�������� � ������</a></div>';
    $site = $_GET['site'];
    $out = '';
    if ($site == ''){
        $out = '<h1>�������</h1>����� ���������� � ������������.<br><h2>���������� � ��������.</h2>1. ���� ������ ���� �������� (���� ��������� �������� � ������).<br>2. ��� �������, ������ ���� ������ �� ���� ���: ';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox') )  $out .= '3.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Chrome') )   $out .= '3.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Safari') )   $out .= '3.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Opera') )    $out .= '10.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') ) $out .= '7.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') ) $out .= '7.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') ) $out .= '7.0';
    }
    if ($site == 'castle')
        $out = '<h1>�����</h1>������ ��� ����� �����, ��� ���� �����.<br>�������� �� ����';
    if ($site == 'cookie'){
        $out = '<h1>����</h1>��� ���� ���������� �������� ����.<br><h2>������� ��������� ��� ��� ������ ��������</h2>';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox') )  $out .= '';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Chrome') )   $out .= '������� � ���� "���������".<br><img src="img/chrome/1.png" width="400"><br><br>� ���� ������ ������� "cookie" � ������� �� ������ "��������� ��������".<br><img src="img/chrome/2.png" width="700"><br><br>���������� ������������� ��� �������� ����.<br><img src="img/chrome/3.png" width="600"><br><br>';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Safari') )   $out .= '';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Opera') )    $out .= '';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') ) $out .= '';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') ) $out .= '';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') ) $out .= '';
    }

    echo '<div style="position: absolute; top: 10px; left: 350px">'.$out.'</div>';
?>