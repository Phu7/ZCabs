<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sight_location_model extends CI_Model{

	function get_states(){
		$query = $this->db->query("SELECT * FROM states");
		return $query;
	}
	
	function add_city(){
		$query = $this->db->query("INSERT INTO sites SET name = '" . $this->db->escape_str($this->input->post('name')) . "', state_id = '" . (int)$this->input->post('state_id') . "', status = '" . (int)$this->input->post('status') . "'");
		return $query;
	}
	function edit_city(){
		$query = $this->db->query("UPDATE sites SET name = '" . $this->db->escape_str($this->input->post('name')) . "', state_id = '" . (int)$this->input->post('state_id') . "', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}
	function get_cities($state){
		$a = "SELECT c.*,s.name as state_name FROM sites c LEFT JOIN states s ON(c.state_id = s.id)";
		if($state){
			$a .= " WHERE state_id = '" . $state . "'";
		}
		$query = $this->db->query($a);
		return $query;
	}
	function delete_city($id){
		$query = $this->db->query("DELETE FROM sites WHERE id IN (" . $id . ")");
		return $query;
	}
	function get_city_by_id($id){
		$query = $this->db->query("SELECT * FROM sites WHERE id = '" . (int)$id . "'");
		return $query;
	}/*End cities*/
	
	function get_city_by_state($state_id){
		$query = $this->db->query("SELECT * FROM sites WHERE state_id = '" . (int)$state_id . "'");
		return $query;
	}
}
