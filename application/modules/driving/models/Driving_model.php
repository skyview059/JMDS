<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Driving_model
 *
 * Operational + reporting queries for the driving queue.
 * Works in tandem with Driving_log_model which stores stage transitions.
 *
 * @author Khairul Azam
 */
class Driving_model extends Fm_model {

    public $table = 'drivings';
    public $id    = 'id';
    public $order = 'DESC';

    public function __construct() {
        parent::__construct();
    }

    // ---------------------------------------------------------------
    // Generic listings (kept for the legacy CRUD pages)
    // ---------------------------------------------------------------
    public function total_rows($q = null) {
        if ($q) {
            $this->db->like('id', $q);
            $this->db->or_like('learning_id', $q);
            $this->db->or_like('vehicle_id', $q);
            $this->db->or_like('tx_date', $q);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_limit_data($limit, $start = 0, $q = null) {
        $this->db->order_by($this->id, $this->order);
        if ($q) {
            $this->db->like('id', $q);
            $this->db->or_like('learning_id', $q);
            $this->db->or_like('vehicle_id', $q);
            $this->db->or_like('tx_date', $q);
        }
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // ---------------------------------------------------------------
    // Dashboard queries
    // ---------------------------------------------------------------

    /**
     * Vehicles used for the dashboard columns (no status column exists,
     * so we list every vehicle, oldest first).
     */
    public function get_vehicles() {
        $this->db->order_by('id', 'ASC');
        return $this->db->get('vehicles')->result();
    }

    /**
     * Drop-down friendly version of get_vehicles().
     */
    public function get_vehicle_options($placeholder = '-- Select Vehicle --') {
        $rows = $this->get_vehicles();
        $list = ['' => $placeholder];
        foreach ($rows as $row) {
            $label = $row->name;
            if (!empty($row->number)) {
                $label .= ' (' . $row->number . ')';
            }
            $list[$row->id] = $label;
        }
        return $list;
    }

    /**
     * Batch drop-down used by dashboard filter.
     */
    public function get_batch_options($placeholder = '-- All Batches --') {
        $this->db->select('id, name, status');
        $this->db->order_by('id', 'DESC');
        $rows = $this->db->get('batches')->result();

        $list = ['' => $placeholder];
        foreach ($rows as $row) {
            $list[$row->id] = $row->name . ' (' . $row->status . ')';
        }
        return $list;
    }

    /**
     * Single driving row by id.
     */
    public function get_by_id($id) {
        $this->db->where($this->id, (int) $id);
        return $this->db->get($this->table)->row();
    }

    /**
     * Driving row joined with learner + vehicle (for details + history).
     */
    public function get_full_by_id($id) {
        $this->db->select('d.*, l.name AS learner_name, l.primary_mobile,
                           l.batch_id, b.name AS batch_name,
                           v.name AS vehicle_name, v.number AS vehicle_number');
        $this->db->from($this->table . ' d');
        $this->db->join('learners l', 'l.id = d.learning_id', 'left');
        $this->db->join('batches  b', 'b.id = l.batch_id',   'left');
        $this->db->join('vehicles v', 'v.id = d.vehicle_id',  'left');
        $this->db->where('d.id', (int) $id);
        return $this->db->get()->row();
    }

    /**
     * Find an existing driving row for (learner, vehicle, date).
     */
    public function find_one($learning_id, $vehicle_id, $tx_date) {
        $this->db->where('learning_id', (int) $learning_id);
        $this->db->where('vehicle_id',  (int) $vehicle_id);
        $this->db->where('tx_date',     $tx_date);
        return $this->db->get($this->table)->row();
    }

    /**
     * Daily dashboard pivot.
     *
     * Returns an associative structure:
     *   [
     *     'learners'   => [ learner_id => learner_row ],
     *     'pivot'      => [ learner_id => [ vehicle_id => driving_row+stage ] ],
     *     'counts'     => [ vehicle_id => ['Queued' => n, 'Driving' => n, 'Completed' => n, 'total' => n, 'active' => n] ],
     *     'tx_date'    => 'YYYY-MM-DD',
     *   ]
     */
    public function get_daily_pivot($tx_date, $batch_id = null) {
        $learners = [];
        $this->db->select('l.id, l.name, l.batch_id, b.name AS batch_name, l.primary_mobile');
        $this->db->from('learners l');
        $this->db->join('batches b', 'b.id = l.batch_id', 'left');
        if ($batch_id) {
            $this->db->where('l.batch_id', (int) $batch_id);
        }
        $this->db->order_by('l.id', 'ASC');
        foreach ($this->db->get()->result() as $l) {
            $learners[$l->id] = (object) [
                'id'             => $l->id,
                'name'           => $l->name,
                'batch_id'       => $l->batch_id,
                'batch_name'     => $l->batch_name,
                'primary_mobile' => $l->primary_mobile,
            ];
        }

        $this->db->select("
            d.id           AS driving_id,
            d.learning_id  AS learner_id,
            d.vehicle_id   AS vehicle_id,
            d.tx_date      AS tx_date,
            d.drive_type   AS drive_type,
            d.round_qty    AS round_qty,
            l.name         AS learner_name,
            l.batch_id     AS batch_id,
            l.primary_mobile AS learner_mobile,
            b.name         AS batch_name,
            (
              SELECT dl.stage FROM driving_logs dl
              WHERE dl.driving_id = d.id
              ORDER BY dl.datetime DESC, dl.id DESC
              LIMIT 1
            ) AS current_stage,
            (
              SELECT dl.datetime FROM driving_logs dl
              WHERE dl.driving_id = d.id
              ORDER BY dl.datetime DESC, dl.id DESC
              LIMIT 1
            ) AS last_log_time
        ", false);
        $this->db->from($this->table . ' d');
        $this->db->join('learners l', 'l.id = d.learning_id', 'left');
        $this->db->join('batches  b', 'b.id = l.batch_id',     'left');
        $this->db->where('d.tx_date', $tx_date);
        if ($batch_id) {
            $this->db->where('l.batch_id', (int) $batch_id);
        }
        $this->db->order_by('d.learning_id', 'ASC');
        $this->db->order_by('d.id',          'ASC');
        $rows = $this->db->get()->result();

        $pivot  = [];
        $counts = [];

        foreach ($rows as $r) {
            $stage = $r->current_stage ?: 'Queued';

            $pivot[$r->learner_id][$r->vehicle_id] = (object) [
                'driving_id'    => $r->driving_id,
                'vehicle_id'    => $r->vehicle_id,
                'tx_date'       => $r->tx_date,
                'drive_type'    => $r->drive_type ?? null,
                'round_qty'     => $r->round_qty ?? null,
                'current_stage' => $stage,
                'last_log_time' => $r->last_log_time,
            ];

            if (!isset($counts[$r->vehicle_id])) {
                $counts[$r->vehicle_id] = [
                    'Queued'    => 0,
                    'Driving'   => 0,
                    'Completed' => 0,
                    'Cancelled' => 0,
                    'total'     => 0,
                    'active'    => 0,
                ];
            }
            $counts[$r->vehicle_id]['total']++;
            if (isset($counts[$r->vehicle_id][$stage])) {
                $counts[$r->vehicle_id][$stage]++;
            }
            if (in_array($stage, ['Queued', 'Driving'], true)) {
                $counts[$r->vehicle_id]['active']++;
            }
        }

        return [
            'learners' => $learners,
            'pivot'    => $pivot,
            'counts'   => $counts,
            'tx_date'  => $tx_date,
        ];
    }

    /**
     * Count of distinct learners that drove on the given date.
     */
    public function count_students_on($tx_date, $batch_id = null) {
        $this->db->select('COUNT(DISTINCT d.learning_id) AS total', false);
        $this->db->from($this->table . ' d');
        if ($batch_id) {
            $this->db->join('learners l', 'l.id = d.learning_id', 'inner');
            $this->db->where('l.batch_id', (int) $batch_id);
        }
        $this->db->where('d.tx_date', $tx_date);
        $row = $this->db->get()->row();
        return (int) ($row->total ?? 0);
    }

    // ---------------------------------------------------------------
    // History / reporting queries
    // ---------------------------------------------------------------

    /**
     * History rows + total count for the filters.
     *
     * Filters: from_date, to_date, learner_id, vehicle_id, batch_id, stage, q
     */
    public function history($filters = [], $limit = 25, $start = 0) {
        $select = "
            d.id           AS driving_id,
            d.learning_id  AS learner_id,
            d.vehicle_id   AS vehicle_id,
            d.tx_date      AS tx_date,
            l.name         AS learner_name,
            l.primary_mobile,
            l.batch_id,
            b.name         AS batch_name,
            v.name         AS vehicle_name,
            v.number       AS vehicle_number,
            (
              SELECT dl.stage FROM driving_logs dl
              WHERE dl.driving_id = d.id
              ORDER BY dl.datetime DESC, dl.id DESC
              LIMIT 1
            ) AS current_stage,
            (
              SELECT MIN(dl.datetime) FROM driving_logs dl
              WHERE dl.driving_id = d.id
            ) AS first_log_time,
            (
              SELECT MAX(dl.datetime) FROM driving_logs dl
              WHERE dl.driving_id = d.id
            ) AS last_log_time
        ";

        $build = function () use ($filters) {
            $this->db->from($this->table . ' d');
            $this->db->join('learners l', 'l.id = d.learning_id', 'left');
            $this->db->join('batches  b', 'b.id = l.batch_id',     'left');
            $this->db->join('vehicles v', 'v.id = d.vehicle_id',   'left');

            if (!empty($filters['from_date'])) {
                $this->db->where('d.tx_date >=', $filters['from_date']);
            }
            if (!empty($filters['to_date'])) {
                $this->db->where('d.tx_date <=', $filters['to_date']);
            }
            if (!empty($filters['learner_id'])) {
                $this->db->where('d.learning_id', (int) $filters['learner_id']);
            }
            if (!empty($filters['vehicle_id'])) {
                $this->db->where('d.vehicle_id', (int) $filters['vehicle_id']);
            }
            if (!empty($filters['batch_id'])) {
                $this->db->where('l.batch_id', (int) $filters['batch_id']);
            }
            if (!empty($filters['stage'])) {
                $stage = $filters['stage'];
                $this->db->where(
                    "(SELECT dl.stage FROM driving_logs dl
                       WHERE dl.driving_id = d.id
                       ORDER BY dl.datetime DESC, dl.id DESC LIMIT 1) = ", $stage
                );
            }
            if (!empty($filters['q'])) {
                $q = $filters['q'];
                $this->db->group_start();
                $this->db->like('l.name', $q);
                $this->db->or_like('l.primary_mobile', $q);
                $this->db->or_like('v.name', $q);
                $this->db->or_like('v.number', $q);
                $this->db->or_like('d.tx_date', $q);
                $this->db->group_end();
            }
        };

        // Total
        $this->db->select('COUNT(*) AS total', false);
        $build();
        $total = (int) ($this->db->get()->row()->total ?? 0);

        // Page
        $this->db->select($select, false);
        $build();
        $this->db->order_by('d.tx_date', 'DESC');
        $this->db->order_by('d.id',      'DESC');
        $this->db->limit($limit, $start);
        $rows = $this->db->get()->result();

        return ['rows' => $rows, 'total' => $total];
    }

    /**
     * All driving records for a single learner (newest first), with stage info.
     */
    public function history_for_learner($learning_id) {
        $this->db->select("
            d.id           AS driving_id,
            d.tx_date,
            d.vehicle_id,
            v.name         AS vehicle_name,
            v.number       AS vehicle_number,
            (
              SELECT dl.stage FROM driving_logs dl
              WHERE dl.driving_id = d.id
              ORDER BY dl.datetime DESC, dl.id DESC
              LIMIT 1
            ) AS current_stage,
            (
              SELECT MIN(dl.datetime) FROM driving_logs dl
              WHERE dl.driving_id = d.id
            ) AS first_log_time,
            (
              SELECT MAX(dl.datetime) FROM driving_logs dl
              WHERE dl.driving_id = d.id
            ) AS last_log_time
        ", false);
        $this->db->from($this->table . ' d');
        $this->db->join('vehicles v', 'v.id = d.vehicle_id', 'left');
        $this->db->where('d.learning_id', (int) $learning_id);
        $this->db->order_by('d.tx_date', 'DESC');
        $this->db->order_by('d.id',      'DESC');
        return $this->db->get()->result();
    }

    // ---------------------------------------------------------------
    // Learner helpers (for "assign" modal)
    // ---------------------------------------------------------------

    /**
     * Learner options (filterable by batch / search). Suitable for <select>.
     */
    public function get_learner_options($batch_id = null, $q = null, $limit = 500) {
        $this->db->select('l.id, l.name, l.batch_id, b.name AS batch_name');
        $this->db->from('learners l');
        $this->db->join('batches b', 'b.id = l.batch_id', 'left');
        if ($batch_id) {
            $this->db->where('l.batch_id', (int) $batch_id);
        }
        if ($q) {
            $this->db->group_start();
            $this->db->like('l.name', $q);
            $this->db->or_like('l.id', $q);
            $this->db->group_end();
        }
        $this->db->order_by('l.id', 'ASC');
        $this->db->limit($limit);
        $rows = $this->db->get()->result();

        $list = ['' => '-- Select Learner --'];
        foreach ($rows as $r) {
            $label  = "{$r->id} - {$r->name}";            
            $list[$r->id] = $label;
        }
        return $list;
    }

    /**
     * Total registered learner count (used by "Total Students" card).
     */
    public function total_learners($batch_id = null) {
        if ($batch_id) {
            $this->db->where('batch_id', (int) $batch_id);
        }
        $this->db->from('learners');
        return (int) $this->db->count_all_results();
    }
}
