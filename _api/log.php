<?
function loging($text){
    $file_name = $_SERVER['DOCUMENT_ROOT'].'/log/'.date("Y-m-d-H").'.log';
    $file = fopen($file_name,"a+");
    fwrite($file, date("Y-m-d H:i:s").' => '.$_SERVER['PHP_SELF'].PHP_EOL.$text.PHP_EOL);
    fclose($file);
}
function Create_DUMP($text){
    $file_name = $_SERVER['DOCUMENT_ROOT'].'/log/'.date("Y-m-d-H-i-s").'.dump';
    $file = fopen($file_name,"a+");
    fwrite($file, $text);
    fclose($file);
}
function mysql_query_log($x){
    $res=mysql_query($x);
    $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/log/mysql.log', 'a+');
    fwrite($fp, $x.PHP_EOL);
    fclose($fp);
    return $res;
}
function log_admin($text){
    $file_name = $_SERVER['DOCUMENT_ROOT'].'/log/admlog.log';
    $file = fopen($file_name,"a+");
    fwrite($file, date("Y-m-d H:i:s").' - ['.$_SERVER['REMOTE_ADDR'].'] => '.$_SERVER['PHP_SELF'].PHP_EOL.$text.PHP_EOL);
    fclose($file);
}
?>