<?php
    class html{
        var $out_html = '';
        var $h1_tags = '';
        var $out_html_menu = '';
        var $out_html_head = '<!DOCTYPE html><html lang="ru"><title>�������� �������� - �������</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><link rel="stylesheet" href="default.css">';
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
    $html = new html();
    $html -> add_submenu('�������', '');
    $html -> add_submenu('������� �����', 'stop');
    $html -> add_submenu('������ ��������� ������', 'o_O');
    $html -> add_submenu('��� ���������?', 'game-game-game');
    $html -> add_submenu('������ ��������', 'wtf');
    $html -> add_submenu('�������� �����', 'ping');
    if ($_GET['page']==''){
        $html -> set_head('������� ��������');
        $html -> add_html_line('<b>Legacy of Warriors</b> - ��������������������� ������ ��������� ��������� �������...');
        $html -> add_html_line('');
        $html -> add_html_line('����� ��� ��� ����� ���... ����� �� ���� ������� ��� � �� ������ ��� �� ����������. ������� ��������� �� ������� ���� ����� ��������� �����.');
        $html -> add_html_line('��� ���� - ��������� ����� - ���� �� ����� � ��� � �� ��������. ����� ������� ��������� ��� ����� �� ������ - �� �� �������. ���������� ��������� � ��� ������� ���������� � ����������. ����� ������ �������� �����, �� ������ ����� ��������� � ���� ����.');
        $html -> add_html_line('��� ��������� ��������� ���� ��������, �������� �������� �, ������������� � ������� �����������, ������� ��� �� ����� ����.. ���, ��������� ������ ��� ���� �����.');
    }
    if ($_GET['page']=='stop'){
        $html -> set_head('��� ������ ������ ������');
        $html -> add_html_line('');
    }
    if ($_GET['page']=='o_O'){
        $html -> set_head('������ ��������� ������..');
        $html -> add_html_line('������ ��������� �� ������� ���� ��������������� �� �����.');
        $html -> add_html_line('02-03-2015');
        $html -> add_html_line(' - ��������� �������. �� ������� �� ������� ������ :)');

    }
    if ($_GET['page']=='game-game-game'){
        $html -> set_head('������������� ���������');
        $html -> add_html_line('02-03-2015');
        $html -> add_html_line(' - �������� ������. ���������� ������������ ����������� � ����������. (02-03-2015)');
        $html -> add_html_line('');
    }
    if ($_GET['page']=='wtf'){
        $html -> set_head('������ ��������');
        $html -> add_html_line('123');
    }
    if ($_GET['page']=='ping'){
        $html -> set_head('��� ��������� � ��������������');
        $html -> add_html_line('��������� � �������������� ����� ����������� ������ - ������� �� ���� ��� �� ������ ��������/��������.');
        $html -> add_html_line('����� �������� �� ������/����/��������, ����������, �������� ��� �� Legacy.of.Warriors.@gmail.com.');
        $html -> add_html_line_Hide('�� �������� ������� ���� ��� � ���� ��� ��������� �������');
        $html -> add_html_line('���� �� ����������� ��� ���-�� ������ �������� �� ������ �������� �� ������ �� ��� ��-�����, �� � � ������� �����.');
        $html -> add_html_line('');
        $html -> add_html_line('');
        $html -> add_html_line('');
        $html -> add_html_line('�������� ��������, ��� ����� ������� ��������� ���� ������� <b>�����������</b>. ����� ������ ����� ��������� ��� ����.');


    }










?>