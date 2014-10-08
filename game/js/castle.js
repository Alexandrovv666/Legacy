function Clickroom(n){
    $("#get_data_window_modal_1").load("/server/listwork.php?action=listwork&num_room="+n);
}
function StartWorkRoom(name, n){
    $("#get_data_window_modal_1").load("/server/StartWorkRoom.php?action=StartWorkRoom&num_room="+n+"&name="+name);
}
function StartWorks(name, n){
    var men = document.getElementById("to_works").innerHTML;
$.ajax({
   url: "/server/newroom.php?action=newroom&num_room="+n+"&namenewroomroom="+name+"&men="+men,
   type: 'get',
   success: function(getdata){
       document.getElementById('room-'+n).innerHTML=getdata;
       api_get_data();
   }
});
    reset_window_modal_1();
}
function CorrectMenForWork(max_men_of_room, max_men_in_castle){
    value = document.getElementById("men_for_work").value;
    var res = 0;
    if (value>max_men_in_castle){
        document.getElementById('men_to_work_user').innerHTML=max_men_in_castle+" / "+max_men_of_room;
        document.getElementById('to_works').innerHTML=max_men_in_castle;
        res = max_men_in_castle;
    }else{
        document.getElementById('men_to_work_user').innerHTML=value+" / "+max_men_of_room;
        document.getElementById('to_works').innerHTML=value;
        res = value;
    }
    var max_time_work = document.getElementById('def_time_of_work').innerHTML;
    document.getElementById('time_of_work').innerHTML=secToTime(Math.floor(TimeToSec(max_time_work)*(max_men_of_room/res)));
}
function CorrectMenForWorkCH(def_men, max_men_of_room, max_men_in_castle, worked, time_before, alt_men){
    var range_people_at_work = (+(document.getElementById("range_people_at_work").value));
    var will_to_work = range_people_at_work - worked;
    if (will_to_work>max_men_in_castle){
        document.getElementById('will_men_to_work').innerHTML=max_men_in_castle+" из "+max_men_of_room;
        document.getElementById('add_to_works').innerHTML=max_men_in_castle;
    }else{
        document.getElementById('will_men_to_work').innerHTML=(worked + will_to_work)+" из "+max_men_of_room;
        document.getElementById('add_to_works').innerHTML=will_to_work;
    }
    document.getElementById('time_of_work').innerHTML=secToTime(Math.floor((alt_men/range_people_at_work)*time_before));
}

function get_info_castle(){
    $("#get_data_window_modal_1").load("/server/get_info_castle.php?action=get_info_castle");
}

function get_quest(){
$.ajax({
   url: "/server/quest.php?action=list",
   type: 'get',
   success: function(getdata){
      document.getElementById('get_data_window_modal_1').innerHTML=getdata;
   }
});
}
function get_quest_text(n){
$.ajax({
   url: "/server/quest.php?action=one&num="+n,
   type: 'get',
   success: function(getdata){
      document.getElementById('quest_box'+n).innerHTML=getdata;
   }
});
}

function ChangeMen(num_room){
    var men = document.getElementById("add_to_works").innerHTML;
$.ajax({
   url: "/server/change.php?action=change&men="+men+"&num_room="+num_room,
   type: 'get',
   success: function(getdata){
      if (getdata=='ok')
          api_get_data();
   }
});
}
function GetUnits(n){
    var x1=get_cookie('X');
    var y1=get_cookie('Y');
    var z1=get_cookie('Z');
    $("#timer"+n).load("/server/getUnits.php?action=getUnits&num_room="+n);
    reset_window_modal_1();
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
    reset_window_modal_1();
}
function reset_window_modal_1(){
    document.getElementById('window_modal_1').innerHTML='<div><a href="#close" title="Закрыть" class="close" onclick="reset_window_modal_1()">X</a><div id="get_data_window_modal_1"><img src="Img/interface/other/loading.gif" width="34px"></div></div>';
}