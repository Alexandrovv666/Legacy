function Clickroom(n){
    $("#get_data_window_modal_1").load("/server/listwork.php?action=listwork&num_room="+n);
}
function StartWorkRoom(name, n){
    $("#get_data_window_modal_1").load("/server/StartWorkRoom.php?action=StartWorkRoom&num_room="+n+"&name="+name);
}
function CorrectMenForWork(max_men, sklad_men){
    value = document.getElementById("men_for_work").value;
    if (value>sklad_men)
         document.getElementById('men_to_work_user').innerHTML=sklad_men+"/"+max_men;
    else
         document.getElementById('men_to_work_user').innerHTML=value+"/"+max_men;
}
function get_info_castle(){
    $("#get_data_window_modal_1").load("/server/get_info_castle.php?action=get_info_castle");
}
function GetUnits(n){
    var x1=get_cookie('X');
    var y1=get_cookie('Y');
    var z1=get_cookie('Z');
    $("#timer"+n).load("/server/getUnits.php?action=getUnits&num_room="+n);
    resetWindowArb();
}
function StartWorks(name_new_room, n){
    $("#room-"+n).load("/server/newroom.php?action=newroom&num_room="+n+"&namenewroomroom="+name_new_room);
    resetWindowArb();
}
function donat_work(n){
    var x1=get_cookie('X');
    var y1=get_cookie('Y');
    var z1=get_cookie('Z');
    $("#timer"+n).load("/server/donat_work.php?action=donat_work&num_room="+n+"&x="+x1+"&y="+y1+"&z="+z1);
}
function StartExpedition(num_room){
    var x2=document.getElementById('x2').value;
    var y2=document.getElementById('y2').value;
    $("#timer"+num_room).load("/server/start_expedition.php?action=start_expedition&num_room="+num_room);
}
function Delete_room(n){
    $("#room-"+n).load("/server/delete_room.php?action=delete_room&num_room="+n);
    resetWindowArb();
}
function resetWindowArb(){
    document.getElementById('openModal').innerHTML='<div><a href="#close" title="Закрыть" class="close" onclick="resetWindowArb()">X</a><h2><div id="num_room"></div></h2><h3><div id="room_name"></div></h3><div id="listwork"><img src="Img/interface/other/loading.gif" width="34px"></div></div>';
}
function reset_window_modal_1(){
    document.getElementById('window_modal_1').innerHTML='<div><a href="#close" title="Закрыть" class="close" onclick="reset_window_modal_1()">X</a><div id="get_data_window_modal_1"><img src="Img/interface/other/loading.gif" width="34px"></div></div>';
}













