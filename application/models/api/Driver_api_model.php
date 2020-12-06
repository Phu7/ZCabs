<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver_api_model extends CI_Model{

	function get_driver($id){
		$query = $this->db->query("SELECT c.bank_name, c.bank_account, c.ifsc_code, c.address_proof, c.vehicle_picture, c.insurance, c.license, c.bank_proof, c.vehicle_rc_book, c.role_id, c.dp, c.status, c.first_name, c.last_name, c.account_holder_name, c.email, c.mobile, c.city, c.address, c.state, c.pincode, c.country, c.vehicle_type, c.vehicle_name, c.vehicle_number, c.vehicle_model, c.gender, c.dob, l.access_id FROM customer c LEFT JOIN login l ON (c.id = l.customer_id) WHERE c.id = '" . (int)$id . "'");
		return $query;
	}

	function add_driver(){
		if($_FILES['image']['name']){
		 $con['upload_path']   = './uploads/';
		 $con['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|JPEG|GIF';
		 $con['max_size']      = 0;
		 $con['max_width']     = 0;
		 $con['max_height']    = 0;
		 $con['max_filename'] = '50';
		 $con['encrypt_name'] = TRUE;
		 $this->load->library('upload', $con);
			if (!$this->upload->do_upload('image')) {
				 echo $this->upload->display_errors();
				 exit;
			} else {
					$image_data8 = $this->upload->data();
					$image = "uploads/".$image_data8['file_name'];
			}
			}
			else{
				$image = '';
			}

		$this->load->helper('string');
		$query  = $this->db->query("INSERT INTO customer SET role_id = '2', dp = '" . $image . "', status = '0', first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', created = NOW(), modified = NOW(), mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', city = '" . $this->db->escape_str($this->input->post('city')) . "', address = '" . $this->db->escape_str($this->input->post('address')) . "', state = '" . $this->db->escape_str($this->input->post('state')) . "', pincode = '" . $this->db->escape_str($this->input->post('zip')) . "', country = '" . $this->db->escape_str($this->input->post('country')) . "', gender = '" . $this->db->escape_str($this->input->post('gender')) . "', dob = '" . date("Y-m-d", strtotime($this->input->post('dob'))) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."'");
		return $query;
	}
	
	function edit_driver($dp, $id){
		$query = $this->db->query("UPDATE customer SET first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', address = '" . $this->db->escape_str($this->input->post('address')) . "', city = '" . $this->db->escape_str($this->input->post('city')) . "', pincode = '" . $this->db->escape_str($this->input->post('pincode')) . "', gender = '" . $this->db->escape_str($this->input->post('gender')) . "', state = '" . $this->db->escape_str($this->input->post('state')) . "', country = '" . $this->db->escape_str($this->input->post('country')) . "', dob = '" . date("Y-m-d", strtotime($this->input->post('dob'))) . "', dp = '" . $dp . "',  modified = NOW(), ip = '". $_SERVER['REMOTE_ADDR'] ."' WHERE id = '" . (int)$id . "'");
		return $query;
	}
	
	function manage_document($user_id){
			$this->load->library('upload', $con);
			$this->upload->do_upload('license');
			$image_data = $this->upload->data();
			$license = "uploads/".$image_data['file_name'];

			/* address_proof */
			$this->load->library('upload', $con);
			$this->upload->do_upload('address_proof');
			$image_data2 = $this->upload->data();
			$address_proof = "uploads/".$image_data2['file_name'];

			/* vehicle_rc_book */
			$this->load->library('upload', $con);
			$this->upload->do_upload('vehicle_rc_book');
			$image_data3 = $this->upload->data();
			$vehicle_rc_book = "uploads/".$image_data3['file_name'];

			/* insurance */
			$this->load->library('upload', $con);
			$this->upload->do_upload('insurance');
			$image_data4 = $this->upload->data();
			$insurance = "uploads/".$image_data4['file_name'];

			/* vehicle_picture */
			$this->load->library('upload', $con);
			$this->upload->do_upload('vehicle_picture');
			$image_data5 = $this->upload->data();
			$vehicle_picture = "uploads/".$image_data5['file_name'];

			/* bank_proof */
			$this->load->library('upload', $con);
			$this->upload->do_upload('bank_proof');
			$image_data6 = $this->upload->data();
			$bank_proof = "uploads/".$image_data6['file_name'];


		$this->load->helper('string');
		$query  = $this->db->query("UPDATE customer SET bank_name = '" . $this->db->escape_str($this->input->post('bank_name')) . "', bank_account = '" . $this->db->escape_str($this->input->post('bank_account')) . "', ifsc_code = '" . $this->db->escape_str($this->input->post('ifsc')) . "', address_proof = '" . $address_proof . "', vehicle_picture = '" . $vehicle_picture . "', insurance = '" . $insurance . "', license = '" . $license . "', bank_proof = '" . $bank_proof . "', vehicle_rc_book = '" . $vehicle_rc_book . "', account_holder_name = '" . $this->db->escape_str($this->input->post('account_holder_name')) . "', modified = NOW(), vehicle_type = '" . $this->db->escape_str($this->input->post('vehicle_type')) . "', vehicle_name = '" . $this->db->escape_str($this->input->post('vehicle_name')) . "', vehicle_number = '" . $this->db->escape_str($this->input->post('vehicle_number')) . "', vehicle_model = '" . $this->db->escape_str($this->input->post('vehicle_model')) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."' WHERE id = '" . $user_id . "'");
		return $query;
	}

	function update_login($id){
		$this->load->helper('string');
		$query = $this->db->query("UPDATE login SET device_token = '" . $this->db->escape_str($this->input->post('device_token')) . "', device_type = '" . $this->db->escape_str($this->input->post('device_type')) . "', device_os = '" . $this->db->escape_str($this->input->post('device_os')) . "', login_time = NOW(), access_id = '" . $this->db->escape_str($salt = random_string('alnum', 10)) . "' WHERE customer_id = '" . (int)$id . "'");
		if($query){
				return $salt;
		}
		else{
				return false;
		}
	}

	function add_login($id){
		$this->load->helper('string');
		$query = $this->db->query("INSERT INTO login SET customer_id = '" . (int)$id . "', device_token = '" . $this->db->escape_str($this->input->post('device_token')) . "', device_type = '" . $this->db->escape_str($this->input->post('device_type')) . "', device_os = '" . $this->db->escape_str($this->input->post('device_os')) . "', login_time = NOW(), access_id = '" . $this->db->escape_str($salt = random_string('alnum', 10)) . "'");
		if($query){
				return $salt;
		}
		else{
				return false;
		}
	}

	function isAccessId($access_id){
		$query = $this->db->query("SELECT customer_id FROM login WHERE access_id = '" . $this->db->escape_str($access_id) . "'");
		if($query->num_rows()){
				$q = $query->row();
				return $q->customer_id;
		}
		else{
				return false;
		}
	}

	function logout($access_id){
		$query = $this->db->query("DELETE FROM login WHERE access_id = '" . $this->db->escape_str($access_id) . "'");
		return $query;
	}

	function isRegistered($mobile, $email){
		$query = $this->db->query("SELECT id, status FROM customer WHERE email = '" . $this->db->escape_str($email) . "' OR mobile = '" . $this->db->escape_str($mobile) . "'");
		if($query->num_rows()){
			$q = $query->row();
			$data['status'] = $q->status;
			$data['customer_id'] = $q->id;
		}
		else{
			$data['status'] = '2';
			$data['customer_id'] = '';
		}
		return $data;
	}

	function complete_user(){
		$raw = $this->db->query("SELECT role_id FROM customer WHERE mobile = '" . $this->db->escape_str($this->session->userdata('username')) . "'");
		if($raw->num_rows()){
			if($raw->row()->role_id == 1){
				$status = 1;
			}	else{
				$status = 2;
			}
			$query = $this->db->query("UPDATE customer SET status = '" . $status . "' WHERE mobile = '" . $this->db->escape_str($this->session->userdata('username')) . "'");
			return $query;
		} else{
			return false;
		}
	}

	function edit_customer($dp, $id){
		$query = $this->db->query("UPDATE customer SET first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', address = '" . $this->db->escape_str($this->input->post('address')) . "', city = '" . $this->db->escape_str($this->input->post('city')) . "', pincode = '" . $this->db->escape_str($this->input->post('pincode')) . "', gender = '" . $this->db->escape_str($this->input->post('gender')) . "', state = '" . $this->db->escape_str($this->input->post('state')) . "', country = '" . $this->db->escape_str($this->input->post('country')) . "', dob = '" . date("Y-m-d", strtotime($this->input->post('dob'))) . "', dp = '" . $dp . "',  modified = NOW(), ip = '". $_SERVER['REMOTE_ADDR'] ."' WHERE id = '" . (int)$id . "'");
		return $query;
	}
	
	function manage_duty($id, $status){
		$query = $this->db->query("Update driver_duty SET status = '" . (int)$status . "', modified = NOW() WHERE driver_id = '" . (int)$id . "'");
		return $query;
	}
	
	function manage_token(){
		$this->load->helper('string');
		$query = $this->db->query("Update login SET login_time = NOW(), access_id = '" . $this->db->escape_str($salt = random_string('alnum', 10)) . "' WHERE customer_id = '" . (int)$this->input->post('user_id') . "'");
		return $query;
	}
	
	function manage_app(){
		$query = $this->db->query("Update login SET device_token = '" . $this->db->escape_str($this->input->post('device_token')) . "', device_type = '" . $this->db->escape_str($this->input->post('device_type')) . "', device_os = '" . $this->db->escape_str($this->input->post('device_os')) . "', login_time = NOW() WHERE access_id = '" . (int)$this->input->post('access_token') . "'");
		return $query;
	}
	
	
	function file_get_contents_curl($url){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

}
