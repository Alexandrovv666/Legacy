<?php
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_constant/char.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_constant/head.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_constant/gameserver.php';
    global $C_Numberic, $C_Text_noSpace;
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_api/log.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_api/math.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_api/mysql.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_api/processe_data.php';
    $linkss        = F_Connect_MySQL();
    $enable_access = false;
    $log_access    = '';
    if ( basename( $_SERVER[ 'PHP_SELF' ] ) != 'game.php' ) {
        $log_access .= '------------------------------------------------------------' . PHP_EOL;
        $log_access .= '                                             W A R N I N G !' . PHP_EOL;
        $log_access .= '------------------------------------------------------------' . PHP_EOL;
        $log_access .= '[!] -> Файл "game.php" включили в файл "' . basename( $_SERVER[ 'PHP_SELF' ] ) . '"' . PHP_EOL;
        $log_access .= '     > Выполнение скрипта остановленно ошибкой "404 Not Found".' . PHP_EOL;
        loging( $log_access );
        http_response_code( 404 );
        header( "404 Not Found" );
        exit;
    }
    if ( !Chek_string_of_mask( $_COOKIE[ 'login' ], $C_Text_noSpace . $C_Numberic ) )
        $log_access .= '[!] -> Кука login не прошла валидацию.' . PHP_EOL;
    else {
        $log_access .= '[.] -> Login = ' . $_COOKIE[ 'login' ] . PHP_EOL;
        if ( !Chek_string_of_mask( $_COOKIE[ 'session' ], $C_Text_noSpace . $C_Numberic ) )
            $log_access .= '[!] -> Кука session не прошла валидацию.' . PHP_EOL;
        else {
            $log_access .= '[.] -> Session = ' . $_COOKIE[ 'session' ] . PHP_EOL;
            if ( !( F_login_is_now( $_COOKIE[ 'login' ] ) ) )
                $log_access .= '[!] -> Логин в базе не числится.' . PHP_EOL;
            else
                $enable_access = true;
        }
    }
    if ( !Chek_string_of_mask( $_COOKIE[ 'casX' ], $C_Numberic ) ) {
        $log_access .= '[!] -> Кука casX не прошла валидацию' . PHP_EOL;
        $enable_access = false;
    }
    if ( !Chek_string_of_mask( $_COOKIE[ 'casY' ], $C_Numberic ) ) {
        $log_access .= '[!] -> Кука casY не прошла валидацию' . PHP_EOL;
        $enable_access = false;
    }
    if ( !Chek_string_of_mask( $_COOKIE[ 'casZ' ], $C_Numberic ) ) {
        $log_access .= '[!] -> Кука casZ не прошла валидацию' . PHP_EOL;
        $enable_access = false;
    }
    if ( !Chek_string_of_mask( $_COOKIE[ 'mapX' ], $C_Numberic ) ) {
        $log_access .= '[!] -> Кука mapX не прошла валидацию' . PHP_EOL;
        $enable_access = false;
    }
    if ( !Chek_string_of_mask( $_COOKIE[ 'mapY' ], $C_Numberic ) ) {
        $log_access .= '[!] -> Кука mapY не прошла валидацию' . PHP_EOL;
        $enable_access = false;
    }
    if ( !Chek_string_of_mask( $_COOKIE[ 'mapZ' ], $C_Numberic ) ) {
        $log_access .= '[!] -> Кука mapZ не прошла валидацию' . PHP_EOL;
        $enable_access = false;
    }
    if ( !$enable_access ) {
        header( "404 Not Found" );
        http_response_code( 404 );
        $log_access .= '     > Выполнение скрипта остановленно ошибкой "404 Not Found".' . PHP_EOL;
        loging( $log_access );
        exit;
    }
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
    if ( $_COOKIE[ 'ort' ] == 'castle' ) {
        echo '  <div class="panel-up-resoorsed normal-text">';
        echo '    <p id="gold" class="panel-up-resoorsed-element">load...</p>';
        echo '    <p id="tree" class="panel-up-resoorsed-element">load...</p>';
        echo '    <p id="stone" class="panel-up-resoorsed-element">load...</p>';
        echo '    <p id="men" class="panel-up-resoorsed-element">load...</p>';
        echo '  </div>';
    }
?>
    </div>
    <div class="panel-left">
      <p id="almaz" onclick='api_window_modal_message_open("buy", 0)'>load...</p>
      <div class="panel-left-navigation">
        <p class="panel-left-navigation-element" onclick="go_to_map();">Карта</p>
        <p class="panel-left-navigation-element" onclick="go_to_castle();">Замок</p>
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("mission", 0)'>Миссии</p>
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("mail", 0)'>Почта</p>
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("settings", 0)'>Настройки</p>
      </div>
    </div>
