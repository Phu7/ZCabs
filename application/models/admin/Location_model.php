<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends CI_Model{

	function add_state(){
		$query = $this->db->query("INSERT INTO states SET name = '" . $this->db->escape_str($this->input->post('name')) . "', status = '" . (int)$this->input->post('status') . "'");
		return $query;
	}
	function edit_state(){
		$query = $this->db->query("UPDATE states SET name = '" . $this->db->escape_str($this->input->post('name')) . "', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}
	function get_states(){
		$query = $this->db->query("SELECT * FROM states");
		return $query;
	}
	function delete_state($id){
		$query = $this->db->query("DELETE FROM states WHERE id IN (" . $id . ")");
		return $query;
	}
	function get_state_by_id($id){
		$query = $this->db->query("SELECT * FROM states WHERE id = '" . (int)$id . "'");
		return $query;
	}/*End States*/
	
	function add_city(){
		$query = $this->db->query("INSERT INTO cities SET name = '" . $this->db->escape_str($this->input->post('name')) . "', state_id = '" . (int)$this->input->post('state_id') . "', status = '" . (int)$this->input->post('status') . "'");
		return $query;
	}
	function edit_city(){
		$query = $this->db->query("UPDATE cities SET name = '" . $this->db->escape_str($this->input->post('name')) . "', state_id = '" . (int)$this->input->post('state_id') . "', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}
	function get_cities($state){
		$a = "SELECT c.*,s.name as state_name FROM cities c LEFT JOIN states s ON(c.state_id = s.id)";
		if($state){
			$a .= " WHERE state_id = '" . $state . "'";
		}
		$query = $this->db->query($a);
		return $query;
	}
	function delete_city($id){
		$query = $this->db->query("DELETE FROM cities WHERE id IN (" . $id . ")");
		return $query;
	}
	function get_city_by_id($id){
		$query = $this->db->query("SELECT * FROM cities WHERE id = '" . (int)$id . "'");
		return $query;
	}/*End cities*/
	
	function add_locality(){
		$query = $this->db->query("INSERT INTO localities SET name = '" . $this->db->escape_str($this->input->post('name')) . "', city_id = '" . (int)$this->input->post('city_id') . "', status = '" . (int)$this->input->post('status') . "'");
		return $query;
	}
	function edit_locality(){
		$query = $this->db->query("UPDATE localities SET name = '" . $this->db->escape_str($this->input->post('name')) . "', city_id = '" . (int)$this->input->post('city_id') . "', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}
	function get_localities($city){
		$a = "SELECT l.*,c.name as city_name FROM localities l LEFT JOIN cities c ON(c.id = l.city_id)";
		if($city){
		$a .= " WHERE city_id = '" . $city . "'";
		}
		$query = $this->db->query($a);
		return $query;
	}
	
	function delete_locality($id){
		$query = $this->db->query("DELETE FROM localities WHERE id IN '(" . $id . ")'");
		return $query;
	}
	
	function get_locality_by_id($id){
		$query = $this->db->query("SELECT * FROM localities WHERE id = '" . (int)$id . "'");
		return $query;
	}/*End localties*/
	
	function get_locality_by_city($city_id){
		$query = $this->db->query("SELECT * FROM localities WHERE city_id = '" . (int)$city_id . "'");
		return $query;
	}
	
	function get_city_by_state($state_id){
		$query = $this->db->query("SELECT * FROM cities WHERE state_id = '" . (int)$state_id . "'");
		return $query;
	}
}
