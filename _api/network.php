<?
function Is_Local_IP(){
    if ($_SERVER['REMOTE_ADDR'] == $_SERVER['SERVER_ADDR'])
        return true;
    return false;
}
function Only_Local_IP(){
    if (!Is_Local_IP()){
        header("HTTP/1.0 404 Not Found");
        echo 'Страница не найдена';
        exit;
    }
}
function Is_Local_Subnetwork(){
    $ip_client = $_SERVER['REMOTE_ADDR'];
    $results   = strripos($ip_client, '192.168.1.');
    if ($results !== false)
        return true;
    $results   = strripos($ip_client, '192.168.0.');
    if ($results !== false)
        return true;
    return false;
}
?>