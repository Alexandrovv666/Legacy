function go_to_map(){
  document.cookie="ort=map";
  window.location='';
}
function go_to_castle(){
  document.cookie="ort=castle";
  window.location='';
}
function go_to_exit(){
  if (confirm("Хотите выйти?"))
    window.location='/Exit.php';
}