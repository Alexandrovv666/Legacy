<?
    if (!$enable_access){
        header("404 Not Found");
        http_response_code(404);
        echo "404 Not Found";
        $log_access .='Message "404 Not Found".'.PHP_EOL;
        loging($log_access);
        exit;
    }
?>