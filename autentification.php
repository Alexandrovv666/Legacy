<?php
    if ( basename( $_SERVER[ 'PHP_SELF' ] ) != 'autentification.php' ) {
        http_response_code( 404 );
        header( "404 Not Found" );
        exit;
    }
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_constant/char.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_api/mysql.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_api/processe_data.php';
    include $_SERVER[ 'DOCUMENT_ROOT' ] . '/_api/log.php';
    $linkss   = F_Connect_MySQL();
    $login    = $_GET[ 'login' ];
    $password = $_GET[ 'password' ];
    global $C_Text_noSpace, $C_Numberic;
    if ( !Chek_string_of_mask( $login, ( $C_Numberic . $C_Text_noSpace ) ) ) {
        echo 'warining|Логин некорректен';
        exit;
    }
    if ( !Chek_string_of_mask( $password, ( $C_Numberic . $C_Text_noSpace ) ) ) {
        echo 'warining|Пароль некорректен';
        exit;
    }
    $sol_of_login      = 'teamlead';
    $sol_of_password_1 = 'Game';
    $sol_of_password_2 = 'LegacyOfWarriors';
    $md5_of_login_user = md5( $login . $sol_of_login );
    $hach_of_password  = crypt( $login, $sol_of_login ) . crypt( $password, $sol_of_login ) . crypt( $login, $md5_of_login_user ) . crypt( $password, $md5_of_login_user ) . crypt( $login, $sol_of_password_1 ) . crypt( $password, $sol_of_password_1 ) . crypt( $login, $sol_of_password_2 ) . crypt( $password, $sol_of_password_2 ) . crypt( $login, $md5_of_login_user ) . crypt( $password, $md5_of_login_user ) . crypt( $login, $password );
    $table_list        = mysql_query( 'SELECT login FROM `users` WHERE `password`="' . $hach_of_password . '"' );
    while ( $row = mysql_fetch_row( $table_list ) )
        if ( strtolower( $login ) == strtolower( $row[ '0' ] ) ) {
            $chars    = $C_Numberic . $C_Text_noSpace;
            $numChars = strlen( $chars );
            $session  = '';
            for ( $i = 0; $i < 25; $i++ )
                $session .= substr( $chars, rand( 1, $numChars ) - 1, 1 );
            mysql_query( 'INSERT INTO `session` (`time`, `login`, `status`, `ip`, `session`) VALUES ("' . time() . '","' . $_GET[ 'login' ] . '","opening","' . $_SERVER[ 'REMOTE_ADDR' ] . '","' . $session . '")' );
            mysql_query( 'INSERT INTO `aut_history`(`time`, `login`, `ip`, `session`, `user_agent`) VALUES ("' . time() . '","' . $_GET[ 'login' ] . '","' . $_SERVER[ 'REMOTE_ADDR' ] . '","' . $session . '","0_0")' );
            echo '<script language = \'javascript\'>var delay = 100; setTimeout("document.location.href=\'SetCookie.php?login=' . $login . '\'", delay); </script>';
            exit;
        }
    echo 'warining|Комбинация логин-пароль не найдены.';
?>
