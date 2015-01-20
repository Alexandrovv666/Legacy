function StartAtack(){
    var x1=document.getElementById('castle_X').innerHTML;
    var y1=document.getElementById('castle_Y').innerHTML;
    var z1=document.getElementById('castle_Z').innerHTML;
    var x2=document.getElementById('X').innerHTML;
    var y2=document.getElementById('Y').innerHTML;
    var z2=document.getElementById('Z').innerHTML;
    $("#Window_box").load("server.php?action=loadwindowatack&x1="+x1+"&y1="+y1+"&z1="+z1+"&x2="+x2+"&y2="+y2+"&z2="+z2);
    document.getElementById('button_box').innerHTML="";
}
function Start_atack_mission(){
    var x1=document.getElementById('castle_X').innerHTML;
    var y1=document.getElementById('castle_Y').innerHTML;
    var z1=document.getElementById('castle_Z').innerHTML;
    var x2=document.getElementById('X').innerHTML;
    var y2=document.getElementById('Y').innerHTML;
    var z2=document.getElementById('Z').innerHTML;
    var a1=document.getElementById('army_in_atack1').innerHTML;
    var a2=document.getElementById('army_in_atack2').innerHTML;
    var a3=document.getElementById('army_in_atack3').innerHTML;
    var a4=document.getElementById('army_in_atack4').innerHTML;
    var a5=document.getElementById('army_in_atack5').innerHTML;
    var a6=document.getElementById('army_in_atack6').innerHTML;
    var a7=document.getElementById('army_in_atack7').innerHTML;
    var a8=document.getElementById('army_in_atack8').innerHTML;
    $("#Window_box").load("server.php?action=atack_mission_grab&x1="+x1+"&y1="+y1+"&z1="+z1+"&x2="+x2+"&y2="+y2+"&z2="+z2+"&a1="+a1+"&a2="+a2+"&a3="+a3+"&a4="+a4+"&a5="+a5+"&a6="+a6+"&a7="+a7+"&a8="+a8);
    document.getElementById('button_box').innerHTML="";
}
function StartSpy(){
    var x2=document.getElementById('X').innerHTML;
    var y2=document.getElementById('Y').innerHTML;
    var z2=document.getElementById('Z').innerHTML;
    $("#Window_box").load("server.php?action=loadwindowspy&x2="+x2+"&y2="+y2+"&z2="+z2);
    document.getElementById('button_box').innerHTML="";
}
function selectcastle(){
    var sel = document.getElementById("namecastle");
    var val = sel.options[sel.selectedIndex].value;
    var arr = val.split(',');
    document.getElementById('castle_X').innerHTML=arr[0];
    document.getElementById('castle_Y').innerHTML=arr[1];
    document.getElementById('castle_Z').innerHTML=arr[2];
}
function donat_work(n){
    var x1=document.getElementById('castle_X').innerHTML;
    var y1=document.getElementById('castle_Y').innerHTML;
    var z1=document.getElementById('castle_Z').innerHTML;
    $("#time_"+n).load("server.php?action=donat_work&num_room="+n+"&x="+x1+"&y="+y1+"&z="+z1+"&UID="+get_cookie("UID")+"&Login="+get_cookie("Login"));
}