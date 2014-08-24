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
      var perem = getdata.split('|');
      if  (perem[0]=='ok'){
         for (var i = 1; i <= 35; i++){
            if (perem[i]!="0:0:0:0"){
               var arr = perem[i].split(':');
                  document.getElementById("timer"+i).innerHTML=arr[0]+":"+arr[1]+":"+arr[2]+":"+arr[3];
               }else
                  document.getElementById("timer"+i).innerHTML="";
        }
        document.getElementById("gold").innerHTML  =perem[36];
        document.getElementById("tree").innerHTML  =perem[37];
        document.getElementById("stone").innerHTML =perem[38];
        document.getElementById("men").innerHTML   =perem[39];
        document.getElementById('arm1').innerHTML  =perem[40];
        document.getElementById('arm2').innerHTML  =perem[41];
        document.getElementById('arm3').innerHTML  =perem[42];
        document.getElementById('arm4').innerHTML  =perem[43];
        document.getElementById('arm5').innerHTML  =perem[44];
        document.getElementById('arm6').innerHTML  =perem[45];
        document.getElementById('arm7').innerHTML  =perem[46];
        document.getElementById('arm8').innerHTML  =perem[47];
        document.getElementById("room-"+n).innerHTML  =perem[48];
      }
   }
});
    reset_window_modal_1();
}
function CorrectMenForWork(max_men_of_room, max_men_in_castle){
    value = document.getElementById("men_for_work").value;
    if (value>max_men_in_castle){
        document.getElementById('men_to_work_user').innerHTML=max_men_in_castle+" / "+max_men_of_room;
        document.getElementById('to_works').innerHTML=max_men_in_castle;
    }else{
        document.getElementById('men_to_work_user').innerHTML=value+" / "+max_men_of_room;
        document.getElementById('to_works').innerHTML=value;
    }
}

function CorrectMenForWorkCH(max_men_of_room, max_men_in_castle, worked){
    var range_people_at_work = (+(document.getElementById("range_people_at_work").value));
    var will_to_work = range_people_at_work - worked;
    if (will_to_work>max_men_in_castle){
        document.getElementById('will_men_to_work').innerHTML=max_men_in_castle+" из "+max_men_of_room;
        document.getElementById('add_to_works').innerHTML=max_men_in_castle;
    }else{
        document.getElementById('will_men_to_work').innerHTML=(worked + will_to_work)+" из "+max_men_of_room;
        document.getElementById('add_to_works').innerHTML=will_to_work;
    }
}

function get_info_castle(){
    $("#get_data_window_modal_1").load("/server/get_info_castle.php?action=get_info_castle");
}

function ChangeMen(num_room){
    var men = document.getElementById("add_to_works").innerHTML;
$.ajax({
   url: "/server/change.php?action=change&men="+men+"&num_room="+num_room,
   type: 'get',
   success: function(getdata){
      var perem = getdata.split('|');
      if  (perem[0]=='ok'){
         for (var i = 1; i <= 35; i++){
            if (perem[i]!="0:0:0:0"){
               var arr = perem[i].split(':');
                  document.getElementById("timer"+i).innerHTML=arr[0]+":"+arr[1]+":"+arr[2]+":"+arr[3];
               }else
                  document.getElementById("timer"+i).innerHTML="";
        }
        document.getElementById("gold").innerHTML  =perem[36];
        document.getElementById("tree").innerHTML  =perem[37];
        document.getElementById("stone").innerHTML =perem[38];
        document.getElementById("men").innerHTML   =perem[39];
        document.getElementById('arm1').innerHTML  =perem[40];
        document.getElementById('arm2').innerHTML  =perem[41];
        document.getElementById('arm3').innerHTML  =perem[42];
        document.getElementById('arm4').innerHTML  =perem[43];
        document.getElementById('arm5').innerHTML  =perem[44];
        document.getElementById('arm6').innerHTML  =perem[45];
        document.getElementById('arm7').innerHTML  =perem[46];
        document.getElementById('arm8').innerHTML  =perem[47];
        document.getElementById("room-"+n).innerHTML  =perem[48];
      }
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
