<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Driving_log_model
 *
 * Persists the stage transitions of a `drivings` record.
 * Allowed stages: Queued | Driving | Completed | Cancelled
 *
 * @author Khairul Azam
 */
class Driving_log_model extends Fm_model {

    public $table = 'driving_logs';
    public $id    = 'id';
    public $order = 'ASC';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Append a new stage entry for a driving record.
     */
    public function add_log($driving_id, $stage, $datetime = null) {
        $datetime = $datetime ?: date('Y-m-d H:i:s');
        $this->db->insert($this->table, [
            'driving_id' => (int) $driving_id,
            'stage'      => $stage,
            'datetime'   => $datetime,
        ]);
        return (int) $this->db->insert_id();
    }

    /**
     * Latest log row (by datetime then id) for a driving record.
     */
    public function latest_for($driving_id) {
        $this->db->where('driving_id', (int) $driving_id);
        $this->db->order_by('datetime', 'DESC');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get($this->table)->row();
    }

    /**
     * Full timeline for a driving record (oldest first).
     */
    public function timeline($driving_id) {
        $this->db->where('driving_id', (int) $driving_id);
        $this->db->order_by('datetime', 'ASC');
        $this->db->order_by('id', 'ASC');
        return $this->db->get($this->table)->result();
    }

    /**
     * Hard-delete every log of a driving record (used by reset).
     */
    public function clear_for($driving_id) {
        $this->db->where('driving_id', (int) $driving_id);
        $this->db->delete($this->table);
    }
}
