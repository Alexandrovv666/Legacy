<?php
    ignore_user_abort( true );
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_constant/cron.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_constant/gameserver.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_api/mysql.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_api/math.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_api/log.php';
    $links = F_Connect_MySQL();
    echo '<META http-equiv="content-type" content="text/html; charset=windows-1251"><script language = \'javascript\'> var delay = ' . $Wait_to_startCron . '; setTimeout("document.location.href=\'Cron.php\'", delay);</script>';
    F_TranzationUp();
    $micro_time = microtime( true );
    echo 'Transaction is up.<br>';
    global $Max_X_map, $Max_Y_map, $Wait_to_startCron, $AverageCountLager, $FASTER, $MaxTimeWorkCron, $Max_level_HAUS;
    $arr_res_work = mysql_fetch_array( mysql_query( 'SELECT Value FROM `settings` WHERE `name_parametr` = "work"' ) );
    $work         = $arr_res_work[ 'Value' ];
    if ( $work != 1 ) {
        echo '<b>Warinng!</b> GameServer is <b>down</b>!!<br>';
        FClose_mysql_connect( $links );
        exit;
    }
    echo 'GameServer is work.<br>Step 1: Load MySQL data bigined.<br>';
    $arr_time        = mysql_fetch_array( mysql_query( 'SELECT Value FROM `settings` WHERE `name_parametr` = "timers"' ) );
    $alt_time        = $arr_time[ 'Value' ];
    $to_be_processed = $_SERVER[ 'REQUEST_TIME' ] - $alt_time;
    if ( mysql_num_rows( mysql_query( 'SELECT * FROM `privelege`' ) ) == 1 )
        mysql_query( "UPDATE `game`.`privelege` SET  `root` =  '1', `cheater`='1', `support`='1'" );
    if ( $to_be_processed < 1 ) {
        echo 'Wait...<br>' . $to_be_processed;
        mysql_query( 'UPDATE `game`.`settings` SET `Value` = "' . ( $alt_time - $FASTER ) . '" WHERE `settings`.`name_parametr` = "timers"' );
        F_TranzationDown();
        exit;
    }
    $GA_castle       = array( );
    $res_alle_castle = mysql_query( 'SELECT * FROM `castle`' );
    while ( $GA_castle[ ] = mysql_fetch_array( $res_alle_castle ) ); {
    }
    $GA_haus       = array( );
    $res_alle_haus = mysql_query( 'SELECT * FROM `haus`' );
    while ( $GA_haus[ ] = mysql_fetch_array( $res_alle_haus ) ); {
    }
    $count_castle        = count( $GA_castle ) - 1;
    $GA_castle_bak       = array( );
    $GA_castle_bak       = $GA_castle;
    $GA_res_Junits_param = array( );
    $res_Junits_param    = mysql_query( 'SELECT * FROM `army_baze`' );
    while ( $GA_res_Junits_param[ ] = mysql_fetch_array( $res_Junits_param ) ); {
    }

    $GA_user       = array( );
    $res_alle_user = mysql_query( 'SELECT * FROM `users`' );
    while ( $GA_user[ ] = mysql_fetch_array( $res_alle_user ) ); {
    }

    echo 'Step 2. Processed game data begined.<br>';
    echo 'To be processed ' . $to_be_processed . ' second.<br>';
    $V_i = 1;
    $get = 0;
    for ( $alt_time = $alt_time; $alt_time <= ( $_SERVER[ 'REQUEST_TIME' ] ); $alt_time++ ) {
        if ( ( time() - $_SERVER[ 'REQUEST_TIME' ] ) > $MaxTimeWorkCron ) {
            echo '<b>Warinng!</b> GameServer <b>is too long</b>!!<br>';
            $get = $_GET[ 'hard' ] + 1;
            goto end_real_time;
        }
        if ( $count_castle > 0 )
            for ( $num_castle = 0; $num_castle < $count_castle; $num_castle++ ) {
                for ( $i = 1; $i <= 35; $i++ ) {
                    if ( $GA_castle[ $num_castle ][ 'c_' . $i . '_1' ] < 0 ) {
                        $ID_Room = $GA_castle[ $num_castle ][ 'c_' . ( $i ) . '_3' ];
                        if ( $GA_castle[ $num_castle ][ 'c_' . $i . '_1' ] == -1 ) {
                            if ( $ID_Room % $Max_level_HAUS != 1 ) {
                                $GA_castle[ $num_castle ][ 'agold' ]   = $GA_castle[ $num_castle ][ 'agold' ] - $GA_haus[ $ID_Room - 2 ][ 'agold' ];
                                $GA_castle[ $num_castle ][ 'atree' ]   = $GA_castle[ $num_castle ][ 'atree' ] - $GA_haus[ $ID_Room - 2 ][ 'atree' ];
                                $GA_castle[ $num_castle ][ 'astone' ]  = $GA_castle[ $num_castle ][ 'astone' ] - $GA_haus[ $ID_Room - 2 ][ 'astone' ];
                                $GA_castle[ $num_castle ][ 'amen' ]    = $GA_castle[ $num_castle ][ 'amen' ] - $GA_haus[ $ID_Room - 2 ][ 'amen' ];
                                $GA_castle[ $num_castle ][ 'max_men' ] = $GA_castle[ $num_castle ][ 'max_men' ] - $GA_haus[ $ID_Room - 2 ][ 'max_sklad_men' ];
                                $GA_castle[ $num_castle ][ 'maxres' ]  = $GA_castle[ $num_castle ][ 'maxres' ] - $GA_haus[ $ID_Room - 2 ][ 'asklad' ];
                            }
                            $GA_castle[ $num_castle ][ 'agold' ]          = $GA_castle[ $num_castle ][ 'agold' ] + $GA_haus[ $ID_Room - 1 ][ 'agold' ];
                            $GA_castle[ $num_castle ][ 'atree' ]          = $GA_castle[ $num_castle ][ 'atree' ] + $GA_haus[ $ID_Room - 1 ][ 'atree' ];
                            $GA_castle[ $num_castle ][ 'astone' ]         = $GA_castle[ $num_castle ][ 'astone' ] + $GA_haus[ $ID_Room - 1 ][ 'astone' ];
                            $GA_castle[ $num_castle ][ 'amen' ]           = $GA_castle[ $num_castle ][ 'amen' ] + $GA_haus[ $ID_Room - 1 ][ 'amen' ];
                            $GA_castle[ $num_castle ][ 'max_men' ]        = $GA_castle[ $num_castle ][ 'max_men' ] + $GA_haus[ $ID_Room - 1 ][ 'max_sklad_men' ];
                            $GA_castle[ $num_castle ][ 'maxres' ]         = $GA_castle[ $num_castle ][ 'maxres' ] + $GA_haus[ $ID_Room - 1 ][ 'asklad' ];
                            $GA_castle[ $num_castle ][ 'men' ]            = $GA_castle[ $num_castle ][ 'men' ] + $GA_castle[ $num_castle ][ 'c_' . $i . '_2' ];
                            $GA_castle[ $num_castle ][ 'c_' . $i . '_2' ] = 0;
                        }
                        $GA_castle[ $num_castle ][ 'c_' . $i . '_1' ] = $GA_castle[ $num_castle ][ 'c_' . $i . '_1' ] + 1;
                    }
                    if ( $GA_castle[ $num_castle ][ 'c_' . $i . '_1' ] == 0 ) {
                    }
                    if ( $GA_castle[ $num_castle ][ 'c_' . $i . '_1' ] > 0 ) {
                        if (in_array((onlyNoInt($GA_castle[ $num_castle ][ 'c_' . $i . '_n' ])), array("nos", "voin", "kon", "tank", "bival", "luk", "lekar", "naim"))){
                            if ( $GA_castle[ $num_castle ][ 'c_' . $i . '_1' ] == 1 ){
                                if (onlyNoInt($GA_castle[ $num_castle ][ 'c_' . $i . '_n' ]) == 'nos' )
                                    $GA_castle[ $num_castle ][ 'army_1' ] = $GA_castle[ $num_castle ][ 'army_1' ] + 1;
                                if (onlyNoInt($GA_castle[ $num_castle ][ 'c_' . $i . '_n' ]) == 'voin' )
                                    $GA_castle[ $num_castle ][ 'army_1' ] = $GA_castle[ $num_castle ][ 'army_2' ] + 1;
                                if (onlyNoInt($GA_castle[ $num_castle ][ 'c_' . $i . '_n' ]) == 'kon' )
                                    $GA_castle[ $num_castle ][ 'army_1' ] = $GA_castle[ $num_castle ][ 'army_3' ] + 1;
                                if (onlyNoInt($GA_castle[ $num_castle ][ 'c_' . $i . '_n' ]) == 'tank' )
                                    $GA_castle[ $num_castle ][ 'army_1' ] = $GA_castle[ $num_castle ][ 'army_4' ] + 1;
                                if (onlyNoInt($GA_castle[ $num_castle ][ 'c_' . $i . '_n' ]) == 'bival' )
                                    $GA_castle[ $num_castle ][ 'army_1' ] = $GA_castle[ $num_castle ][ 'army_5' ] + 1;
                                if (onlyNoInt($GA_castle[ $num_castle ][ 'c_' . $i . '_n' ]) == 'luk' )
                                    $GA_castle[ $num_castle ][ 'army_1' ] = $GA_castle[ $num_castle ][ 'army_6' ] + 1;
                                if (onlyNoInt($GA_castle[ $num_castle ][ 'c_' . $i . '_n' ]) == 'lekar' )
                                    $GA_castle[ $num_castle ][ 'army_1' ] = $GA_castle[ $num_castle ][ 'army_7' ] + 1;
                                if (onlyNoInt($GA_castle[ $num_castle ][ 'c_' . $i . '_n' ]) == 'naim' )
                                    $GA_castle[ $num_castle ][ 'army_1' ] = $GA_castle[ $num_castle ][ 'army_8' ] + 1;
                            }
                        }
                        $GA_castle[ $num_castle ][ 'c_' . $i . '_1' ] = $GA_castle[ $num_castle ][ 'c_' . $i . '_1' ] - 1;
                    }
                }
                $summ_jalovan_army = 0;
                for ( $i = 1; $i <= 8; $i++ ) {
                    $summ_jalovan += $summ_jalovan + $GA_res_Junits_param[ $i - 1 ][ 'Jalovan' ] * $GA_castle[ $num_castle ][ 'army_' . $i ];
                    $summ_jalovan += $summ_jalovan + ( $GA_res_Junits_param[ $i - 1 ][ 'Jalovan' ] * $GA_castle[ $num_castle ][ 'army_hidden_' . $i ] * 0.5 );
                }
                $GA_castle[ $num_castle ][ 'tree' ]  = $GA_castle[ $num_castle ][ 'tree' ] + ( $GA_castle[ $num_castle ][ 'atree' ] / 3600 );
                $GA_castle[ $num_castle ][ 'stone' ] = $GA_castle[ $num_castle ][ 'stone' ] + ( $GA_castle[ $num_castle ][ 'astone' ] / 3600 );
                $GA_castle[ $num_castle ][ 'gold' ]  = $GA_castle[ $num_castle ][ 'gold' ] + ( $GA_castle[ $num_castle ][ 'agold' ] / 3600 ) - ( $summ_jalovan / 3600 );
                $GA_castle[ $num_castle ][ 'men' ]   = $GA_castle[ $num_castle ][ 'men' ] + ( $GA_castle[ $num_castle ][ 'amen' ] / 3600 );
                if ( $GA_castle[ $num_castle ][ 'tree' ] > $GA_castle[ $num_castle ][ 'maxres' ] )
                    $GA_castle[ $num_castle ][ 'tree' ] = $GA_castle[ $num_castle ][ 'tree' ] - round( ( ( $GA_castle[ $num_castle ][ 'tree' ] - $GA_castle[ $num_castle ][ 'maxres' ] ) / 3600 / 100 ), 7 );
                if ( $GA_castle[ $num_castle ][ 'stone' ] > $GA_castle[ $num_castle ][ 'maxres' ] )
                    $GA_castle[ $num_castle ][ 'stone' ] = $GA_castle[ $num_castle ][ 'stone' ] - round( ( ( $GA_castle[ $num_castle ][ 'stone' ] - $GA_castle[ $num_castle ][ 'maxres' ] ) / 3600 / 100 ), 7 );
                if ( $GA_castle[ $num_castle ][ 'men' ] > 0 ) {
                    if ( $GA_castle[ $num_castle ][ 'men' ] < ( $GA_castle[ $num_castle ][ 'max_men' ] ) )
                        $GA_castle[ $num_castle ][ 'men' ] = $GA_castle[ $num_castle ][ 'men' ] + ( decPrz( $GA_castle[ $num_castle ][ 'men' ], 99.9 ) );
                    if ( $GA_castle[ $num_castle ][ 'men' ] > ( $GA_castle[ $num_castle ][ 'max_men' ] ) )
                        $GA_castle[ $num_castle ][ 'men' ] = $GA_castle[ $num_castle ][ 'men' ] - round( ( ( $GA_castle[ $num_castle ][ 'men' ] - $GA_castle[ $num_castle ][ 'max_men' ] ) / 3600 / 100 ), 7 );
                }
                if ( $GA_castle[ $num_castle ][ 'men' ] > 99999 )
                    $GA_castle[ $num_castle ][ 'men' ] = 99999;
                if ( $GA_castle[ $num_castle ][ 'gold' ] > $GA_castle[ $num_castle ][ 'maxres' ] )
                    $GA_castle[ $num_castle ][ 'gold' ] = $GA_castle[ $num_castle ][ 'gold' ] - round( ( ( $GA_castle[ $num_castle ][ 'gold' ] - $GA_castle[ $num_castle ][ 'maxres' ] ) / 3600 / 100 ), 7 );
                if ( $GA_castle[ $num_castle ][ 'gold' ] < 0 ) {
                    $rand_arm = rand( 1, 8 );
                    if ( $GA_castle[ $num_castle ][ 'army_' . $rand_arm ] > 0 )
                        $GA_castle[ $num_castle ][ 'army_' . $rand_arm ] = $GA_castle[ $num_castle ][ 'army_' . $rand_arm ] - ( 1 * rand( 1, 5 ) );
                    $GA_castle[ $num_castle ][ 'gold' ] = 0;
                }
                for ( $i = 1; $i <= 8; $i++ )
                    if ( $GA_castle[ $num_castle ][ 'army_' . $i ] < 0 )
                        $GA_castle[ $num_castle ][ 'army_' . $i ] = 0;
            }
    }
