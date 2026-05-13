<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function number_format_fk($number = '', $digit=2){    
    return ($number) ? number_format($number,$digit) : 0;
}

function urldecode_fk($pram=''){
    return ($pram) ? urldecode($pram) : '';
}

function json_decode_fk($pram=''){
    return ($pram) ? json_decode($pram) : '';
}

function strtolower_fk($pram=''){
    return strtolower($pram ?: '');
}

function base64_decode_fk($pram=''){
    return base64_decode($pram ?: '');
}

function strtotime_fk($pram=''){
    return strtotime($pram ?: '');
}

function ucfirst_fk($pram=''){
    return ucfirst($pram ?: '');
}

function strip_tags_fk($pram=''){
    return strip_tags($pram ?: '');
}

function trim_fk($pram=''){
    return trim($pram ?: '');
}

function abs_fk($pram=''){
    $int = intval( $pram);
    return abs( $int ) ?: 0;
}