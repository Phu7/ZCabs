<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_model extends CI_Model{

	function add($image){
		$query = $this->db->query("INSERT INTO cms SET name = '" . $this->db->escape_str($this->input->post('name')) . "', seo = '" . $this->db->escape_str($this->input->post('seo')) . "', text_data = '" . $this->db->escape_str($this->input->post('data')) . "', breadcrum = '" . $this->db->escape_str($this->input->post('breadcrum')) . "', metatitle = '" . $this->db->escape_str($this->input->post('metatitle')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "'");
		return $query;
	}

	function edit($image){
		$query = $this->db->query("UPDATE cms SET name = '" . $this->db->escape_str($this->input->post('name')) . "', seo = '" . $this->db->escape_str($this->input->post('seo')) . "', text_data = '" . $this->db->escape_str($this->input->post('data')) . "', breadcrum = '" . $this->db->escape_str($this->input->post('breadcrum')) . "', metatitle = '" . $this->db->escape_str($this->input->post('metatitle')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "' WHERE page_id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}

	function get_cms(){
		$query = $this->db->query("SELECT * FROM cms");
		return $query;
	}

	function delete($id){
		$query = $this->db->query("DELETE FROM cms WHERE page_id IN (" . $id . ")");
		return $query;
	}

	function get_cms_by_id($id){
		$query = $this->db->query("SELECT * FROM cms WHERE page_id = '" . (int)$id . "'");
		return $query;
	}

}
