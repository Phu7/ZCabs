<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Rescat_model extends CI_Model{
		function add(){
			$query = $this->db->query("INSERT INTO tbl_rescat SET title = '" . $this->db->escape_str($this->input->post('title')) . "', title1 = '" . $this->db->escape_str($this->input->post('title1')) . "', titleurl = '" . $this->db->escape_str($this->input->post('titleurl')) . "', show_front = '" . $this->db->escape_str($this->input->post('front')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "', post_on = NOW(), status = '" . (int)$this->input->post('status') . "'");
			return $query;
		}

		function edit(){
			$query = $this->db->query("UPDATE tbl_rescat SET title = '" . $this->db->escape_str($this->input->post('title')) . "', title1 = '" . $this->db->escape_str($this->input->post('title1')) . "', titleurl = '" . $this->db->escape_str($this->input->post('titleurl')) . "', show_front = '" . $this->db->escape_str($this->input->post('front')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
			return $query;
		}

		function delete($ids){
			foreach($ids as $id){
			$query = $this->db->query("DELETE FROM tbl_rescat WHERE id = '" . $id . "'");
			}
			return true;
		}

		function get_rescat($id){
			$query = $this->db->query("SELECT * FROM tbl_rescat WHERE id = '" . $id . "'");
			return $query;
		}

		function get_rescats(){
			$query = $this->db->query("SELECT * FROM tbl_rescat");
			return $query;
		}


}
