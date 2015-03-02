<?php
    class DB {
        var $link = Null;
        var $Host = '127.0.0.1';
        var $login = 'root';
        var $Password = '';
        public function __construct() {
            $this -> link = mysql_connect( $this -> Host,
                                           $this -> login,
                                           $this -> Password);
            mysql_select_db('game');
            mysql_set_charset("CP1251");
        }
        public function __destruct() {
            mysql_close( $this -> link );
        }
    }
    class html {
        var code = '';
        public function htmlPrint() {
            
        }
    }
    class game {
        var $Location;
        public function __construct() {
            $DB   = new DB();
            $html = new html();
        }
        public function SetLocation( $text ) {
            $this -> Location = $text;
            if ( $text == 'castle' ) {
            }
        }
    }
    $game = new game();
    $game -> SetLocation('castle');






















?> 
