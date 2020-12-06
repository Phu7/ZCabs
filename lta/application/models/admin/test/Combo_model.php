<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Combo_model extends CI_Model{

		function add(){
			$query = $this->db->query("INSERT INTO combo SET name = '" . $this->input->post('name') . "', price = '" . $this->input->post('price') . "', tests = '" . $this->input->post('tests') . "', status = '" . $this->input->post('status') . "'");
			return $query;
		}

		function edit(){
			$query = $this->db->query("UPDATE combo SET name = '" . $this->input->post('name') . "', price = '" . $this->input->post('price') . "', tests = '" . $this->input->post('tests') . "', status = '" . $this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
			return $query;
		}

		function delete($ids){
			$query = $this->db->query("DELETE FROM combo WHERE id IN '(". $ids .")'");
		}

		function get_combo_by_id($id){
			$query = $this->db->query("SELECT * FROM combo WHERE id = '" . $id . "'");
			return $query;
		}

		function get_combos(){
			$query = $this->db->query("SELECT * FROM combo");
			return $query;
		}
}
