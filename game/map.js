/*   NAVIGATION*/
function go_to_cell(x, f){
    if (x==8){
        var y1=get_cookie("Y_map");
        document.cookie="Y_map="+f;
    }
    if (x==2){
        var y1=get_cookie("Y_map");
        document.cookie="Y_map="+f;
    }
    if (x==4){
        var x1=get_cookie("X_map");
        document.cookie="X_map="+f;
    }
    if (x==6){
        var x1=get_cookie("X_map");
        document.cookie="X_map="+f;
    }
    window.location='';
}

function Click_map(z2){
    var x1=get_cookie("X");
    var y1=get_cookie("Y");
    var z1=get_cookie("Z");
    var x2=get_cookie("X_map");
    var y2=get_cookie("Y_map");
    $("#map_time_to_ziel").load("/server/getspeed.php?action=getspeed&x1="+x1+"&y1="+y1+"&z1="+z1+"&x2="+x2+"&y2="+y2+"&z2="+z2);
    setInterval($("#variants_mission").load("/server/getsvariants_mission.php?action=getsvariants_mission&x2="+x2+"&y2="+y2+"&z2="+z2), 5200);
    document.getElementById('map_ziel').innerHTML="Цель: "+x2+"-"+y2+"-"+z2;
    document.getElementById('info_mission').innerHTML="Миссия из ["+x1+"-"+y1+"-"+z1+"] в ["+x2+"-"+y2+"-"+z2+"]<br>";
}
function StartAtack(z2){//загрузить окно отправки войск
    var x1=get_cookie("X");
    var y1=get_cookie("Y");
    var z1=get_cookie("Z");
    var x2=get_cookie("X_map");
    var y2=get_cookie("Y_map");
    document.getElementById("Window_box").innerHTML='<img src="Img/interface/other/loading.gif" width="34px">';
    $("#Window_box").load("/server/loadwindowatack.php?action=loadwindowatack&x1="+x1+"&y1="+y1+"&z1="+z1+"&x2="+x2+"&y2="+y2+"&z2="+z2);
    document.getElementById('button_box').innerHTML="";
}
function correct_army(){
    for (var i = 1; i <= 8; i++) {
        value = document.getElementById("rangearmy"+i).value;
        document.getElementById('army_in_atack'+i).innerHTML=value;
    }
}
function Start_atack_mission(z2){
    var a1 = document.getElementById("army_in_atack1").innerHTML;
    var a2 = document.getElementById("army_in_atack2").innerHTML;
    var a3 = document.getElementById("army_in_atack3").innerHTML;
    var a4 = document.getElementById("army_in_atack4").innerHTML;
    var a5 = document.getElementById("army_in_atack5").innerHTML;
    var a6 = document.getElementById("army_in_atack6").innerHTML;
    var a7 = document.getElementById("army_in_atack7").innerHTML;
    var a8 = document.getElementById("army_in_atack8").innerHTML;
    var x1=get_cookie("X");
    var y1=get_cookie("Y");
    var z1=get_cookie("Z");
    var x2=get_cookie("X_map");
    var y2=get_cookie("Y_map");
    $("#Window_box").load("/server/atack_mission_grab.php?action=atack_mission_grab&a1="+a1+"&a2="+a2+"&a3="+a3+"&a4="+a4+"&a5="+a5+"&a6="+a6+"&a7="+a7+"&a8="+a8+"&x1="+x1+"&y1="+y1+"&z1="+z1+"&x2="+x2+"&y2="+y2+"&z2="+z2);
}

function StartSpy(z2){
    var x2=get_cookie("X_map");
    var y2=get_cookie("Y_map");
    document.getElementById("Window_box").innerHTML='<img src="Img/interface/other/loading.gif" width="34px">';
    $("#Window_box").load("/server/loadwindowspy.php?action=loadwindowspy&x2="+x2+"&y2="+y2+"&z2="+z2);
    document.getElementById('button_box').innerHTML="";
}
function resetWindow_map_click(){
    document.getElementById('Window_map_click').innerHTML='<div class="scroll"><a href="#close" title="Закрыть" class="close" onclick="resetWindow_map_click()">X</a><h2><div id="map_ziel">map_ziel</div></h2><h3><div id="info_mission">info_mission</div></h3><div align="right"><div id="map_time_to_ziel">map_time_to_ziel</div></div><div id="button_box"><div id="variants_mission"><img src="Img/interface/other/loading.gif" width="34px"></div></div><div id="Window_box"></div></div>';
}

function rechangemap(z, n){
    document.getElementById("Window_box").innerHTML='<img src="Img/interface/other/loading.gif" width="34px">';
    $("#Window_box").load("/server/change.php?action=change&z_map="+z+"&Y_map="+get_cookie("Y_map")+"&X_map="+get_cookie("X_map")+"&n="+n);
}

