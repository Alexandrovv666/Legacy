<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/head.php';
    global $C_Numberic, $C_Text_noSpace;
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    $linkss = F_Connect_MySQL();
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/security.php';
    F_session_extension();
    F_echo_html_head();
?>
<link rel="stylesheet" href="css\castle.css">
<link rel="stylesheet" href="css\general.css">
<link rel="stylesheet" href="css\mail.css">
<link rel="stylesheet" href="css\map.css">
<link rel="stylesheet" href="css\panel.css">
<link rel="stylesheet" href="css\window.css">
<script src="js\jquery.min.js"></script>
<script src="js\processed.js"></script>
<script src="js\var.js"></script>
<script src="js\api.js"></script>
<script src="js\castle.js"></script>
<script src="js\general.js"></script>
<script src="js\navigation.js"></script>
<div id="fon"></div>
<block id="window-modal" class="big-text">
    <obj id="window-modal-message-buttom-close" onclick="api_window_modal_message_close()">X</obj>
    <obj id="window-modal-message">
        <obj id="window-modal-message-caption">Здравствуйте.</obj>
        <obj class="scroll" id="window-modal-message-text">
            Здравствуйте, уважаемый игрок.<br>
            Администрация игры безмерно благодарна Вам, за то что Вы с нами. <b>Спасибо.</b><br>
            Это стандартное преведствующее сообщение.
        </obj>
    </obj>
</block>
<div class="panel-up">
<div class="panel-up-navigation">
<p onclick="go_to_exit();">Exit</p>
</div>';
<?php
    if ($_COOKIE['ort'] == 'castle') {
        echo '  <div class="panel-up-resoorsed normal-text">';
        echo '    <p id="gold" class="panel-up-resoorsed-element">load...</p>';
        echo '    <p id="tree" class="panel-up-resoorsed-element">load...</p>';
        echo '    <p id="stone" class="panel-up-resoorsed-element">load...</p>';
        echo '    <p id="men" class="panel-up-resoorsed-element">load...</p>';
        echo '  </div>';
        echo '  <div id="name-castle" onclick=\'api_window_modal_message_open("get_info_castle", 0)\'>load...</div>';
        echo '  <div id="quest" onclick=\'api_window_modal_message_open("quest", 0)\'>Квесты.</div>';
    }
?>
    </div>
    <div class="panel-left">
      <p id="almaz" onclick='api_window_modal_message_open("buy", 0)'>load...</p>
      <div class="panel-left-navigation">
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("adminka", 0)'>Служебная<br>кнопка</p>
        <p class="panel-left-navigation-element" onclick="go_to_map();">Карта</p>
        <p class="panel-left-navigation-element" onclick="go_to_castle();">Замок</p>
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("mission", 0)'>Миссии</p>
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("mail", 0)'>Почта</p>
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("settings", 0)'>Настройки</p>
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("premium", 0)'>Премиум</p>
      </div>
    </div>
