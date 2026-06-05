<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Driving module helper.
 *
 * Provides UI building blocks (badges, capacity cards, action buttons),
 * the daily-queue capacity constant and the tab bar used by the CRUD pages.
 */

if (!function_exists('driving_drive_types')) {
    /** F=Forward, R=Reverse, Z=Zikjak */
    function driving_drive_types() {
        return [
            'F' => 'Forward',
            'R' => 'Reverse',
            'Z' => 'ZikZak',
        ];
    }
}

if (!function_exists('driving_drive_modes')) {
    /** D=Day, AN=Afternoon, N=Night */
    function driving_drive_modes() {
        return [
            'D'  => 'Day',
            'AN' => 'Afternoon',
            'N'  => 'Night',
        ];
    }
}

if (!function_exists('driving_road_types')) {
    /** TF=Training Field, DT=Driving Track, HW=Highway */
    function driving_road_types() {
        return [
            'TF' => 'Training Field',
            'DT' => 'Driving Track',
            'HW' => 'Highway',
        ];
    }
}

if (!function_exists('driving_valid_drive_type')) {
    function driving_valid_drive_type($drive_type) {
        return driving_valid_enum_option($drive_type, 'driving_drive_types');
    }
}

if (!function_exists('driving_valid_drive_mode')) {
    function driving_valid_drive_mode($drive_mode) {
        return driving_valid_enum_option($drive_mode, 'driving_drive_modes');
    }
}

if (!function_exists('driving_valid_road_type')) {
    function driving_valid_road_type($road_type) {
        return driving_valid_enum_option($road_type, 'driving_road_types');
    }
}

if (!function_exists('driving_valid_enum_option')) {
    function driving_valid_enum_option($value, $options_fn) {
        $value = trim((string) $value);
        if ($value === '' || !function_exists($options_fn)) {
            return null;
        }
        $allowed = array_keys($options_fn());
        return in_array($value, $allowed, true) ? $value : null;
    }
}

if (!function_exists('driving_round_qty_options')) {
    /**
     * Allowed round quantities for queue assignment.
     *
     * @return array<int, string>
     */
    function driving_round_qty_options() {
        return [
            1 => '1',
            2 => '2',
            3 => '3',
        ];
    }
}

if (!function_exists('driving_valid_round_qty')) {
    /**
     * @param mixed $round_qty
     * @return int|null
     */
    function driving_valid_round_qty($round_qty) {
        $round_qty = (int) $round_qty;
        $allowed   = array_keys(driving_round_qty_options());
        return in_array($round_qty, $allowed, true) ? $round_qty : null;
    }
}

