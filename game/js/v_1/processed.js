function processed_general_parser_data(){
    perem = ParserData.split(';');
    if  (perem[0]=='ok'){
        processed_time_room_parser();
        processed_res_parser();
        processed_army_parser();
    }else{
        window.location='/Exit.php';
    }
}
function processed_time_room_parser(){
    var tmp = perem[1].split('|');
    for (var i = 0; i <= 34; i++){
        if (tmp[i]!="0:0:0:0")
            document.getElementById("timer"+(i+1)).innerHTML=tmp[i];
        else
            document.getElementById("timer"+(i+1)).innerHTML="";
    }
}
function processed_res_parser(){
    var tmp_arr = perem[2].split('|');
    document.getElementById("gold").innerHTML  = tmp_arr[0];
    document.getElementById("tree").innerHTML  = tmp_arr[1];
    document.getElementById("stone").innerHTML = tmp_arr[2];
    document.getElementById("men").innerHTML   = tmp_arr[3];
}

function processed_army_parser(){
    var tmp_arr = perem[3];
    var tmp = tmp_arr.split('|');

    for (var i = 0; i <= 7; i++)
        document.getElementById('arm'+(i+1)).innerHTML = tmp[i];
}
















