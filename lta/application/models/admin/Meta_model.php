<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Meta_model extends CI_Model{

		function add(){
			$query = $this->db->query("INSERT INTO metas SET url = '" . $this->db->escape_str($this->input->post('url')) . "', title = '" . $this->db->escape_str($this->input->post('title')) . "', other = '" . $this->db->escape_str($this->input->post('other')) . "'");
			return $query;
		}

		function edit(){
			$query = $this->db->query("UPDATE metas SET url = '" . $this->db->escape_str($this->input->post('url')) . "', title = '" . $this->db->escape_str($this->input->post('title')) . "', other = '" . $this->db->escape_str($this->input->post('other')) . "' WHERE id = '" . $this->input->post('id') . "'");
			return $query;
		}

		function delete($ids){
			foreach($ids as $id){
				$query = $this->db->query("DELETE FROM metas WHERE id = '" . $id . "'");
			}
			return true;
		}

		function get_meta_by_id($id){
			$query = $this->db->query("SELECT * FROM metas WHERE id = '" . $id . "'");
			return $query;
		}

		function get_metas(){
			$query = $this->db->query("SELECT * FROM metas");
			return $query;
		}
	}
