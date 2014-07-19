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
function supports_html5_storage() {
  try {
    return 'localStorage' in window && window['localStorage'] !== null;
} catch (e) {
    return false;
  }
}
function getClientWidth(){
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;  
}

function getClientHeight(){
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:document.body.clientHeight;
}
function getBodyScrollTop(){
  return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
}

function getBodyScrollLeft(){
  return self.pageXOffset || (document.documentElement && document.documentElement.scrollLeft) || (document.body && document.body.scrollLeft);
}
function isIntoView(elem, leftScroll, ClientWidth, topScroll, Clientheight){
var pos = $("#"+elem).offset();
var top = (pos.top);
var left = (pos.left);
var width = $("#"+elem).width();
var height = $("#"+elem).height();
if ((leftScroll<(left+width)) && ((leftScroll+ClientWidth)>(left))){
    if ((topScroll<(top+height)) && ((topScroll+Clientheight)>(top)))
        return true;
    else 
        return false;
}else 
    return false;
}


