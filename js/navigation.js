function go_to_map(){
  document.cookie="ort=map";
  window.location='';
  document.cookie="mapX="+get_cookie("casX");
  document.cookie="mapY="+get_cookie("casY");
}
function go_to_castle(){
  document.cookie="ort=castle";
  window.location='';
}
function go_to_exit(){
  if (confirm("Вы нас покидаете?"))
    if (confirm("Вы точно вернётесь?"))
      window.location='/Exit.php';
}
function go_to_cell(x, y){
  document.cookie="mapX="+x;
  document.cookie="mapY="+y;
  window.location='';
}
