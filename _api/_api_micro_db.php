<?
function Micro_DB_if_file_exists($path){
  $url = $_SERVER['DOCUMENT_ROOT'].'/micro_db/'.$path;
  $Headers = @get_headers($url);
  if(strpos('200', $Headers[0]))
    return true ;
  else{
    global $Micro_db_ErrorCode;
    $Micro_db_ErrorCode = '00x001x001';
    return false ;
  }
}
?>