<?php
    switch ( $_COOKIE[ 'ort' ] ) {
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
            $res_castle          = mysql_query( 'SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID( $_COOKIE[ 'login' ] ) . '" and `x`="' . $_COOKIE[ 'casX' ] . '" and `y`="' . $_COOKIE[ 'casY' ] . '" and `z`="' . $_COOKIE[ 'casZ' ] . '"' );
            $Global_array_castle = mysql_fetch_array( $res_castle );
            $x                   = 1;
            $y                   = 1;
            $num_room            = 1;
            for ( $x = 1; $x <= 5; $x++ ) {
                for ( $y = 1; $y <= 7; $y++ ) {
                    $name_room = $Global_array_castle[ 'c_' . $num_room . '_n' ];
                    $time_room = $Global_array_castle[ 'c_' . $num_room . '_1' ];
                    echo '<div class="castle-room castle-room-' . $y . '-x castle-room-x-' . $x . '" id="room-' . $num_room . '" onclick=\'api_window_modal_message_open("click_room",' . $num_room . ')\'>';
                    echo '<div class="castle-room-' . onlyNoInt( $name_room ) . '"></div>';
                    $level_room = onlyInt( $name_room );
                    if ( $level_room != 0 )
                        echo '<p class="level-room normal-text">' . onlyInt( $name_room ) . '</p>';
                    echo '<div id="box-room-' . $num_room . '"></div>';
                    echo '<p class="time-room" id="timer' . $num_room . '">';
                    if ( $time_room < 0 )
                        echo int_to_time( abs( $time_room ) );
                    if ( $time_room > 0 )
                        echo '--:--:--:--';
                    echo '</p>';
                    echo '</div>';
                    $num_room = $num_room + 1;
                }
            }
            echo '  </div>';
            echo '  <div class="castle-army">';
            $Global_array_res_Junits_param = array( );
            $res_Junits_param              = mysql_query( 'SELECT * FROM `army_baze`' );
            while ( $Global_array_res_Junits_param[ ] = mysql_fetch_array( $res_Junits_param ) ); {
        }
            for ( $army = 1; $army <= 8; $army++ )
                echo '<div id="castle-army-img-' . $army . '" class="castle-army-element"><a class="tooltip" href="#"><font color="#777" class="army-info">i</font><span class="classic">Основные характеристики:<br>Атака ' . $Global_array_res_Junits_param[ $army - 1 ][ 'atack' ] . '<br>Здоровье ' . $Global_array_res_Junits_param[ $army - 1 ][ 'zdorov' ] . '<br>Защита ' . $Global_array_res_Junits_param[ $army - 1 ][ 'defens' ] . '</span></a><p class="castle-army-count" id="arm' . $army . '">' . $Global_array_castle[ 'army_' . $army ] . '</p></div>';
            echo '  </div>';
            echo '  <div class="castle-army-hidden"></div>';
            echo '</div>';
            break;
        case 'map':
            class cell {
                var $Object_Type;
                var $Caption;
                var $ID_Owner;
                var $Terrain_Type;
                public function __construct( ) {
                    $this->Object_Type = 'NULL';
                }
                public function cell_set_Terrain( $Terrain_Type ) {
                    if ( $Terrain_Type == 0 )
                        $this->Terrain_Type = 'terrain-ozero';
                    elseif ( $Terrain_Type == 1 )
                        $this->Terrain_Type = 'terrain-pust';
                    elseif ( $Terrain_Type == 2 )
                        $this->Terrain_Type = 'terrain-wald';
                    elseif ( $Terrain_Type == 3 )
                        $this->Terrain_Type = 'terrain-step';
                    elseif ( $Terrain_Type == 4 )
                        $this->Terrain_Type = 'terrain-berg';
                    elseif ( $Terrain_Type == 5 )
                        $this->Terrain_Type = 'terrain-trawa';
                    elseif ( $Terrain_Type == 6 )
                        $this->Terrain_Type = 'terrain-t_zemla';
                    elseif ( $Terrain_Type == 7 )
                        $this->Terrain_Type = 'terrain-sw';
                }
                public function cell_set_Type_Object( $text1, $text2 ) {
                    $this->Object_Type = $text1;
                    $this->Caption     = $text2;
                }
                public function cell_set_ID_Owner( $Num ) {
                    $this->ID_Owner = $Num;
                }
                public function cell_HTML_Print( $x, $y, $z ) {
                    echo '<cell onclick="api_window_modal_message_open(\'map_cell_click\',' . ( $z ) . ')">';
                    echo '<div class="map-cell map-cell-' . ( $x ) . '-x map-cell-x-' . ( $y ) . ' ' . ( $this->Terrain_Type ) . '">';
                    if ( $this->Object_Type == 'castle' )
                        echo '<p class="castle"><obj class="Obj_name">' . $this->Caption . '</obj></p>';
                    echo '</div>';
                    echo '</cell>';
                    $this->ID_Owner = $Num;
                }
            }
            global $Max_X_map, $Max_Y_map;
            $Global_MAP = array( );
            for ( $x = 0; $x <= $Max_X_map; $x++ ) {
                $Global_MAP[ $x ] = array( );
                for ( $y = 0; $y <= $Max_Y_map; $y++ ) {
                    $Global_MAP[ $x ][ $y ] = array( );
                    for ( $z = 0; $z <= 115; $z++ ) {
                        $Global_MAP[ $x ][ $y ][ $z ] = new cell();
                    }
                }
            }
            $Global_array_castle = array( );
            $res_all_castle      = mysql_query( 'SELECT x, y, z, name FROM `castle` ORDER BY x ASC, y ASC, z ASC' );
            while ( $Global_array_castle[ ] = mysql_fetch_array( $res_all_castle ) ); {
        }
            $count_castle = count( $Global_array_castle ) - 1;
            for ( $num_castle = 0; $num_castle < $count_castle; $num_castle++ ) {
                $x          = $Global_array_castle[ $num_castle ][ 'x' ];
                $y          = $Global_array_castle[ $num_castle ][ 'y' ];
                $z          = $Global_array_castle[ $num_castle ][ 'z' ];
                $NameCastle = $Global_array_castle[ $num_castle ][ 'name' ];
                $ID_castle  = $Global_array_castle[ $num_castle ][ 'id' ];
                $Global_MAP[ $x ][ $y ][ $z ]->cell_set_Type_Object( "castle", $NameCastle );
                $Global_MAP[ $x ][ $y ][ $z ]->cell_set_ID_Owner( $ID_castle );
            }
            unset( $Global_array_castle, $res_all_castle, $count_castle );
            $Gl_arr_map  = array( );
            $res_all_map = mysql_query( 'SELECT * FROM `map` ORDER BY `x` ASC, `y` ASC, `z` ASC' );
            while ( $Gl_arr_map[ ] = mysql_fetch_array( $res_all_map ) ); {
        }
            $count_map = count( $Gl_arr_map ) - 1;
            for ( $num_map = 0; $num_map < $count_map; $num_map++ ) {
                $x       = $Gl_arr_map[ $num_map ][ 'x' ];
                $y       = $Gl_arr_map[ $num_map ][ 'y' ];
                $z       = $Gl_arr_map[ $num_map ][ 'z' ];
                $terrain = $Gl_arr_map[ $num_map ][ 'terrain' ];
                $Global_MAP[ $x ][ $y ][ $z ]->cell_set_Terrain( $terrain );
            }
            unset( $Gl_arr_map, $res_all_map, $count_map );
            for ( $Sub_Map_x = 1; $Sub_Map_x <= 7; $Sub_Map_x++ )
                for ( $Sub_Map_y = 1; $Sub_Map_y <= 15; $Sub_Map_y++ ) {
                    $z = $Sub_Map_x * 15 - 15 + $Sub_Map_y;
                    $Global_MAP[ $_COOKIE[ 'mapX' ] ][ $_COOKIE[ 'mapY' ] ][ $z ]->cell_HTML_Print( $Sub_Map_x, $Sub_Map_y, $z );
                }
            global $Max_X_map, $Max_Y_map;
            echo '<block id="Block_coord">'.$_COOKIE[ 'mapX' ].'/'.$_COOKIE[ 'mapY' ].'</block>';
            if ( $_COOKIE[ 'mapY' ] != 1 )
                echo '<div class="map-navigation-elements" id="map-navigation-element-8" onclick="go_to_cell(' . ( $_COOKIE[ 'mapX' ] * 1 ) . ', ' . ( $_COOKIE[ 'mapY' ] - 1 ) . ')"></div>';
            if ( $_COOKIE[ 'mapX' ] != 1 )
                echo '<div class="map-navigation-elements" id="map-navigation-element-4" onclick="go_to_cell(' . ( $_COOKIE[ 'mapX' ] - 1 ) . ', ' . ( $_COOKIE[ 'mapY' ] * 1 ) . ')"></div>';
            if ( $Max_X_map != $_COOKIE[ 'mapX' ] )
                echo '<div class="map-navigation-elements" id="map-navigation-element-6" onclick="go_to_cell(' . ( $_COOKIE[ 'mapX' ] + 1 ) . ', ' . ( $_COOKIE[ 'mapY' ] * 1 ) . ')"></div>';
            if ( $_COOKIE[ 'mapY' ] != $Max_Y_map )
                echo '<div class="map-navigation-elements" id="map-navigation-element-2" onclick="go_to_cell(' . ( $_COOKIE[ 'mapX' ] * 1 ) . ', ' . ( $_COOKIE[ 'mapY' ] + 1 ) . ')"></div>';
            break;
        default:
            echo 'Что-то пошло не так...';
    }
    mysql_close( $linkss );
?> 
<script>setInterval(One, 1000)</script>