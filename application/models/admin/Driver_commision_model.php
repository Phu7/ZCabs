<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver_commision_model extends CI_Model{

	function add(){
		$query = $this->db->query("INSERT INTO driver_commision SET rate = '" . (int)$this->input->post('rate') . "'");
		return $query;
	}

	function edit(){
		$query = $this->db->query("UPDATE driver_commision SET rate = '" . (int)$this->input->post('rate') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}

	function get_commision_by_id($id){
		$query = $this->db->query("SELECT * FROM driver_commision WHERE id = '" . (int)$id . "'");
		return $query;
	}

}
