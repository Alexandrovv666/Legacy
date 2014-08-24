<?
function F_stepen($x, $n){
    for ($i = 1; $i < ($n); $i++)
        $x=$x*$x;
    return $x;
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
?>