<?php
    switch ($_COOKIE['ort']) {
        case 'castle':
            echo '<div class="conteyner-site">';
            echo '  <div class="castle-engine">';
            echo '    <div id="castle-basic-wood-0" class="castle-basic-wood"></div>';
            echo '    <div id="castle-basic-wood-1" class="castle-basic-wood"></div>';
            echo '    <div id="castle-basic-wood-2" class="castle-basic-wood"></div>';
            echo '    <div id="castle-basic-wood-3" class="castle-basic-wood"></div>';
            echo '    <div id="castle-basic-wood-4" class="castle-basic-wood"></div>';
            echo '    <div id="castle-basic-wood-5" class="castle-basic-wood"></div>';
            echo '    <div id="castle-basic-wood-6" class="castle-basic-wood"></div>';
            echo '    <div id="castle-basic-wood-7" class="castle-basic-wood"></div>';
            echo '    <div id="castle-basic-stone-0" class="castle-basic-stone"></div>';
            echo '    <div id="castle-basic-stone-1" class="castle-basic-stone"></div>';
            echo '    <div id="castle-basic-stone-2" class="castle-basic-stone"></div>';
            echo '    <div id="castle-basic-stone-3" class="castle-basic-stone"></div>';
            echo '    <div id="castle-basic-stone-4" class="castle-basic-stone"></div>';
            echo '    <div id="castle-basic-stone-5" class="castle-basic-stone"></div>';
            echo '    <div id="castle-basic-stone-6" class="castle-basic-stone"></div>';
            $res_castle          = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['casX'] . '" and `y`="' . $_COOKIE['casY'] . '" and `z`="' . $_COOKIE['casZ'] . '"');
            $Global_array_castle = mysql_fetch_array($res_castle);
            $x                   = 1;
            $y                   = 1;
            $num_room            = 1;
            for ($x = 1; $x <= 5; $x++) {
                for ($y = 1; $y <= 7; $y++) {
                    $name_room = $Global_array_castle['c_' . $num_room . '_n'];
                    $time_room = $Global_array_castle['c_' . $num_room . '_1'];
                    echo '<div class="castle-room castle-room-' . $y . '-x castle-room-x-' . $x . '" id="room-' . $num_room . '" onclick=\'api_window_modal_message_open("click_room",' . $num_room . ')\'>';
                    echo '<div class="castle-room-' . onlyNoInt($name_room) . '"></div>';
                    $level_room = onlyInt($name_room);
                    if ($level_room != 0)
                        echo '<p class="level-room normal-text">' . onlyInt($name_room) . '</p>';
                    echo '<div id="box-room-' . $num_room . '"></div>';
                    echo '<p class="time-room" id="timer' . $num_room . '">';
                    if ($time_room < 0)
                        echo int_to_time(abs($time_room));
                    if ($time_room > 0)
                        echo '--:--:--:--';
                    echo '</p>';
                    echo '</div>';
                    $num_room = $num_room + 1;
                }
            }
            echo '  </div>';
            echo '  <div class="castle-army">';
            $Global_array_res_Junits_param = array();
            $res_Junits_param              = mysql_query('SELECT * FROM `army_baze`');
            while ($Global_array_res_Junits_param[] = mysql_fetch_array($res_Junits_param)); {
        }
            for ($army = 1; $army <= 8; $army++)
                echo '<div id="castle-army-img-' . $army . '" class="castle-army-element"><a class="tooltip" href="#"><font color="#777" class="army-info">i</font><span class="classic">Основные характеристики:<br>Атака ' . $Global_array_res_Junits_param[$army - 1]['atack'] . '<br>Здоровье ' . $Global_array_res_Junits_param[$army - 1]['zdorov'] . '<br>Защита ' . $Global_array_res_Junits_param[$army - 1]['defens'] . '</span></a><p class="castle-army-count" id="arm' . $army . '">' . $Global_array_castle['army_' . $army] . '</p></div>';
            echo '  </div>';
            echo '  <div class="castle-army-hidden"></div>';
            echo '</div>';
            break;
        case 'map':
            $Gl_arr_castle  = array();
            $res_all_castle = mysql_query('SELECT x, y, z FROM `castle` WHERE `x` ="' . $_COOKIE['mapX'] . '" AND `y` ="' . $_COOKIE['mapY'] . '"');
            while ($Gl_arr_castle[] = mysql_fetch_array($res_all_castle)); {
        }
            $count_castle = count($Gl_arr_castle) - 1;
            $Gl_arr_map   = array();
            $res_all_map  = mysql_query('SELECT * FROM `map` WHERE `x` ="' . $_COOKIE['mapX'] . '" AND `y` ="' . $_COOKIE['mapY'] . '"');
            while ($Gl_arr_map[] = mysql_fetch_array($res_all_map)); {
        }
            $count_map = count($Gl_arr_map) - 1;
            $x         = 1;
            $y         = 1;
            for ($x = 1; $x <= 7; $x++)
                for ($y = 1; $y <= 15; $y++) {
                    for ($num_map = 0; $num_map <= $count_map; $num_map++)
                        if ($Gl_arr_map[$num_map]['z'] == (($x * 15 - 15) + $y)) {
                            echo '<cell onclick="api_window_modal_message_open(\'map_cell_click\',' . (($x * 15 - 15) + $y) . ')">';
                            echo '<div class="map-cell map-cell-' . $x . '-x map-cell-x-' . $y . ' ' . f_terr($Gl_arr_map[$num_map]['terrain']) . '">';
                            echo (($x * 15 - 15) + $y);
                            for ($num_castle = 0; $num_castle <= $count_castle; $num_castle++)
                                if ($Gl_arr_castle[$num_castle][z] == ($num_map + 1))
                                    echo '<p class="castle"></p>';
                            echo '</div>';
                            echo '</cell>';
                        }
                }
            global $Max_X_map, $Max_Y_map;
            if ($_COOKIE['mapY'] != 1)
                echo '<div class="map-navigation-elements" id="map-navigation-element-8" onclick="go_to_cell(8, ' . ($_COOKIE['mapY'] - 1) . ')"></div>';
            if ($_COOKIE['mapX'] != 1)
                echo '<div class="map-navigation-elements" id="map-navigation-element-4" onclick="go_to_cell(4, ' . ($_COOKIE['mapX'] - 1) . ')"></div>';
            if ($Max_X_map != $_COOKIE['mapX'])
                echo '<div class="map-navigation-elements" id="map-navigation-element-6" onclick="go_to_cell(6, ' . ($_COOKIE['mapX'] + 1) . ')"></div>';
            if ($_COOKIE['mapY'] != $Max_Y_map)
                echo '<div class="map-navigation-elements" id="map-navigation-element-2" onclick="go_to_cell(' . $_COOKIE['mapX'] . ', ' . ($_COOKIE['mapY'] + 1) . ')"></div>';
            break;
        default:
            echo 'Что-то пошло не так...';
    }
    mysql_close($linkss);
?> 
<script>setInterval(One, 1000)</script>