<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer_model extends CI_Model{

	function add($image){
		$query = $this->db->query("INSERT INTO offers SET name = '" . $this->db->escape_str($this->input->post('name')) . "', text_data = '" . $this->db->escape_str($this->input->post('data')) . "', image = '" . $this->db->escape_str($image) . "', status = '" . (int)$this->input->post('status') . "'");
		return $query;
	}

	function edit($image){
		$query = $this->db->query("UPDATE offers SET name = '" . $this->db->escape_str($this->input->post('name')) . "', text_data = '" . $this->db->escape_str($this->input->post('data')) . "', image = '" . $this->db->escape_str($image) . "', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}

	function get_offers(){
		$query = $this->db->query("SELECT * FROM offers");
		return $query;
	}

	function delete($id){
		$query = $this->db->query("DELETE FROM offers WHERE id IN (" . $id . ")");
		return $query;
	}

	function get_offer_by_id($id){
		$query = $this->db->query("SELECT * FROM offers WHERE id = '" . (int)$id . "'");
		return $query;
	}

}
