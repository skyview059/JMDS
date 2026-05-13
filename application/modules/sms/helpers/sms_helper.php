<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function isUnicode_v1($string){
    $string = str_replace("\r\n", '', $string);
    if (strlen($string) != strlen(mb_strlen($string))){
        return 'UNICODE';
    } else {
        return 'TEXT';
    }
}

function isUnicode($text) {
    $filter = str_replace("\r\n", '', $text);
    return isGsm7($filter) ? 'TEXT' : 'UNICODE';
}

function smsQTY($string){
    $characters = smsCharsCount($string);
    $textType   = isUnicode($string);    
    return ( $textType  == 'UNICODE') ? ceil($characters / 70) : ceil($characters / 160);
    
}
function smsCharsCount($string){
    $remove_nl = str_replace("\r\n", '', $string);
    $cleanup = strip_tags( trim($remove_nl) );
    return iconv_strlen($cleanup, 'UTF-8');    
}

function deliveryStatus($string=null){
    if(empty($string)){ return NULL; }
    $array = json_decode($string, true);    
    return isset($array['api_response_message']) ? $array['api_response_message'] : null;    
}

function deliveryCode($string=null){
    if(empty($string)){ return null; }
    $array = json_decode($string, true);    
    return isset($array['response_code']) ? $array['response_code'] : null;
}

function code2StatusSync($string=null){
    if(empty($string)){ return NULL; }
    $array = json_decode($string, true);    
    return isset($array['api_response_message']) ? $array['api_response_message'] : null;    
}

function deliveryCodeXXX($string=null, $key = 'response_code'){
    if(empty($string)){ return '9999'; }
    $array = json_decode($string, true);    
    return isset($array['api_response_code']) ? $array['api_response_code'] : '9999';
}

function isGsm7($text) {
    $gsm7Chars = '@£$¥èéùìòÇØøÅåΔ_ΦΓΛΩΠΨΣΘΞÆæßÉ !"#¤%&\'()*+,-./0123456789:;<=>?¡ABCDEFGHIJKLMNOPQRSTUVWXYZÄÖÑÜ§¿abcdefghijklmnopqrstuvwxyzäöñüà^{}\\[~]|€';
    
    for ($i = 0, $len = mb_strlen($text, 'UTF-8'); $i < $len; $i++) {
        if (strpos($gsm7Chars, mb_substr($text, $i, 1, 'UTF-8')) === false) {
            return false; // Found a non-GSM-7 character
        }
    }
    return true;
}
