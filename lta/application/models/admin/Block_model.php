<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Block_model extends CI_Model{
		function add(){
			$query = $this->db->query("INSERT INTO blocks SET name = '" . $this->db->escape_str($this->input->post('name')) . "', textdata = '" . $this->db->escape_str($this->input->post('textdata')) . "', title = '" . $this->db->escape_str($this->input->post('title')) . "', created = NOW()");
			return $query;
		}

		function edit(){
			$query = $this->db->query("UPDATE blocks SET name = '" . $this->db->escape_str($this->input->post('name')) . "', textdata = '" . $this->db->escape_str($this->input->post('textdata')) . "', title = '" . $this->db->escape_str($this->input->post('title')) . "' WHERE id = '" . $this->input->post('id') . "'");
			return $query;
		}

		function delete($ids){
			foreach($ids as $id){
			$query = $this->db->query("DELETE FROM blocks WHERE id = '" . $id . "'");
			}
			return true;
		}

		function get_block_by_id($id){
			$query = $this->db->query("SELECT * FROM blocks WHERE id = '" . $id . "'");
			return $query;
		}

		function get_blocks(){
			$query = $this->db->query("SELECT * FROM blocks");
			return $query;
		}


}
