<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Out_est_model extends CI_Model{

	function add($image){
		$this->db->query("INSERT INTO out_est SET amenities = '" . $this->db->escape_str($this->input->post('amenities')) . "', pickup_point = '" . $this->db->escape_str($this->input->post('pickup_point')) . "', drop_point = '" . $this->db->escape_str($this->input->post('drop_point')) . "', seats = '" . $this->db->escape_str($this->input->post('seats')) . "', `from` = '" . $this->db->escape_str($this->input->post('from')) . "', `to` = '" . $this->db->escape_str($this->input->post('to')) . "', fare = '" . (float)$this->input->post('fare') . "', image = '" . $this->db->escape_str($image) . "', vehicle_name = '" . $this->db->escape_str($this->input->post('vehicle_name')) . "', status = '" . (int)$this->input->post('status') . "'");
		$out_est_id = $this->db->insert_id();
		foreach($_POST['departure_date'] as $d){
			if($d != ''){
				$this->db->query("INSERT INTO out_est_date SET out_est_id = '" . (int)$out_est_id . "', `date` = '" . date("Y-m-d H:i:s", strtotime($d)) . "', remaining_seats = '" . $this->input->post('seats') . "'");
			}
		}

		return true;
	}

	function edit($image){
		$this->db->query("UPDATE out_est SET amenities = '" . $this->db->escape_str($this->input->post('amenities')) . "', pickup_point = '" . $this->db->escape_str($this->input->post('pickup_point')) . "', drop_point = '" . $this->db->escape_str($this->input->post('drop_point')) . "', seats = '" . $this->db->escape_str($this->input->post('seats')) . "', `from` = '" . $this->db->escape_str($this->input->post('from')) . "', `to` = '" . $this->db->escape_str($this->input->post('to')) . "', fare = '" . (float)$this->input->post('fare') . "', image = '" . $this->db->escape_str($image) . "', vehicle_name = '" . $this->db->escape_str($this->input->post('vehicle_name')) . "', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");

		$this->db->query("DELETE FROM out_est_date WHERE out_est_id = '" . (int)$this->input->post('id') . "'");

		foreach($_POST['departure_date'] as $d){
			if($d != ''){
				$this->db->query("INSERT INTO out_est_date SET out_est_id = '" . (int)$this->input->post('id') . "', `date` = '" . date("Y-m-d H:i:s", strtotime($d)) . "', remaining_seats = '" . $this->input->post('seats') . "'");
			}
		}
		return true;
	}

	function get_out_est(){
		$data = array();
		$date = array();
		$query = $this->db->query("SELECT * FROM out_est");
		foreach($query->result_array() as $qu){
			$query1 = $this->db->query("SELECT * FROM out_est_date WHERE out_est_id = '" . (int)$qu['id'] . "'")->result_array();

			$data[] = array("data"=>$qu,"dates"=>$query1);

		}


		return $data;
	}

	function delete($id){
		$query = $this->db->query("DELETE FROM out_est WHERE id IN (" . $id . ")");
		return $query;
	}

	function get_out_est_by_id($id){
		$query = $this->db->query("SELECT * FROM out_est WHERE id = '" . (int)$id . "'")->row_array();
		$q = $this->db->query("SELECT * FROM out_est_date WHERE out_est_id = '" . (int)$id . "'")->result_array();
		$data = array("data"=>$query, "dates"=>$q);
		return $data;
	}

	function get_location(){
		$query = $this->db->query("SELECT * FROM cities WHERE status = '1'");
		return $query;
	}

}
