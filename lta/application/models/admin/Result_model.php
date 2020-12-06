<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result_model extends CI_Model{

	function add($image){
		$query = $this->db->query("INSERT INTO tbl_result SET p_id = '" . (int)$this->input->post('pid') . "', title = '" . $this->db->escape_str($this->input->post('title')) . "', titleurl = '" . $this->db->escape_str($this->input->post('titleurl')) . "', image = '" . $this->db->escape_str($image) . "', university = '" . $this->db->escape_str($this->input->post('university')) . "', rank = '" . $this->db->escape_str($this->input->post('rank')) . "', rollno = '" . $this->db->escape_str($this->input->post('roll')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "', front = '" . (int)$this->input->post('front') . "', post_on = NOW(), status = '" . (int)$this->input->post('status') . "'");
		return $query;
	}

	function edit($image){
		$query = $this->db->query("UPDATE tbl_result SET p_id = '" . (int)$this->input->post('pid') . "', title = '" . $this->db->escape_str($this->input->post('title')) . "', titleurl = '" . $this->db->escape_str($this->input->post('titleurl')) . "', image = '" . $this->db->escape_str($image) . "', university = '" . $this->db->escape_str($this->input->post('university')) . "', rank = '" . $this->db->escape_str($this->input->post('rank')) . "', rollno = '" . $this->db->escape_str($this->input->post('roll')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "', front = '" . (int)$this->input->post('front') . "', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}

	function get_results(){
		$query = $this->db->query("SELECT * FROM tbl_result");
		return $query;
	}

	function delete($id){
		$query = $this->db->query("DELETE FROM tbl_result WHERE id IN (" . $id . ")");
		return $query;
	}

	function get_result_by_id($id){
		$query = $this->db->query("SELECT * FROM tbl_result WHERE id = '" . (int)$id . "'");
		return $query;
	}

}
