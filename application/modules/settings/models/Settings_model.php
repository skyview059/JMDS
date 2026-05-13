<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends Fm_model {

    public $table = 'settings';
    public $id = 'id';
    public $order = 'ASC';

    function __construct() {
        parent::__construct();
    }

    // get all
    function get_all() {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

}
