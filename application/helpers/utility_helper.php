<?
function asset_url(){
   return base_url().'assets/';
}
function lte_url(){
   return base_url().'assets/lte/';
}
function encode_pass($string)
{
    if($string){
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5('1HdcQDmV4hzvQHT35ZUdSnxbnJMyuqC4'),
                        $string, MCRYPT_MODE_CBC, md5(md5('1HdcQDmV4hzvQHT35ZUdSnxbnJMyuqC4'))));
    }
    else
        return false;
}

function decode_pass($encoded)
{
    if($encoded){
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5('1HdcQDmV4hzvQHT35ZUdSnxbnJMyuqC4'), base64_decode($encoded),
                 MCRYPT_MODE_CBC, md5(md5('1HdcQDmV4hzvQHT35ZUdSnxbnJMyuqC4'))), "\0");
    }
        else
        return false;
}

function gen_password($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}
function dt($date){
    return strftime("%d %b %Y %H:%M",$date);
}
function dt_day($date){
    return strftime("%Y-%m-%d",$date);
}
function dt_calendar($date){
    if($date){
        return strftime("%Y.%m.%d",$date);
    }
    else{
        return false;
    }
}
function dt_utc($date){
    return strftime("%Y, %m, %d",$date);
}
function dt_one($date){
    return strftime("%d",$date);

}
function dt_mon($date){
    return strftime('%Y-%m',strtotime($date));
}
function default_dt($date){
    if($date){
          return strftime("%Y-%m-%d %H:%M",$date);
    }
    else{
        return false;
    }
  

}
function default_dot($date){
    if($date){
          return strftime("%Y.%m.%d %H:%M",$date);
    }
    else{
        return false;
    }
  

}
function default_ms($date){
    if($date){
          return strftime("%M:%S",$date);
    }
    else{
        return false;
    }
  

}


function short_dt($date){
    if($date){
          return strftime("%m/%d %H:%M",$date);
    }
    else{
        return false;
    }
  

}
function default_time($date){
    if($date){
       return  strftime("%H:%M",$date);
    }
    else{
        return false;
    }


    

}
function day_dt($date){
    return strftime("%Y-%m-%d",$date);

}
function day_dt_y($date){
    return strftime("%m-%d",$date);

}
function num_format($number){
    return number_format($number,2,'.','');
}
function last_day($number){
    return strtotime($number)+date('t',(strtotime($number)))*86399;
}
function dot_day($date){
    return strftime("%d.%m.%Y",$date);
}
function long_ip($IPaddr)
{
    if ($IPaddr == "") {
        return 0;
    } else {
        $ips = explode(".", $IPaddr);
        return ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256);
    }
}
function phone_ch($str){
    $count = preg_match_all('/\\d/', $str);
    if($count==10){
        return $str;
    }
    else{
        return '';

    }

}

