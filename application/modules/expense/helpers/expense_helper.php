<?php defined('BASEPATH') OR exit('No direct script access allowed');

function hideExpVoidBtn( $timestamp, $id ){
    $now    = time() - (24 * 60 * 60); // 12 hrs Less
    $entry  = strtotime($timestamp);
    if($now >= $entry ){
        return '<span class="btn btn-xs btn-danger disabled">Locked</span>';
    } else {
        return anchor(
            site_url(Backend_URL . 'expense/void/' . $id ), 
            '<i class="fa fa-fw fa-ban"></i> Void ', 
            'class="btn btn-xs btn-danger"'
        );
    }
}