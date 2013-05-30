<?php

class Sites_model extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->table_name = 'sites';
    $this->primary_key = 'id';
    $this->order_by = 'id DESC';
	}
	
}