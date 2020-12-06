<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent_model extends CI_Model{
	
	function edit(){
		$con['upload_path']   = './uploads/';
		 $con['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|JPEG|GIF';
		 $con['max_size']      = 0;
		 $con['max_width']     = 0;
		 $con['max_height']    = 0;
		 $con['max_filename'] = '50';
		 $con['encrypt_name'] = TRUE;
		
			$con['upload_path']   = './agent_images/';
			$con['allowed_types'] = 'jpg|png|jpeg';
			$con['max_size']      = 0;
			$con['max_width']     = 0;
			$con['max_height']    = 0;
			$con['max_filename'] = '50';
			$con['encrypt_name'] = TRUE;
			/* Photo */
			if($_FILES['photo']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('photo');
				$image_data = $this->upload->data();
				$photo = "agent_images/".$image_data['file_name'];
			}
			else{
				$photo = $this->input->post('o_photo');
			}
			/* id_proof */
			if($_FILES['id_proof']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('id_proof');
				$image_data1 = $this->upload->data();
				$id_proof = "agent_images/".$image_data1['file_name'];
			}
			else{
				$id_proof = $this->input->post('o_id_proof');
			}
			/* address_proof */
			if($_FILES['address_proof']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('address_proof');
				$image_data2 = $this->upload->data();
				$address_proof = "agent_images/".$image_data2['file_name'];
			}
			else{
				$address_proof = $this->input->post('o_address_proof');
			}
			/* office_front_photo */
			if($_FILES['office_front_photo']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('office_front_photo');
				$image_data3 = $this->upload->data();
				$office_front_photo = "agent_images/".$image_data3['file_name'];
			}
			else{
				$office_front_photo = $this->input->post('o_office_front_photo');
			}
			/* bank_proof */
			if($_FILES['bank_proof']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('bank_proof');
				$image_data4 = $this->upload->data();
				$bank_proof = "agent_images/".$image_data4['file_name'];
			}
			else{
				$bank_proof = $this->input->post('o_bank_proof');
			}
			/* office_inside_photo */
			if($_FILES['office_inside_photo']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('office_inside_photo');
				$image_data5 = $this->upload->data();
				$office_inside_photo = "agent_images/".$image_data5['file_name'];
			}
			else{
				$office_inside_photo = $this->input->post('o_office_inside_photo');
			}
		$this->db->query("UPDATE customer SET account_holder_name = '" . $this->db->escape_str($this->input->post('account_holder_name')) . "', bank_name = '" . $this->db->escape_str($this->input->post('bank_name')) . "', bank_account = '" . $this->db->escape_str($this->input->post('bank_account')) . "', ifsc_code = '" . $this->db->escape_str($this->input->post('ifsc')) . "', role_id = '3', status = '0', father_name = '" . $this->db->escape_str($this->input->post('father_name')) . "', raddress = '" . $this->db->escape_str(nl2br($this->input->post('residential_address'))) . "', address = '" . $this->db->escape_str(nl2br($this->input->post('office_address'))) . "', dp = '" . $photo . "', id_proof = '" . $id_proof . "', address_proof = '" . $address_proof . "', office_front_photo = '" . $office_front_photo . "', bank_proof = '" . $bank_proof . "', office_inside_photo = '" . $office_inside_photo . "', first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', modified = NOW(), mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."' WHERE id = '" . $this->input->post('id') . "'");
		return true;
	}
	
	function get_agents(){
		$query = $this->db->query("select * FROM customer WHERE role_id = '3' AND status != '3'");
		return $query;
	}

	function update($id, $status){
		$query = $this->db->query("UPDATE customer SET status = '" . (int)$status . "' WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function delete($ids){
		$query = $this->db->query("UPDATE customer SET status = '3' WHERE id IN (" . $ids . ")");
		return $query;
	}

	function get_agent_by_id($id){
		$query = $this->db->query("SELECT * FROM customer WHERE id = '" . (int)$id . "'");
		return $query;
	}
}