end_real_time:
    for ( $num_castle = 0; $num_castle < $count_castle; $num_castle++ ) {
        $qwery = 'UPDATE `castle` SET `gold`="' . $GA_castle[ $num_castle ][ 'gold' ] . '",`tree`="' . $GA_castle[ $num_castle ][ 'tree' ] . '",`stone`="' . $GA_castle[ $num_castle ][ 'stone' ] . '", `men`="' . $GA_castle[ $num_castle ][ 'men' ] . '",';
        $qwery .= '`agold`="' . $GA_castle[ $num_castle ][ 'agold' ] . '",`atree`="' . $GA_castle[ $num_castle ][ 'atree' ] . '",`astone`="' . $GA_castle[ $num_castle ][ 'astone' ] . '", `amen`="' . $GA_castle[ $num_castle ][ 'amen' ] . '",';
        $qwery .= '`max_men`="' . $GA_castle[ $num_castle ][ 'max_men' ] . '",`maxres`="' . $GA_castle[ $num_castle ][ 'maxres' ] . '"';
        for ( $i = 1; $i <= 35; $i++ )
            if ( $GA_castle[ $num_castle ][ 'c_' . $i . '_n' ] != "" )
                $qwery = $qwery . ', `c_' . $i . '_n` = "' . $GA_castle[ $num_castle ][ 'c_' . $i . '_n' ] . '"';
        for ( $j = 1; $j <= 4; $j++ )
            for ( $i = 1; $i <= 35; $i++ )
                $qwery = $qwery . ', `c_' . $i . '_' . $j . '` = "' . $GA_castle[ $num_castle ][ 'c_' . $i . '_' . $j ] . '" ';
        for ( $i = 1; $i <= 8; $i++ )
            $qwery = $qwery . ', `army_' . $i . '` = "' . $GA_castle[ $num_castle ][ 'army_' . $i ] . '" ';
        $qwery = $qwery . 'WHERE `x`="' . $GA_castle[ $num_castle ][ 'x' ] . '" AND `y`="' . $GA_castle[ $num_castle ][ 'y' ] . '" AND `z`="' . $GA_castle[ $num_castle ][ 'z' ] . '"';
        mysql_query( $qwery );
    }
    mysql_query( 'UPDATE `game`.`settings` SET `Value` = "' . ( $alt_time - $FASTER ) . '" WHERE `settings`.`name_parametr` = "timers"' );
    mysql_query( 'DELETE FROM `session` WHERE (`time`<"'.( time() + $Time_For_Open_Session).'") AND ( `status` = "0pen" )' );
    F_TranzationDown();
    mysql_close( $links );
    echo 'Transaction is down.<br>GameServer worked is ' . ( microtime( true ) - $micro_time ) . '<br>';
    echo '<script language = \'javascript\'> var delay = ' . $Wait_to_startCron . '; setTimeout("document.location.href=\'Cron.php?hard=' . $get . '\'", delay);</script>';
?>