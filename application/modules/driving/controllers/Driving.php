<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Driving controller
 *
 * Dashboard, queue-assignment, stage transitions and history reporting
 * for the daily driving programme.
 *
 * @author Khairul Azam
 */
class Driving extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Driving_model');
        $this->load->model('Driving_log_model');
        $this->load->helper('driving');
        $this->load->library('form_validation');
    }

    // =============================================================
    // Dashboard (default landing page)
    // =============================================================
    public function index() {
        $this->dashboard();
    }

    /**
     * Operational dashboard: per-day pivot of learners x vehicles.
     */
    public function dashboard() {
        $tx_date  = $this->input->get('tx_date', TRUE) ?: date('Y-m-d');
        $batch_id = $this->input->get('batch_id', TRUE);

        $vehicles = $this->Driving_model->get_vehicles();
        $pivot    = $this->Driving_model->get_daily_pivot($tx_date, $batch_id);

        $data = [
            'tx_date'         => $tx_date,
            'batch_id'        => $batch_id,
            'vehicles'        => $vehicles,
            'pivot'           => $pivot,
            'learner_logs'    => $this->_learner_day_log_groups($pivot, $vehicles),
            'batch_list'      => $this->Driving_model->get_batch_options(),
            'vehicle_list'    => $this->Driving_model->get_vehicle_options(),
            'learner_list'    => $this->Driving_model->get_learner_options($batch_id),
            'total_learners'  => $this->Driving_model->total_learners($batch_id),
            'students_today'  => $this->Driving_model->count_students_on($tx_date, $batch_id),
            'daily_limit'     => driving_daily_limit(),
        ];
        // $this->viewAdminContent('driving/driving/dashboard', $data);
        $this->viewMobileContent('driving/driving/mobile/dashboard', $data);
    }

    // =============================================================
    // Assign a learner to a vehicle's queue (POST)
    // =============================================================
    public function assign_action() {
        $tx_date     = $this->input->post('tx_date', TRUE)     ?: date('Y-m-d');
        $batch_id    = $this->input->post('batch_id', TRUE);
        $learning_id = (int) $this->input->post('learning_id', TRUE);
        $vehicle_id  = (int) $this->input->post('vehicle_id',  TRUE);
        $drive_type  = driving_valid_drive_type($this->input->post('drive_type', TRUE));
        $round_qty   = driving_valid_round_qty($this->input->post('round_qty', TRUE));

        $redirect = site_url(Backend_URL . 'driving') . '?' . http_build_query(array_filter([
            'tx_date'  => $tx_date,
            'batch_id' => $batch_id,
        ]));

        if ($learning_id <= 0 || $vehicle_id <= 0 || empty($tx_date)) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Please choose a learner and a vehicle.</p>');
            redirect($redirect);
        }
        if ($drive_type === null) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Please select a drive type.</p>');
            redirect($redirect);
        }
        if ($round_qty === null) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Please select round quantity.</p>');
            redirect($redirect);
        }

        $limit = driving_daily_limit();
        $pivot = $this->Driving_model->get_daily_pivot($tx_date, null);
        $used  = $pivot['counts'][$vehicle_id]['active'] ?? 0;
        if ($used >= $limit) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Queue for this vehicle is full ('
                . $used . '/' . $limit . ') for ' . $tx_date . '.</p>');
            redirect($redirect);
        }

        $existing = $this->Driving_model->find_one($learning_id, $vehicle_id, $tx_date);
        if ($existing) {
            $latest = $this->Driving_log_model->latest_for($existing->id);
            $stage  = $latest ? $latest->stage : null;
            if (in_array($stage, ['Queued', 'Driving'], true)) {
                $this->session->set_flashdata('message',
                    '<p class="ajax_error">This learner is already in queue / driving on the selected vehicle.</p>');
                redirect($redirect);
            }
            $driving_id = $existing->id;
            $this->Driving_model->update($driving_id, [
                'drive_type' => $drive_type,
                'round_qty'  => $round_qty,
            ]);
        } else {
            $this->Driving_model->insert([
                'learning_id' => $learning_id,
                'vehicle_id'  => $vehicle_id,
                'tx_date'     => $tx_date,
                'drive_type'  => $drive_type,
                'round_qty'   => $round_qty,
            ]);
            $driving_id = (int) $this->db->insert_id();
        }

        $this->Driving_log_model->add_log($driving_id, 'Queued');
        $this->session->set_flashdata('message',
            '<p class="ajax_success">Learner added to queue successfully.</p>');
        redirect($redirect);
    }

    // =============================================================
    // Move a driving record to a new stage
    // =============================================================
    public function transition_action($driving_id = 0) {
        $driving_id = (int) $driving_id;
        $stage      = $this->input->get_post('stage', TRUE) ?: '';
        $allowed    = ['Queued', 'Driving', 'Completed', 'Cancelled'];

        $driving = $this->Driving_model->get_by_id($driving_id);
        $back    = site_url(Backend_URL . 'driving') . '?' . http_build_query(array_filter([
            'tx_date' => $driving ? $driving->tx_date : null,
        ]));

        if (!$driving) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Driving record not found.</p>');
            redirect(site_url(Backend_URL . 'driving'));
        }
        if (!in_array($stage, $allowed, true)) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Invalid stage.</p>');
            redirect($back);
        }

        $this->Driving_log_model->add_log($driving_id, $stage);
        $this->session->set_flashdata('message',
            '<p class="ajax_success">Stage updated to <b>' . $stage . '</b>.</p>');
        redirect($back);
    }

    // =============================================================
    // Reset (delete) one driving record + its logs
    // =============================================================
    public function reset_action($driving_id = 0) {
        $driving_id = (int) $driving_id;
        $driving    = $this->Driving_model->get_by_id($driving_id);
        $back       = site_url(Backend_URL . 'driving') . '?' . http_build_query(array_filter([
            'tx_date' => $driving ? $driving->tx_date : null,
        ]));

        if (!$driving) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Driving record not found.</p>');
            redirect(site_url(Backend_URL . 'driving'));
        }

        $this->Driving_log_model->clear_for($driving_id);
        $this->Driving_model->delete($driving_id);

        $this->session->set_flashdata('message',
            '<p class="ajax_success">Driving entry reset successfully.</p>');
        redirect($back);
    }

    /**
     * Reset every driving record of one learner for one date.
     * (Used by the per-row "Reset" button.)
     */
    public function reset_row() {
        $learning_id = (int) $this->input->get_post('learning_id', TRUE);
        $tx_date     = $this->input->get_post('tx_date', TRUE) ?: date('Y-m-d');
        $back        = site_url(Backend_URL . 'driving') . '?' . http_build_query(['tx_date' => $tx_date]);

        if ($learning_id <= 0) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Invalid learner.</p>');
            redirect($back);
        }

        $this->db->select('id');
        $this->db->where('learning_id', $learning_id);
        $this->db->where('tx_date',     $tx_date);
        $rows = $this->db->get('drivings')->result();
        foreach ($rows as $r) {
            $this->Driving_log_model->clear_for($r->id);
            $this->Driving_model->delete($r->id);
        }
        $this->session->set_flashdata('message',
            '<p class="ajax_success">All driving entries for the learner on ' . $tx_date . ' have been reset.</p>');
        redirect($back);
    }

    // =============================================================
    // History / reporting
    // =============================================================
    public function history() {
        $filters = [
            'from_date'  => $this->input->get('from_date',  TRUE),
            'to_date'    => $this->input->get('to_date',    TRUE),
            'learner_id' => $this->input->get('learner_id', TRUE),
            'vehicle_id' => $this->input->get('vehicle_id', TRUE),
            'batch_id'   => $this->input->get('batch_id',   TRUE),
            'stage'      => $this->input->get('stage',      TRUE),
            'q'          => $this->input->get('q',          TRUE),
        ];
        $start = (int) $this->input->get('start');

        $config['base_url']           = build_pagination_url(Backend_URL . 'driving/history', 'start');
        $config['first_url']          = build_pagination_url(Backend_URL . 'driving/history', 'start');
        $config['per_page']           = 25;
        $config['page_query_string']  = TRUE;

        $result = $this->Driving_model->history($filters, $config['per_page'], $start);
        $config['total_rows'] = $result['total'];

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = [
            'rows'         => $result['rows'],
            'total_rows'   => $result['total'],
            'start'        => $start,
            'pagination'   => $this->pagination->create_links(),
            'filters'      => $filters,
            'batch_list'   => $this->Driving_model->get_batch_options(),
            'vehicle_list' => $this->Driving_model->get_vehicle_options('-- All Vehicles --'),
            'stage_list'   => [
                ''          => '-- All Stages --',
                'Queued'    => 'Queued',
                'Driving'   => 'Driving',
                'Completed' => 'Completed',
                'Cancelled' => 'Cancelled',
            ],
        ];
        // $this->viewAdminContent('driving/driving/history', $data);
        $this->viewMobileContent('driving/driving/mobile/history', $data);
    }

    /**
     * Per-learner driving timeline.
     */
    public function learner_history($learning_id = 0) {
        $learning_id = (int) $learning_id;
        $this->db->where('id', $learning_id);
        $learner = $this->db->get('learners')->row();

        if (!$learner) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Learner not found.</p>');
            redirect(site_url(Backend_URL . 'driving'));
        }

        $drivings = $this->Driving_model->history_for_learner($learning_id);

        // Pull full timeline for each driving (so the view can render mini steppers)
        $timelines = [];
        foreach ($drivings as $d) {
            $timelines[$d->driving_id] = $this->Driving_log_model->timeline($d->driving_id);
        }

        $this->viewAdminContent('driving/driving/learner_history', [
            'learner'   => $learner,
            'drivings'  => $drivings,
            'timelines' => $timelines,
        ]);
    }

    // =============================================================
    // Driving timeline (single driving record)
    // =============================================================
    public function details($id) {
        $row = $this->Driving_model->get_full_by_id((int) $id);
        if (!$row) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Driving Not Found</p>');
            redirect(site_url(Backend_URL . 'driving'));
        }
        $logs = $this->Driving_log_model->timeline($row->id);
        $this->viewAdminContent('driving/driving/details', [
            'id'              => $row->id,
            'driving'         => $row,
            'logs'            => $logs,
        ]);
    }

    // =============================================================
    // Legacy CRUD (still reachable for raw editing)
    // =============================================================
    public function listing() {
        $q     = urldecode_fk($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        $config['base_url']           = build_pagination_url(Backend_URL . 'driving/listing', 'start');
        $config['first_url']          = build_pagination_url(Backend_URL . 'driving/listing', 'start');
        $config['per_page']           = 25;
        $config['page_query_string']  = TRUE;
        $config['total_rows']         = $this->Driving_model->total_rows($q);

        $drivings = $this->Driving_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = [
            'drivings'    => $drivings,
            'q'           => $q,
            'pagination'  => $this->pagination->create_links(),
            'total_rows'  => $config['total_rows'],
            'start'       => $start,
        ];
        $this->viewAdminContent('driving/driving/index', $data);
    }

    public function create() {
        $data = [
            'button'        => 'Create',
            'action'        => site_url(Backend_URL . 'driving/create_action'),
            'id'            => set_value('id'),
            'learning_id'   => set_value('learning_id'),
            'vehicle_id'    => set_value('vehicle_id'),
            'tx_date'       => set_value('tx_date', date('Y-m-d')),
            'vehicle_list'  => $this->Driving_model->get_vehicle_options(),
            'learner_list'  => $this->Driving_model->get_learner_options(),
        ];
        $this->viewAdminContent('driving/driving/create', $data);
    }

    public function create_action() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $this->Driving_model->insert([
                'learning_id' => $this->input->post('learning_id', TRUE),
                'vehicle_id'  => $this->input->post('vehicle_id',  TRUE),
                'tx_date'     => $this->input->post('tx_date',     TRUE),
            ]);
            $driving_id = (int) $this->db->insert_id();
            $this->Driving_log_model->add_log($driving_id, 'Queued');
            $this->session->set_flashdata('message',
                '<p class="ajax_success">Driving Added Successfully</p>');
            redirect(site_url(Backend_URL . 'driving'));
        }
    }

    public function update($id) {
        $driving = $this->Driving_model->get_by_id($id);
        if (!$driving) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Driving Not Found</p>');
            redirect(site_url(Backend_URL . 'driving'));
        }
        $data = [
            'button'       => 'Update',
            'action'       => site_url(Backend_URL . 'driving/update_action'),
            'id'           => set_value('id',          $driving->id),
            'learning_id'  => set_value('learning_id', $driving->learning_id),
            'vehicle_id'   => set_value('vehicle_id',  $driving->vehicle_id),
            'tx_date'      => set_value('tx_date',     $driving->tx_date),
            'vehicle_list' => $this->Driving_model->get_vehicle_options(),
            'learner_list' => $this->Driving_model->get_learner_options(),
        ];
        $this->viewAdminContent('driving/driving/update', $data);
    }

    public function update_action() {
        $this->_rules();
        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update($id);
        } else {
            $this->Driving_model->update($id, [
                'learning_id' => $this->input->post('learning_id', TRUE),
                'vehicle_id'  => $this->input->post('vehicle_id',  TRUE),
                'tx_date'     => $this->input->post('tx_date',     TRUE),
            ]);
            $this->session->set_flashdata('message',
                '<p class="ajax_success">Driving Updated Successfully</p>');
            redirect(site_url(Backend_URL . 'driving/update/' . $id));
        }
    }

    public function delete($id) {
        $driving = $this->Driving_model->get_by_id($id);
        if (!$driving) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Driving Not Found</p>');
            redirect(site_url(Backend_URL . 'driving'));
        }
        $this->viewAdminContent('driving/driving/delete', [
            'id'          => $driving->id,
            'learning_id' => $driving->learning_id,
            'vehicle_id'  => $driving->vehicle_id,
            'tx_date'     => $driving->tx_date,
        ]);
    }

    public function delete_action($id) {
        $driving = $this->Driving_model->get_by_id($id);
        if (!$driving) {
            $this->session->set_flashdata('message',
                '<p class="ajax_error">Driving Not Found</p>');
            redirect(site_url(Backend_URL . 'driving'));
        }
        $this->Driving_log_model->clear_for($id);
        $this->Driving_model->delete($id);
        $this->session->set_flashdata('message',
            '<p class="ajax_success">Driving Deleted Successfully</p>');
        redirect(site_url(Backend_URL . 'driving'));
    }

    public function _rules() {
        $this->form_validation->set_rules('learning_id', 'learner',   'trim|required|numeric');
        $this->form_validation->set_rules('vehicle_id',  'vehicle',   'trim|required|numeric');
        $this->form_validation->set_rules('tx_date',     'tx date',   'trim|required');
        $this->form_validation->set_rules('id',          'id',        'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    /**
     * Per-learner log groups for the mobile dashboard modal.
     */
    private function _learner_day_log_groups($pivot, $vehicles) {
        $vehicle_map = [];
        foreach ($vehicles as $v) {
            $label = $v->name;
            if (!empty($v->number)) {
                $label .= ' (' . $v->number . ')';
            }
            $vehicle_map[$v->id] = $label;
        }

        $out = [];
        foreach ($pivot['learners'] ?? [] as $lid => $learner) {
            $groups = [];
            foreach ($pivot['pivot'][$lid] ?? [] as $vid => $cell) {
                $logs  = $this->Driving_log_model->timeline($cell->driving_id);
                $times = driving_log_session_times($logs);
                $groups[] = [
                    'vehicle_label' => $vehicle_map[$vid] ?? ('Vehicle #' . (int) $vid),
                    'tx_date'       => $cell->tx_date ?? null,
                    'drive_type'    => $cell->drive_type ?? null,
                    'round_qty'     => $cell->round_qty ?? null,
                    'start_time'    => $times['start'],
                    'end_time'      => $times['end'],
                    'current_stage' => $cell->current_stage ?? null,
                ];
            }
            $out[$lid] = $groups;
        }
        return $out;
    }
}
