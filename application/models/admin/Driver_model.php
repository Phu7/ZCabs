<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver_model extends CI_Model{


	function add(){
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


			/* License */
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
			$this->upload->do_upload('bank_proof');
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
		$query  = $this->db->query("INSERT INTO customer SET bank_name = '" . $this->db->escape_str($this->input->post('bank_name')) . "', bank_account = '" . $this->db->escape_str($this->input->post('bank_account')) . "', ifsc_code = '" . $this->db->escape_str($this->input->post('ifsc')) . "', address_proof = '" . $address_proof . "', vehicle_picture = '" . $vehicle_picture . "', insurance = '" . $insurance . "', license = '" . $license . "', bank_proof = '" . $bank_proof . "', vehicle_rc_book = '" . $vehicle_rc_book . "', role_id = '2', dp = '" . $image . "', status = '1', first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', account_holder_name = '" . $this->db->escape_str($this->input->post('account_holder_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', created = NOW(), modified = NOW(), mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', city = '" . $this->db->escape_str($this->input->post('city')) . "', address = '" . $this->db->escape_str($this->input->post('address')) . "', state = '" . $this->db->escape_str($this->input->post('state')) . "', pincode = '" . $this->db->escape_str($this->input->post('zip')) . "', country = '" . $this->db->escape_str($this->input->post('country')) . "', vehicle_type = '" . $this->db->escape_str($this->input->post('vehicle_type')) . "', vehicle_name = '" . $this->db->escape_str($this->input->post('vehicle_name')) . "', vehicle_number = '" . $this->db->escape_str($this->input->post('vehicle_number')) . "', vehicle_model = '" . $this->db->escape_str($this->input->post('vehicle_model')) . "', gender = '" . $this->db->escape_str($this->input->post('gender')) . "', dob = '" . date("Y-m-d", strtotime($this->input->post('post'))) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."'");
		return $query;
	}
	
	function edit(){
		$con['upload_path']   = './uploads/';
		 $con['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|JPEG|GIF';
		 $con['max_size']      = 0;
		 $con['max_width']     = 0;
		 $con['max_height']    = 0;
		 $con['max_filename'] = '50';
		 $con['encrypt_name'] = TRUE;
		if($_FILES['image']['name']){
		 
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
				$image = $this->input->post('o_image');
			}


			/* License */
			if($_FILES['license']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('license');
				$image_data = $this->upload->data();
				$license = "uploads/".$image_data['file_name'];
			}
			else{
				$license = $this->input->post('o_license');
			}

			/* address_proof */
			if($_FILES['address_proof']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('address_proof');
				$image_data2 = $this->upload->data();
				$address_proof = "uploads/".$image_data2['file_name'];
			}
			else{
				$address_proof = $this->input->post('o_address_proof');
			}
			/* vehicle_rc_book */
			if($_FILES['vehicle_rc_book']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('vehicle_rc_book');
				$image_data3 = $this->upload->data();
				$vehicle_rc_book = "uploads/".$image_data3['file_name'];
			}
			else{
				$vehicle_rc_book = $this->input->post('o_vehicle_rc_book');
			}
			/* insurance */
			if($_FILES['bank_proof']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('bank_proof');
				$image_data4 = $this->upload->data();
				$insurance = "uploads/".$image_data4['file_name'];
			}
			else{
				$insurance = $this->input->post('o_bank_proof');
			}
			/* vehicle_picture */
			if($_FILES['vehicle_picture']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('vehicle_picture');
				$image_data5 = $this->upload->data();
				$vehicle_picture = "uploads/".$image_data5['file_name'];
			}
			else{
				$vehicle_picture = $this->input->post('o_vehicle_picture');
			}
			/* bank_proof */
			if($_FILES['bank_proof']['name']){
				$this->load->library('upload', $con);
				$this->upload->do_upload('bank_proof');
				$image_data6 = $this->upload->data();
				$bank_proof = "uploads/".$image_data6['file_name'];
			}
			else{
				$bank_proof = $this->input->post('o_bank_proof');
			}

		$this->load->helper('string');
		$query  = $this->db->query("UPDATE customer SET bank_name = '" . $this->db->escape_str($this->input->post('bank_name')) . "', bank_account = '" . $this->db->escape_str($this->input->post('bank_account')) . "', ifsc_code = '" . $this->db->escape_str($this->input->post('ifsc')) . "', address_proof = '" . $address_proof . "', vehicle_picture = '" . $vehicle_picture . "', insurance = '" . $insurance . "', license = '" . $license . "', bank_proof = '" . $bank_proof . "', vehicle_rc_book = '" . $vehicle_rc_book . "', role_id = '2', dp = '" . $image . "', status = '1', first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', account_holder_name = '" . $this->db->escape_str($this->input->post('account_holder_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', created = NOW(), modified = NOW(), mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', city = '" . $this->db->escape_str($this->input->post('city')) . "', address = '" . $this->db->escape_str($this->input->post('address')) . "', state = '" . $this->db->escape_str($this->input->post('state')) . "', pincode = '" . $this->db->escape_str($this->input->post('zip')) . "', country = '" . $this->db->escape_str($this->input->post('country')) . "', vehicle_type = '" . $this->db->escape_str($this->input->post('vehicle_type')) . "', vehicle_name = '" . $this->db->escape_str($this->input->post('vehicle_name')) . "', vehicle_number = '" . $this->db->escape_str($this->input->post('vehicle_number')) . "', vehicle_model = '" . $this->db->escape_str($this->input->post('vehicle_model')) . "', gender = '" . $this->db->escape_str($this->input->post('gender')) . "', dob = '" . date("Y-m-d", strtotime($this->input->post('dob'))) . "' WHERE id ='" . (int)$this->input->post('id') . "'");
		return $query;
	}

	function get_drivers(){
		$query = $this->db->query("select * FROM customer where role_id='2'");
		return $query;
	}

	function update($id, $status){
		$query = $this->db->query("UPDATE customer SET status = '" . (int)$status . "' WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function delete($ids){
		$query = $this->db->query("DELETE from customer WHERE id IN (" . $ids . ")");
		return $query;
	}

	function get_driver_by_id($id){
		$query = $this->db->query("SELECT * FROM customer WHERE id = '" . (int)$id . "'");
		return $query;
	}
}
