<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Transaction_model extends Fm_model{

    public $table = 'transactions';
    public $id = 'id';
    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }    
    
    /** @internal filters keys: tab, source, date_from, date_to (search keyword is $q separately) */
    protected function _apply_statement_where($q, array $filters)
    {
        $t = 'transactions.';

        $tab = !empty($filters['tab']) ? $filters['tab'] : 'transaction';

        if ($tab === 'void') {
            $this->db->group_start();
            $this->db->where_in($t . 'tx_status', [0, '0', 'Void']);
            $this->db->group_end();
        } else {
            $this->db->group_start();
            $this->db->where_not_in($t . 'tx_status', [0, '0', 'Void']);
            $this->db->group_end();
        }

        if (!empty($filters['source']) && ctype_digit((string) $filters['source'])) {
            $this->db->where($t . 'user_id', (int) $filters['source']);
        }

        if (!empty($filters['date_from']) && strtotime($filters['date_from'])) {
            $this->db->where($t . 'tx_date >=', date('Y-m-d', strtotime($filters['date_from'])));
        }
        if (!empty($filters['date_to']) && strtotime($filters['date_to'])) {
            $this->db->where($t . 'tx_date <=', date('Y-m-d', strtotime($filters['date_to'])));
        }

        if ($q !== null && $q !== '') {
            $like = trim($q);
            $this->db->group_start();
            $this->db->like($t . 'id', $like);
            $this->db->or_like($t . 'remark', $like);
            $this->db->or_like($t . 'tx_date', $like);
            $this->db->or_like($t . 'amount', $like);
            $this->db->or_like('ts.name', $like);
            $this->db->or_like('th.name', $like);
            $this->db->or_like('subh.name', $like);
            $this->db->group_end();
        }
    }

    /** Join lookups for Income Statement listing */
    protected function _join_statement_related()
    {
        $this->db->join('trans_sources ts', 'ts.id = transactions.user_id', 'left');
        $this->db->join('trans_heads th', 'th.id = transactions.head_id', 'left');
        $this->db->join('trans_heads subh', 'subh.id = transactions.subhead_id', 'left');
    }

    /** Same tab/filters as the grid; keyword search is not applied here */
    function get_statement_totals(array $filters = [])
    {
        $this->db->reset_query();

        $this->db->select(
            'COALESCE(SUM(CASE WHEN transactions.nature = \'Cr\' THEN transactions.amount ELSE 0 END), 0) AS total_income',
            false
        );
        $this->db->select(
            'COALESCE(SUM(CASE WHEN transactions.nature = \'Dr\' THEN transactions.amount ELSE 0 END), 0) AS total_expense',
            false
        );
        $this->db->from('transactions');
        $this->_apply_statement_where(null, $filters);

        $row = $this->db->get()->row();

        $income = isset($row->total_income) ? (float) $row->total_income : 0.0;
        $expense = isset($row->total_expense) ? (float) $row->total_expense : 0.0;

        return [
            'total_income' => $income,
            'total_expense' => $expense,
            'balance' => $income - $expense,
        ];
    }

    /** get total rows (with Income Statement joins + filters) */
    function total_rows($q = NULL, $filters = [])
    {
        if (! is_array($filters)) {
            $filters = [];
        }
        $this->db->reset_query();

        $this->db->from('transactions');
        $this->_join_statement_related();
        $this->_apply_statement_where($q, $filters);

        return (int) $this->db->count_all_results();
    }

    /** get data with limit, search & filters */
    function get_limit_data($limit, $start = 0, $q = NULL, $filters = [])
    {
        if (! is_array($filters)) {
            $filters = [];
        }
        $this->db->reset_query();

        $this->db->select('transactions.*, ts.name AS source_name, th.name AS head_name, subh.name AS subhead_name');
        $this->db->from('transactions');
        $this->_join_statement_related();
        $this->_apply_statement_where($q, $filters);

        $this->db->order_by('transactions.tx_date', 'DESC');
        $this->db->order_by('transactions.' . $this->id, $this->order);

        $this->db->limit((int) $limit, (int) $start);
        return $this->db->get()->result();
    }

    /**
     * Source list = Active rows from `trans_sources`
     * Returns: [ '' => '-- Select Source --', id => 'Name', ... ]
     */
    function get_source_list() {
        $this->db->select('id, name');
        $this->db->where('status', 'Active');
        $this->db->order_by('name', 'ASC');
        $rows = $this->db->get('trans_sources')->result();

        $list = ['' => '-- Select Source --'];
        foreach ($rows as $row) {
            $list[$row->id] = $row->name;
        }
        return $list;
    }

    /**
     * Head list = Active rows from expense_heads where type='Head'
     */
    function get_head_list() {
        $this->db->select('id, name');
        $this->db->where('type', 'Head');
        $this->db->where('status', 'Active');
        $this->db->order_by('name', 'ASC');
        $rows = $this->db->get('trans_heads')->result();

        $list = ['' => '-- Select Head --'];
        foreach ($rows as $row) {
            $list[$row->id] = $row->name;
        }
        return $list;
    }

    /**
     * SubHead list = Active rows from expense_heads where type='SubHead'
     */
    function get_subhead_list() {
        $this->db->select('id, name');
        $this->db->where('type', 'SubHead');
        $this->db->where('status', 'Active');
        $this->db->order_by('name', 'ASC');
        $rows = $this->db->get('trans_heads')->result();

        $list = ['' => '-- Select Sub Head --'];
        foreach ($rows as $row) {
            $list[$row->id] = $row->name;
        }
        return $list;
    }

    /**
     * Batch list = Running and Upcoming batches
     */
    function get_batch_list() {
        $this->db->select('id, name, status');
        $this->db->where_in('status', ['Running', 'Upcoming']);
        $this->db->order_by('id', 'DESC');
        $rows = $this->db->get('batches')->result();

        $list = ['' => '-- Select Batch --'];
        foreach ($rows as $row) {
            $list[$row->id] = $row->name . ' (' . $row->status . ')';
        }
        return $list;
    }

    /**
     * Vehicle list = all vehicles (no status column on the table)
     */
    function get_vehicle_list() {
        $this->db->select('id, name, number');
        $this->db->order_by('name', 'ASC');
        $rows = $this->db->get('vehicles')->result();

        $list = ['' => '-- Select Vehicle --'];
        foreach ($rows as $row) {
            $label = $row->name;
            if (!empty($row->number)) {
                $label .= ' (' . $row->number . ')';
            }
            $list[$row->id] = $label;
        }
        return $list;
    }


}