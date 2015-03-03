<?php
    class html{
        var $out_html = '';
        var $h1_tags = '';
        var $out_html_menu = '';
        var $out_html_head = '<!DOCTYPE html><html lang="ru"><title>Наследие воителей - справка</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><link rel="stylesheet" href="default.css">';
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
    $html -> add_submenu('Главная', '');
    $html -> add_submenu('Быстрый старт', 'stop');
    $html -> add_submenu('Список изменений версий', 'o_O');
    $html -> add_submenu('Что тестируем?', 'game-game-game');
    $html -> add_submenu('Частые проблемы', 'wtf');
    $html -> add_submenu('Обратная связь', 'ping');
    if ($_GET['page']==''){
        $html -> set_head('Главная страница');
        $html -> add_html_line('<b>Legacy of Warriors</b> - Многопользовательская онлайн стратегия реального времени...');
        $html -> add_html_line('');
        $html -> add_html_line('Война идёт уже много лет... Никто из ныне живущих уже и не помнит как всё начиналось. Монстры поднялись из низшего мира чтобы захватить Землю.');
        $html -> add_html_line('Ваш отец - правитель замка - ушёл на войну и так и не вернулся. Когда монстры атаковали Ваш замок Вы поняли - он не вернётся. Нескольким горожаном и Вам удалось спрятаться в подземелье. Когда войска покинули замок, Вы решили взять правление в свои руки.');
        $html -> add_html_line('Вам предстоит отстроить свою крепость, защитить выживших и, объединившись с другими правителями, изгнать зло из этого мира.. или, захватить власть над этим миром.');
    }
    if ($_GET['page']=='stop'){
        $html -> set_head('Как начать играть быстро');
        $html -> add_html_line('');
    }
    if ($_GET['page']=='o_O'){
        $html -> set_head('Список изменений версий..');
        $html -> add_html_line('Список изменений ДО текущей даты предоставляться не будет.');
        $html -> add_html_line('02-03-2015');
        $html -> add_html_line(' - Добавлена справка. Та которую Вы читаете сейчас :)');

    }
    if ($_GET['page']=='game-game-game'){
        $html -> set_head('Администрация тестирует');
        $html -> add_html_line('02-03-2015');
        $html -> add_html_line(' - Механизм сессий. Необходимо пересмотреть архитектуру и реализацию. (02-03-2015)');
        $html -> add_html_line('');
    }
    if ($_GET['page']=='wtf'){
        $html -> set_head('Частые проблемы');
        $html -> add_html_line('123');
    }
    if ($_GET['page']=='ping'){
        $html -> set_head('Как связаться с администрацией');
        $html -> add_html_line('Связаться с администрацией можно несколькими путями - зависит от того ЧТО вы хотите сообщить/спросить.');
        $html -> add_html_line('Чтобы сообщить об ошибке/баге/недочёте, пожалуйста, напишите нам на Legacy.of.Warriors.@gmail.com.');
        $html -> add_html_line_Hide('Не забудьте указать свой ник в игре для получения награды');
        $html -> add_html_line('Если Вы заподозрили что кто-то играет нечестно Вы можете написать не только на наш эл-адрес, но и в игровой почте.');
        $html -> add_html_line('');
        $html -> add_html_line('');
        $html -> add_html_line('');
        $html -> add_html_line('Обратите внимание, при любых письмах указывать свой никнейм <b>ОБЯЗАТЕЛЬНО</b>. Иначе письмо будет расценено как спам.');


    }










?>