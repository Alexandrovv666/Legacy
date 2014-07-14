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
function loadXMLDoc(action, n){
    var xmlhttp;
    if (window.XMLHttpRequest){// ��� ��� IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }else{// ��� ��� IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            if (action == "get_time_work_room"){
                document.getElementById("ping").innerHTML=xmlhttp.responseText;
                var getdata = document.getElementById("ping").innerHTML;
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
                    document.getElementById('arm1').innerHTML  =perem[39];
                    document.getElementById('arm2').innerHTML  =perem[40];
                    document.getElementById('arm3').innerHTML  =perem[41];
                    document.getElementById('arm4').innerHTML  =perem[42];
                    document.getElementById('arm5').innerHTML  =perem[43];
                    document.getElementById('arm6').innerHTML  =perem[44];
                    document.getElementById('arm7').innerHTML  =perem[45];
                    document.getElementById('arm8').innerHTML  =perem[46];
                }
            }
            if (action == "mission"){
                document.getElementById("get_data_window_modal_1").innerHTML=xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET","/server/"+action+".php?action="+action+"&num_room="+n,true);
    xmlhttp.send();
}