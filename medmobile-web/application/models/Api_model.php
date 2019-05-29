<?php

class Api_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();

		}

		public function user_details($uid) {
			return $this->db->get_where('users', array('id' => $uid))->row();
		}


		
}