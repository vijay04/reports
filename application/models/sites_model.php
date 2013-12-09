<?php

class Sites_model extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->table_name = 'sites';
    $this->primary_key = 'id';
    $this->order_by = 'id DESC';
	}
	
	public function deletereports() {
		$this->load->database();
		$last_month = strtotime('-1 month');
		$old_data = $this->db->where('created <', $last_month )->limit(50000)->order_by("id", "asc")->get('reports')->result();
		$delete_array = array();
		foreach ($old_data as $key => $value) {
			$delete_array[] = $value->id;
		}
		if ($delete_array) {
			$this->db->where_in('id', $delete_array);
			$this->db->delete('reports');
		}
	}
}