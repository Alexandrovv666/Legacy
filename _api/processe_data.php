<?
function Chek_string_of_mask($String, $Mask){
    $Lenght_String = strlen($String);
    if ($Lenght_String==0)
        return false;
    for ($i = 0; $i < ($Lenght_String); $i++)
        if (substr_count($Mask, $String[$i])==0)
            return false;
    return true;
}
function add_length_string($text, $length){
    while (strlen($text)<$length)
        $text=' '.$text;
    return $text;
}
function onlyInt($int_text){
    for ($i = 0; $i < strlen($int_text); $i++)
        if (is_numeric($int_text[$i]))
            $res=$res.$int_text[$i];
    if ($res=='')
        $res=0;
    return $res;
}
function onlyNoInt($int_text){
    for ($i = 0; $i < strlen($int_text); $i++)
        if (!(is_numeric($int_text[$i])))
            $res=$res.$int_text[$i];
    return $res;
}
function FShowNumInSpace($x){
    return str_replace(",", '  ', number_format($x));
}
function FAlgin($x,$n){
    return str_replace(",", '  ', number_format($x));
}
function int_to_time($int){
    if ($int==0)
        return "";
    $sec  = 0;
    $min  = 0;
    $hour = 0;
    $day  = 0;
    if ($int >= 86400){
        $day = floor($int / 86400);
        $int = $int - $day*86400;
    }
    if ($int >= 60*60*1){
        $hour = floor($int / (60*60));
        $int  = $int - $hour*60*60*1;
    }
    if ($int >= 60*1){
        $min = floor($int / 60);
        $int = $int - $min*60*1;
    }
    if ($int > 0)
        $sec = $int;
    if ($sec < 10)
        $sec = '0'.$sec;
    if ($min < 10)
        $min = '0'.$min;
    if ($hour < 10)
        $hour = '0'.$hour;
    if ($day < 10)
        $day = '0'.$day;
    return $day . ':'.$hour . ':'.$min . ':'.$sec;
}
?>