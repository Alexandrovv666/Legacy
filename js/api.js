function get_cookie(name){
    cookie_name = name + "=";
    cookie_length = document.cookie.length;
    cookie_begin = 0;
    while (cookie_begin < cookie_length){
        value_begin = cookie_begin + cookie_name.length;
        if (document.cookie.substring(cookie_begin, value_begin) == cookie_name){
            var value_end = document.cookie.indexOf (";", value_begin);
            if (value_end == -1){
                value_end = cookie_length;
            }
            return unescape(document.cookie.substring(value_begin, value_end));
        }
        cookie_begin = document.cookie.indexOf(" ", cookie_begin) + 1;
        if (cookie_begin == 0){
            break;
        }
    }
    return null;
}
function api_get_data(){
   $.ajax({
      url: "/server/givedata.php?act=null",
      type: 'get',
      success: function(getdata){
          ParserData = getdata;
          processed_general_parser_data();
      }
   });
   timeot_givedata = max_timeot_givedata;
}

function api_window_modal_message_close(){
    document.getElementById("window-modal").innerHTML="";
    document.getElementById("window-modal").style.display = "none";
}
function api_window_modal_message_get_data(urladress){
    $.ajax({
        url: urladress,
        type: 'get',
        success: function(getdata){
            var perem = getdata.split('|');
                if  (perem[0]=='ok'){
                    document.getElementById("window-modal-message-caption").innerHTML=perem[1];
                    document.getElementById("window-modal-message-text").innerHTML=perem[2];
                }else{
                    window.location='/Exit.php';
                }
            }
        });
}
function api_window_modal_message_open(action, param1){
    document.getElementById("window-modal").style.display = "block";
    document.getElementById("window-modal").innerHTML='<block id="window-modal" class="big-text"><obj id="window-modal-message-buttom-close" onclick="api_window_modal_message_close()">X</obj><obj id="window-modal-message-caption">Load cubject</obj><obj id="window-modal-message"><obj id="window-modal-message-text">Load text</obj></obj></block>';
    if (action=="click_room"){
       $.ajax({
            url: "/server/listwork.php?action=listwork&num_room="+param1,
            type: 'get',
             success: function(getdata){
                 var perem = getdata.split('|');
                 if  (perem[0]=='ok'){
                     document.getElementById("window-modal-message-caption").innerHTML=perem[1];
                     document.getElementById("window-modal-message-text").innerHTML=perem[2];
                 }else{
                     window.location='/Exit.php';
                 }
            }
        });
    }
    if (action=="quest"){
       $.ajax({
            url: "/server/quest.php?action=list",
            type: 'get',
             success: function(getdata){
                 var perem = getdata.split('|');
                 if  (perem[0]=='ok'){
                     document.getElementById("window-modal-message-caption").innerHTML=perem[1];
                     document.getElementById("window-modal-message-text").innerHTML=perem[2];
                 }else{
                     window.location='/Exit.php';
                 }
            }
        });
    }
    if (action=="get_info_castle"){
       $.ajax({
            url: "/server/get_info_castle.php?action=get_info_castle",
            type: 'get',
             success: function(getdata){
                 var perem = getdata.split('|');
                 if  (perem[0]=='ok'){
                     document.getElementById("window-modal-message-caption").innerHTML=perem[1];
                     document.getElementById("window-modal-message-text").innerHTML=perem[2];
                 }else{
                     window.location='/Exit.php';
                 }
            }
        });
    }
    if (action=="map_cell_click"){
       $.ajax({
            url: "/server/map.php?action=get_info_cell&z="+param1,
            type: 'get',
             success: function(getdata){
                 var perem = getdata.split('|');
                 if  (perem[0]=='ok'){
                     document.getElementById("window-modal-message-caption").innerHTML=perem[1];
                     document.getElementById("window-modal-message-text").innerHTML=perem[2];
                 }else{
                     window.location='/Exit.php';
                 }
            }
        });
    }
}
function secToTime(sec){
    d = Math.floor( sec/(60*60*24));
    sec = sec - (60*60*24*d);
    h = Math.floor( sec/(60*60));
    sec = sec - (60*60*h);
    m = Math.floor( sec/(60));
    sec = sec - (60*m);
    if(d<10) d = "0"+d;
    if(h<10) h = "0"+h;
    if(m<10) m = "0"+m;
    if(sec<10) sec = "0"+sec;
    return  d+":"+h+":"+m+":"+sec;
}
function TimeToSec(time){ 
    var arr = time.split(':');
    return (+arr[0]*60*60*24)+(+arr[1]*60*60)+(+arr[2]*60)+(+arr[3]);
}
