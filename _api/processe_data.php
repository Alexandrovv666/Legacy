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
?>