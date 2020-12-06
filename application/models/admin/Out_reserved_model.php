<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Out_reserved_model extends CI_Model{

	function add($image){
		$query = $this->db->query("INSERT INTO out_reserved SET amenities = '" . $this->db->escape_str($this->input->post('amenities')) . "', pickup_point = '" . $this->db->escape_str($this->input->post('pickup_point')) . "', seats = '" . $this->db->escape_str($this->input->post('seats')) . "', drop_point = '" . $this->db->escape_str($this->input->post('drop_point')) . "', `from` = '" . $this->db->escape_str($this->input->post('from')) . "', `to` = '" . $this->db->escape_str($this->input->post('to')) . "', fare = '" . (float)$this->input->post('fare') . "', image = '" . $this->db->escape_str($image) . "', vehicle_name = '" . $this->db->escape_str($this->input->post('vehicle_name')) . "', status = '" . (int)$this->input->post('status') . "'");
		return $query;
	}
	
	function edit($image){
		$query = $this->db->query("UPDATE out_reserved SET amenities = '" . $this->db->escape_str($this->input->post('amenities')) . "', pickup_point = '" . $this->db->escape_str($this->input->post('pickup_point')) . "', seats = '" . $this->db->escape_str($this->input->post('seats')) . "', drop_point = '" . $this->db->escape_str($this->input->post('drop_point')) . "', `from` = '" . $this->db->escape_str($this->input->post('from')) . "', `to` = '" . $this->db->escape_str($this->input->post('to')) . "', fare = '" . (float)$this->input->post('fare') . "', image = '" . $this->db->escape_str($image) . "', vehicle_name = '" . $this->db->escape_str($this->input->post('vehicle_name')) . "', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}
	
	function get_out_reserved(){
		$query = $this->db->query("SELECT * FROM out_reserved");
		return $query;
	}
	
	function delete($id){
		$query = $this->db->query("DELETE FROM out_reserved WHERE id IN (" . $id . ")");
		return $query;
	}
	
	function get_out_reserved_by_id($id){
		$query = $this->db->query("SELECT * FROM out_reserved WHERE id = '" . (int)$id . "'");
		return $query;
	}
	
	function get_location(){
		$query = $this->db->query("SELECT * FROM cities WHERE status = '1'");
		return $query;
	}

}
