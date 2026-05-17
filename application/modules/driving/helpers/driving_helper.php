<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Driving module helper.
 *
 * Provides UI building blocks (badges, capacity cards, action buttons),
 * the daily-queue capacity constant and the tab bar used by the CRUD pages.
 */

if (!function_exists('driving_daily_limit')) {
    /**
     * Maximum number of *active* learners (Queued + Driving) per vehicle per day.
     * Override globally by defining the constant DRIVING_DAILY_LIMIT before this file loads.
     */
    function driving_daily_limit() {
        if (defined('DRIVING_DAILY_LIMIT')) {
            return (int) DRIVING_DAILY_LIMIT;
        }
        return 15;
    }
}

if (!function_exists('drivingTabs')) {
    /**
     * Tabs for the legacy CRUD pages.
     */
    function drivingTabs($id, $active_tab) {
        $html  = '<ul class="tabsmenu">';
        $tabs  = [
            'details' => 'Details',
            'update'  => 'Update',
            'delete'  => 'Delete',
        ];
        foreach ($tabs as $link => $label) {
            $html .= '<li><a href="' . Backend_URL . "driving/{$link}/{$id}\"";
            $html .= ($link === $active_tab) ? ' class="active"' : '';
            $html .= ">{$label}</a></li>";
        }
        $html .= '</ul>';
        return $html;
    }
}

if (!function_exists('driving_stage_badge')) {
    /**
     * Render a colourful badge for a single driving cell.
     *
     * @param string|null $stage         'Queued' | 'Driving' | 'Completed' | 'Cancelled' | null
     * @param string      $vehicle_label fallback text (e.g. vehicle name) shown when not currently driving
     */
    function driving_stage_badge($stage = null, $vehicle_label = '') {
        $label   = htmlspecialchars($vehicle_label !== '' ? $vehicle_label : ($stage ?: '-'));
        switch ($stage) {
            case 'Driving':
                return '<span class="dv-badge dv-badge-driving">ON DRIVING</span>';
            case 'Queued':
                return '<span class="dv-badge dv-badge-queued">' . $label . '</span>';
            case 'Completed':
                return '<span class="dv-badge dv-badge-completed">' . $label . '</span>';
            case 'Cancelled':
                return '<span class="dv-badge dv-badge-cancelled">' . $label . '</span>';
            default:
                return '<span class="dv-badge dv-badge-empty">&mdash;</span>';
        }
    }
}

if (!function_exists('driving_capacity_card')) {
    /**
     * Single capacity card (used at the top of the dashboard).
     */
    function driving_capacity_card($vehicle_name, $vehicle_number, $used, $limit) {
        $used  = (int) $used;
        $limit = (int) $limit;
        $pct   = $limit > 0 ? min(100, round($used * 100 / $limit)) : 0;

        $tone  = 'ok';
        if ($pct >= 100) {
            $tone = 'full';
        } elseif ($pct >= 80) {
            $tone = 'high';
        }

        $title = htmlspecialchars($vehicle_name);
        if ($vehicle_number !== '' && $vehicle_number !== null) {
            $title .= ' <small class="text-muted">(' . htmlspecialchars($vehicle_number) . ')</small>';
        }

        $html  = '<div class="dv-capacity dv-capacity-' . $tone . '">';
        $html .=   '<div class="dv-capacity-title">' . $title . '</div>';
        $html .=   '<div class="dv-capacity-value">' . $used . ' / ' . $limit . '</div>';
        $html .=   '<div class="dv-capacity-bar"><span style="width:' . $pct . '%"></span></div>';
        $html .= '</div>';
        return $html;
    }
}

if (!function_exists('driving_action_buttons')) {
    /**
     * Inline action buttons rendered inside a pivot cell.
     */
    function driving_action_buttons($cell) {
        if (!$cell) {
            return '';
        }
        $base = site_url(Backend_URL . 'driving/transition/' . (int) $cell->driving_id);
        $html = '<div class="dv-cell-actions">';

        switch ($cell->current_stage) {
            case 'Queued':
                $html .= '<a class="btn btn-xs btn-warning" href="' . $base . '?stage=Driving" title="Start driving"><i class="fa fa-play"></i></a> ';
                $html .= '<a class="btn btn-xs btn-success" href="' . $base . '?stage=Completed" title="Mark completed"><i class="fa fa-check"></i></a> ';
                break;
            case 'Driving':
                $html .= '<a class="btn btn-xs btn-success" href="' . $base . '?stage=Completed" title="Mark completed"><i class="fa fa-check"></i></a> ';
                $html .= '<a class="btn btn-xs btn-default" href="' . $base . '?stage=Queued" title="Back to queue"><i class="fa fa-rotate-left"></i></a> ';
                break;
            case 'Completed':
                $html .= '<a class="btn btn-xs btn-warning" href="' . $base . '?stage=Driving" title="Re-open"><i class="fa fa-undo"></i></a> ';
                break;
            case 'Cancelled':
                $html .= '<a class="btn btn-xs btn-warning" href="' . $base . '?stage=Queued" title="Re-queue"><i class="fa fa-undo"></i></a> ';
                break;
        }

        $reset_url = site_url(Backend_URL . 'driving/reset_action/' . (int) $cell->driving_id);
        $html .= '<a class="btn btn-xs btn-danger" href="' . $reset_url . '" '
              .  'onclick="return confirm(\'Remove this driving entry?\')" title="Reset cell">'
              .  '<i class="fa fa-times"></i></a>';

        $html .= '</div>';
        return $html;
    }
}

if (!function_exists('driving_stage_label')) {
    /**
     * Stage label HTML (used in history lists and timelines).
     */
    function driving_stage_label($stage) {
        $stage = $stage ?: 'Queued';
        $cls   = 'dv-badge ';
        switch ($stage) {
            case 'Driving':   $cls .= 'dv-badge-driving';   break;
            case 'Queued':    $cls .= 'dv-badge-queued';    break;
            case 'Completed': $cls .= 'dv-badge-completed'; break;
            case 'Cancelled': $cls .= 'dv-badge-cancelled'; break;
            default:          $cls .= 'dv-badge-empty';
        }
        return '<span class="' . $cls . '">' . htmlspecialchars($stage) . '</span>';
    }
}

if (!function_exists('driving_format_dt')) {
    function driving_format_dt($datetime) {
        if (empty($datetime) || $datetime === '0000-00-00 00:00:00') {
            return '-';
        }
        return date('d-M-y h:i A', strtotime($datetime));
    }
}
