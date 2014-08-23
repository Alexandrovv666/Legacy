<?
function F_stepen($x, $n){
    for ($i = 1; $i < ($n); $i++)
        $x=$x*$x;
    return $x;
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
function Shans($x){
    if ($x>=100)
        return true;
    if ($x<=0)
        return false;
    if (rand(0,100)<=$x)
        return true;
    return false;
}
function F_distortion($num){
    if (rand(0,2)==1)
        return incPrz($num,rand(0,20));
    else
        return decPrz($num,rand(0,20));
}
function incPrz($chislo, $prz){
    return floor($chislo + ($chislo / 100 * $prz));
}
function decPrz($chislo, $prz){
    if ($prz>=100)
        return 0;
    return floor($chislo - ($chislo / 100 * $prz));
}
function FSowZnak($chislo){
    if ($chislo > 0)
        return '+' . $chislo . '%';
    if ($chislo < 0)
        return '-'.$chislo . '%';
    if ($chislo = 0)
        return '';
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