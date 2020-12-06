<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver_model extends CI_Model{

	function add($image){
		$this->load->helper('string');
		$query  = $this->db->query("INSERT INTO customer SET role_id = '2', dp = '" . $image . "', status = '1', first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', created = NOW(), modified = NOW(), mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', city = '" . $this->db->escape_str($this->input->post('city')) . "', address = '" . $this->db->escape_str($this->input->post('address')) . "', state = '" . $this->db->escape_str($this->input->post('state')) . "', zip = '" . $this->db->escape_str($this->input->post('zip')) . "', country = '" . $this->db->escape_str($this->input->post('country')) . "', vehicle_type = '" . $this->db->escape_str($this->input->post('vehicle_type')) . "', vehicle_name = '" . $this->db->escape_str($this->input->post('vehicle_name')) . "', vehicle_number = '" . $this->db->escape_str($this->input->post('vehicle_number')) . "', vehicle_model = '" . $this->db->escape_str($this->input->post('vehicle_model')) . "', gender = '" . $this->db->escape_str($this->input->post('gender')) . "', dob = '" . date("Y-m-d", strtotime($this->input->post('post'))) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."'");
		return $query;
	}

	function edit($image){
		$query = $this->db->query("UPDATE customer SET dp = '" . $image . "', first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', modified = NOW(), mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', city = '" . $this->db->escape_str($this->input->post('city')) . "', address = '" . $this->db->escape_str($this->input->post('address')) . "', state = '" . $this->db->escape_str($this->input->post('state')) . "', zip = '" . $this->db->escape_str($this->input->post('zip')) . "', country = '" . $this->db->escape_str($this->input->post('country')) . "', vehicle_type = '" . $this->db->escape_str($this->input->post('vehicle_type')) . "', vehicle_name = '" . $this->db->escape_str($this->input->post('vehicle_name')) . "', vehicle_number = '" . $this->db->escape_str($this->input->post('vehicle_number')) . "', vehicle_model = '" . $this->db->escape_str($this->input->post('vehicle_model')) . "', gender = '" . $this->db->escape_str($this->input->post('gender')) . "', dob = '" . date("Y-m-d", strtotime($this->input->post('post'))) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}

	function get_drivers(){
		$query = $this->db->query("select * FROM customer WHERE status != '3' AND role_id = '2'");
		return $query;
	}

	function update($id, $status){
		$query = $this->db->query("UPDATE customer SET status = '" . (int)$status . "' WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function delete($ids){
		$count = count($ids);
		for($i=0;$i<$count;$i++){
		$this->db->query("UPDATE customer SET status = '3' WHERE id = '" . $ids[$i] . "'");
		}
		return true;
	}

	function get_driver_by_id($id){
		$query = $this->db->query("SELECT * FROM customer WHERE id = '" . (int)$id . "'");
		return $query;
	}
}
