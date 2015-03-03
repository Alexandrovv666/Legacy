<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/head.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    $linkss = F_Connect_MySQL();
    $enable_access = false;
    $log_access = '';
    if (basename($_SERVER['PHP_SELF'])!='index.php'){
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='                                             W A R N I N G !'.PHP_EOL;
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='[!] -> ���� "webadmin/index.php" �������� � ���� "'.basename($_SERVER['PHP_SELF']).'"'.PHP_EOL;
        $log_access .='     > ���������� ������� ������������ ������� "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        http_response_code(404);
        header("404 Not Found");
        exit;
    }
    if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_eng . $C_Numberic))
        $log_access .='[!] -> ���� login �� ������ ���������.'.PHP_EOL;
    else{
        $log_access .= '[.] -> Login = '.$_COOKIE['login'].PHP_EOL;
        if (!Chek_string_of_mask($_COOKIE['session'], $C_Text_eng . $C_Numberic))
            $log_access .='[!] -> ���� session �� ������ ���������.'.PHP_EOL;
        else{
            $log_access .= '[.] -> Session = '.$_COOKIE['session'].PHP_EOL;
            if (!(F_login_is_now($_COOKIE['login'])))
                $log_access .='[!] -> ����� � ���� �� ��������.'.PHP_EOL;
            else{
                $A = mysql_fetch_array(mysql_query('SELECT * FROM `privelege` WHERE `id_user`="'.F_Get_ID($_COOKIE['login']).'" LIMIT 1'));
                $privelege =  $A['root'] + $A['support'] + $A['cheater'];
                if ($privelege>0)
                    $enable_access = true;
            }
        }
    }
    if (!Chek_string_of_mask($_COOKIE['casX'], $C_Numberic)) {
        $log_access .='[!] -> ���� casX �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casY'], $C_Numberic)) {
        $log_access .='[!] -> ���� casY �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casZ'], $C_Numberic)) {
        $log_access .='[!] -> ���� casZ �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapX'], $C_Numberic)) {
        $log_access .='[!] -> ���� mapX �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapY'], $C_Numberic)) {
        $log_access .='[!] -> ���� mapY �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapZ'], $C_Numberic)) {
        $log_access .='[!] -> ���� mapZ �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!$enable_access){
        header("404 Not Found");
        http_response_code(404);
        $log_access .='     > ���������� ������� ������������ ������� "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        exit;
    }
    $log_access .='     > ������ ������������.'.PHP_EOL;
    class html{
        var $out_html = '';
        var $h1_tags = '';
        var $out_html_menu = '';
        var $out_html_head = '<!DOCTYPE html><html lang="ru"><title>Admin panell</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><link rel="stylesheet" href="default.css">';
        function add_html_line($text){
            $this -> out_html .= $text.'<br>';
        }
        function add_html_line_Hide($text){
            $this -> add_html_line('<small>'.$text.'</small>');
        }

        function add_submenu($text, $link){
            $this -> out_html_menu .= '<a href="index.php?page='.$link.'">'.$text.'</a><br>';
        }
        function set_head($text){
            $this -> h1_tags = '<h1>'.$text.'</h1>';
        }
        function __destruct(){
            echo ($this -> out_html_head);
            echo '<block id="menu">'.($this -> out_html_menu).'</block>';
            echo '<block id="text">'.($this -> h1_tags).($this -> out_html).'</block>';
        }
    }
    $Arr_table_privelege_of_player = mysql_fetch_array(mysql_query('SELECT * FROM `privelege` WHERE `id_user`="'.F_Get_ID($_COOKIE['login']).'" LIMIT 1'));
    $html = new html();
    $html -> add_submenu('�������', '');
    if ($_GET['page']==''){
        $html -> set_head('������� ��������');
        $html -> add_html_line('����� ���������� � ���������������� ������, <b>'. ($_COOKIE['login']) .'</b>.');
        $tmp_string = '';
        if ($Arr_table_privelege_of_player['root']==1)
            $tmp_string .= '�����, ';
        if ($Arr_table_privelege_of_player['support']==1)
            $tmp_string .= '����������� ���������, ';
        if ($Arr_table_privelege_of_player['cheater']==1)
            $tmp_string .= '����� ������������, ';
        $tmp_string .= '�����';
        $html -> add_html_line('� ��� ���� �����: '.$tmp_string.'.');
        $html -> add_html_line('');
    }
    $html -> add_submenu('����� ������������', 'test');
    if ($_GET['page']=='test'){
        $html -> set_head('����� ������������');
        if ($Arr_table_privelege_of_player['cheater']!=1){
            $html -> add_html_line('� ��� ��� ���� �� ������ � ���� ��������.');
            exit;
        }
        $html -> add_html_line('����������, �������� ������ ���������.');
        $html -> add_submenu(' - �������� �����������', 'test-list-player');
        $html -> add_submenu(' - ����������� ������', 'test-view-job');
        if ($Arr_table_privelege_of_player['root']==1)
            $html -> add_submenu(' - ������� �����', 'test-close');
    }
    if ($_GET['page']=='test-list-player'){
        $html -> set_head('����� ������������ - ������ �����������');
        if ($Arr_table_privelege_of_player['cheater']!=1){
            $html -> add_html_line('� ��� ��� ���� �� ������ � ���� ��������.');
            exit;
        }
    }
    if ($_GET['page']=='test-view-job'){
        $html -> set_head('����� ������������ - ������ �����');
        if ($Arr_table_privelege_of_player['cheater']!=1){
            $html -> add_html_line('� ��� ��� ���� �� ������ � ���� ��������.');
            exit;
        }
    }
    if ($_GET['page']=='test-close'){
        $html -> set_head('����� ������������ - �������� ������');
        if ($Arr_table_privelege_of_player['root']!=1){
            $html -> add_html_line('� ��� ��� ���� �� ������ � ���� ��������.');
            exit;
        }
        $html -> add_html_line('��� �������� ������ ��� ����� �������� ����� ��������� �� ��������. ������ � ����� ������ ���������, ������ � ������ ����� ������ ����� ������.');
        $html -> add_html_line('����������� �������� ������ <b><u>�����</u></b>');
    }
    if ($_GET['page']=='*'){

    }
    if ($_GET['page']=='*'){

    }
    if ($_GET['page']=='*'){

    }
    if ($_GET['page']=='*'){

    }
    if ($_GET['page']=='*'){

    }
    if ($_GET['page']=='*'){

    }




?>