if (!function_exists('driving_daily_limit')) {
    /**
     * Maximum active learners (Queued + Driving) per vehicle per day.
     * Return 0 for no limit. Override with constant DRIVING_DAILY_LIMIT if needed.
     */
    function driving_daily_limit() {
        if (defined('DRIVING_DAILY_LIMIT')) {
            return (int) DRIVING_DAILY_LIMIT;
        }
        return 0;
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
     * @param string      $vehicle_label unused; column headers show the vehicle name
     */
    function driving_stage_badge($stage = null, $vehicle_label = '') {
        switch ($stage) {
            case 'Driving':
                return '<span class="dv-badge dv-badge-driving">ON DRIVING</span>';
            case 'Queued':
                return '<span class="dv-badge dv-badge-queued">QUEUED</span>';
            case 'Completed':
                return '<span class="dv-badge dv-badge-completed">COMPLETED</span>';
            case 'Cancelled':
                return '<span class="dv-badge dv-badge-cancelled">CANCELLED</span>';
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

        if ($limit <= 0) {
            $html  = '<div class="dv-capacity dv-capacity-ok">';
            $html .=   '<div class="dv-capacity-row">';
            $html .=     '<div class="dv-capacity-title">' . $title . '</div>';
            $html .=     '<div class="dv-capacity-value">' . $used . ' active</div>';
            $html .=   '</div>';
            $html .= '</div>';
            return $html;
        }

        $html  = '<div class="dv-capacity dv-capacity-' . $tone . '">';
        $html .=   '<div class="dv-capacity-row">';
        $html .=     '<div class="dv-capacity-title">' . $title . '</div>';
        $html .=     '<div class="dv-capacity-value">' . $used . ' / ' . $limit . '</div>';
        $html .=   '</div>';
        $html .=   '<div class="dv-capacity-bar"><span style="width:' . $pct . '%"></span></div>';
        $html .= '</div>';
        return $html;
    }
}

if (!function_exists('driving_allowed_stage_transition')) {
    function driving_allowed_stage_transition($from, $to) {
        $from = $from ?: 'Queued';
        $map  = [
            'Queued'    => ['Completed', 'Driving'],
            'Driving'   => ['Completed'],
            'Completed' => ['Queued'],
            'Cancelled' => ['Queued'],
        ];
        return in_array($to, $map[$from] ?? [], true);
    }
}

if (!function_exists('driving_ajax_stage_button')) {
    function driving_ajax_stage_button($driving_id, $stage, $btn_class, $icon, $label) {
        return '<button type="button" class="btn btn-xs ' . $btn_class . ' dv-stage-btn"'
            . ' data-driving-id="' . (int) $driving_id . '"'
            . ' data-stage="' . htmlspecialchars($stage) . '"'
            . ' title="' . htmlspecialchars($label) . '">'
            . '<i class="fa ' . $icon . '"></i></button> ';
    }
}

if (!function_exists('driving_assign_cell_html')) {
    function driving_assign_cell_html($learner_id, $vehicle_id) {
        return '<a class="btn btn-xs btn-default" href="#" data-toggle="modal" data-target="#dvAssignModal"'
            . ' data-prefill-learner="' . (int) $learner_id . '"'
            . ' data-prefill-vehicle="' . (int) $vehicle_id . '">'
            . '<i class="fa fa-plus"></i> Assign</a>';
    }
}

if (!function_exists('driving_action_buttons')) {
    /**
     * Inline AJAX buttons: Queue → Drived (Completed).
     */
    function driving_action_buttons($cell) {
        if (!$cell) {
            return '';
        }
        $html  = '<div class="dv-cell-actions" data-driving-id="' . (int) $cell->driving_id . '">';
        $stage = $cell->current_stage ?: 'Queued';

        if (in_array($stage, ['Queued', 'Driving'], true)) {
            if ($stage === 'Queued') {
                $html .= driving_ajax_stage_button(
                    $cell->driving_id, 'Driving', 'btn-warning', 'fa-play', 'Queue'
                );
            }
            $html .= driving_ajax_stage_button(
                $cell->driving_id, 'Completed', 'btn-success', 'fa-check', 'Drived'
            );
        } elseif ($stage === 'Completed') {
            $html .= driving_ajax_stage_button(
                $cell->driving_id, 'Queued', 'btn-default', 'fa-rotate-left', 'Queue again'
            );
        } elseif ($stage === 'Cancelled') {
            $html .= driving_ajax_stage_button(
                $cell->driving_id, 'Queued', 'btn-warning', 'fa-undo', 'Queue'
            );
        }

        $html .= '<button type="button" class="btn btn-xs btn-danger dv-reset-btn"'
            . ' data-driving-id="' . (int) $cell->driving_id . '" title="Remove">'
            . '<i class="fa fa-times"></i></button>';

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

if (!function_exists('driving_drive_type_label')) {
    function driving_drive_type_label($drive_type) {
        return driving_enum_label($drive_type, 'driving_drive_types');
    }
}

if (!function_exists('driving_drive_mode_label')) {
    function driving_drive_mode_label($drive_mode) {
        return driving_enum_label($drive_mode, 'driving_drive_modes');
    }
}

if (!function_exists('driving_road_type_label')) {
    function driving_road_type_label($road_type) {
        return driving_enum_label($road_type, 'driving_road_types');
    }
}

if (!function_exists('driving_enum_label')) {
    function driving_enum_label($value, $options_fn) {
        $value = trim((string) $value);
        if ($value === '' || !function_exists($options_fn)) {
            return '-';
        }
        $map = $options_fn();
        return $map[$value] ?? $value;
    }
}

if (!function_exists('driving_log_session_times')) {
    /**
     * Start = first Driving log; fallback first log. End = first Completed log.
     */
    function driving_log_session_times($logs) {
        $start = null;
        $end   = null;
        foreach ($logs as $log) {
            if ($log->stage === 'Driving' && $start === null) {
                $start = $log->datetime;
            }
            if ($log->stage === 'Completed' && $end === null) {
                $end = $log->datetime;
            }
        }
        if ($start === null && !empty($logs)) {
            $start = $logs[0]->datetime;
        }
        return ['start' => $start, 'end' => $end];
    }
}

if (!function_exists('driving_learner_log_groups_html')) {
    /**
     * Table report for learner day logs (dashboard modal).
     */
    function driving_learner_log_groups_html($groups) {
        if (empty($groups)) {
            return '<p class="text-muted">No driving logs for this day.</p>';
        }

        usort($groups, function ($a, $b) {
            $dateA = $a['tx_date'] ?? '';
            $dateB = $b['tx_date'] ?? '';
            if ($dateA !== $dateB) {
                return strcmp($dateA, $dateB);
            }
            return strcmp($a['start_time'] ?? '', $b['start_time'] ?? '');
        });

        $html  = '<div class="table-responsive">';
        $html .= '<table class="table table-bordered table-condensed dv-log-table">';
        $html .= '<thead><tr>';
        $html .= '<th>Date</th><th>Vehicle</th><th>Instructor</th><th>Drive Type</th><th>Mode</th><th>Road</th><th>Round</th>';
        $html .= '<th>Start</th><th>End</th>';
        $html .= '</tr></thead><tbody>';

        foreach ($groups as $g) {
            $html .= '<tr>';
            $html .= '<td>' . driving_format_date($g['tx_date'] ?? null) . '</td>';
            $html .= '<td>' . htmlspecialchars($g['vehicle_label'] ?? 'Vehicle') . '</td>';
            $html .= '<td>' . htmlspecialchars($g['instructor_name'] ?? '-') . '</td>';
            $html .= '<td>' . htmlspecialchars(driving_drive_type_label($g['drive_type'] ?? '')) . '</td>';
            $html .= '<td>' . htmlspecialchars(driving_drive_mode_label($g['drive_mode'] ?? '')) . '</td>';
            $html .= '<td>' . htmlspecialchars(driving_road_type_label($g['road_type'] ?? '')) . '</td>';
            $round_qty = $g['round_qty'] ?? null;
            $html .= '<td class="text-center">' . ($round_qty !== null && $round_qty !== '' ? (int) $round_qty : '-') . '</td>';
            $html .= '<td>' . driving_format_time($g['start_time'] ?? null) . '</td>';
            $html .= '<td>' . driving_format_time($g['end_time'] ?? null) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table></div>';
        return $html;
    }
}

if (!function_exists('driving_format_date')) {
    function driving_format_date($date) {
        if (empty($date) || $date === '0000-00-00') {
            return '-';
        }
        return date('d-M-Y', strtotime($date));
    }
}

if (!function_exists('driving_format_time')) {
    function driving_format_time($datetime) {
        if (empty($datetime) || $datetime === '0000-00-00 00:00:00') {
            return '-';
        }
        return date('h:i A', strtotime($datetime));
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
