<?php defined('BASEPATH') OR exit('No direct script access allowed');

function learnerTabs($id, $active_tab) {
	$html = '<ul class="tabsmenu">';
	$tabs = [
        'details'=> 'Details',
        'update' => 'Update',
        'delete' => 'Delete',
    ];

	foreach ($tabs as $link=>$tab) {
		$html .= '<li><a href="' . Backend_URL ."learner/{$link}/{$id}\"";
		$html .= ($link == $active_tab ) ? ' class="active"' : '';
		$html .= ">{$tab}</a></li>";
	}
	$html .= '</ul>';
	return $html;
}