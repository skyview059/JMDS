<?php defined('BASEPATH') OR exit('No direct script access allowed');

function transTabs($id, $active_tab) {
	$html = '<ul class="tabsmenu">';
	$tabs = [
                'read'   => 'Details',
                'update' => 'Update',
                'delete' => 'Delete',
            ];

	foreach ($tabs as $link=>$tab) {
		$html .= '<li><a href="' . Backend_URL ."trans/{$link}/{$id}\"";
		$html .= ($link == $active_tab ) ? ' class="active"' : '';
		$html .= '>'. $tab . '</a></li>';
	}
	$html .= '</ul>';
	return $html;
}

function hideVoidBtn( $timestamp, $id ){
    $now    = time() - (24 * 60 * 60); // 12 hrs Less
    $entry  = strtotime($timestamp);
    if($now >= $entry ){
        return '<span class="btn btn-xs btn-danger disabled">Locked</span>';
    } else {
        return anchor(
            site_url(Backend_URL . 'trans/void/' . $id ), 
            '<i class="fa fa-fw fa-times"></i> Void ', 
            'class="btn btn-xs btn-danger" onclick="return confirm(\'Confrim Void.\')"'
        );
    }
}