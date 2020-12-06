<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model{

	function get_customer($id){
		$query = $this->db->query("SELECT c.bank_account as bank_detail, c.role_id,c.id,c.first_name,c.last_name,c.email,c.mobile,c.address,c.city,c.state,c.country,c.pincode,c.gender,c.dob,c.dp,c.status,l.access_id FROM customer c LEFT JOIN login l ON (c.id = l.customer_id) WHERE c.id = '" . (int)$id . "'");
		return $query;
	}

	function check_login($username, $password){
		$query = $this->db->query("SELECT id FROM customer WHERE (email = '" . $this->db->escape_str($username) . "' OR mobile = '" . $this->db->escape_str($username) . "') AND password = SHA1(CONCAT(token, SHA1(CONCAT(token, SHA1('" . $this->db->escape_str($password) . "'))))) AND status = '1'");
		return $query;
	}

	function isLogged($id){
		$query = $this->db->query("SELECT id FROM login WHERE customer_id = '" . (int)$id . "'");
		if($query->num_rows()){
			return true;
		}
		else{
			return false;
		}
	}

	/*
	Web Panel
	@agent
	Withdrawal request
	*/

	function get_offers(){
		$query = $this->db->query("SELECT * FROM offers WHERE status = '1'");
		return $query;
	}

	function add_driver(){
		if($_FILES['image']['name']){
		 $con['upload_path']   = './uploads/';
		 $con['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
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
		$query  = $this->db->query("INSERT INTO customer SET bank_name = '" . $this->db->escape_str($this->input->post('bank_name')) . "', bank_account = '" . $this->db->escape_str($this->input->post('bank_account')) . "', ifsc_code = '" . $this->db->escape_str($this->input->post('ifsc')) . "', address_proof = '" . $address_proof . "', vehicle_picture = '" . $vehicle_picture . "', insurance = '" . $insurance . "', license = '" . $license . "', bank_proof = '" . $bank_proof . "', vehicle_rc_book = '" . $vehicle_rc_book . "', role_id = '2', dp = '" . $image . "', status = '0', first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', account_holder_name = '" . $this->db->escape_str($this->input->post('account_holder_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', created = NOW(), modified = NOW(), mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', city = '" . $this->db->escape_str($this->input->post('city')) . "', address = '" . $this->db->escape_str($this->input->post('address')) . "', state = '" . $this->db->escape_str($this->input->post('state')) . "', pincode = '" . $this->db->escape_str($this->input->post('zip')) . "', country = '" . $this->db->escape_str($this->input->post('country')) . "', vehicle_type = '" . $this->db->escape_str($this->input->post('vehicle_type')) . "', vehicle_name = '" . $this->db->escape_str($this->input->post('vehicle_name')) . "', vehicle_number = '" . $this->db->escape_str($this->input->post('vehicle_number')) . "', vehicle_model = '" . $this->db->escape_str($this->input->post('vehicle_model')) . "', gender = '" . $this->db->escape_str($this->input->post('gender')) . "', dob = '" . date("Y-m-d", strtotime($this->input->post('post'))) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."'");
		return $query;
	}

	function send_withdrawal_request(){
		$query = $this->db->query("INSERT INTO withdrawal_request SET customer_id = '" . (int)$this->customer->getId() . "', amount = '" . (float)$this->input->post('amount') . "', remark = '" . $this->db->escape_str(nl2br($this->input->post("remark"))) . "', status = '9', created = NOW(), type = '" . (int)$this->customer->isType() . "' ");
		return $query;
	}

	function get_transactions(){
		$query = $this->db->query("SELECT * FROM withdrawal_request WHERE customer_id = '" . (int)$this->customer->getId() . "'");
		return $query;
	}

	function get_payins(){
		$query = $this->db->query("SELECT * FROM transaction WHERE customer_id = '" . (int)$this->customer->getId() . "'");
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
		$query = $this->db->query("SELECT id, status FROM customer WHERE (email = '" . $this->db->escape_str($email) . "' AND email != '') OR mobile = '" . $this->db->escape_str($mobile) . "'");
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

	function add_customer($dp){
		$this->load->helper('string');
		$this->db->query("INSERT INTO customer SET role_id = '1', status = '1', first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', created = NOW(), modified = NOW(), dp = '" . $dp . "', mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', gender = '" . $this->db->escape_str($this->input->post('gender')) . "', dob = '" . date("Y-m-d", strtotime($this->input->post('dob'))) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."'");
		$customer_id = $this->db->insert_id();
		$this->db->query("INSERT INTO login SET customer_id = '" . (int)$customer_id . "', device_token = '" . $this->db->escape_str($this->input->post('device_token')) . "', device_type = '" . $this->db->escape_str($this->input->post('device_type')) . "', device_os = '" . $this->db->escape_str($this->input->post('device_os')) . "', login_time = NOW(), access_id = '" . $this->db->escape_str($salt = random_string('alnum', 10)) . "'");
		return $customer_id;
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

	function add_web_customer(){
		$this->load->helper('string');
		$this->db->query("INSERT INTO customer SET role_id = '1', status = '0', first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', created = NOW(), modified = NOW(), mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."'");
		$customer_id = $this->db->insert_id();
		return $customer_id;
	}

	function add_agent(){
			$con['upload_path']   = './agent_images/';
			$con['allowed_types'] = 'jpg|png|jpeg';
			$con['max_size']      = 0;
			$con['max_width']     = 0;
			$con['max_height']    = 0;
			$con['max_filename'] = '50';
			$con['encrypt_name'] = TRUE;
			/* Photo */
			$this->load->library('upload', $con);
			$this->upload->do_upload('photo');
			$image_data = $this->upload->data();
			$photo = "agent_images/".$image_data['file_name'];

			/* id_proof */
			$this->load->library('upload', $con);
			$this->upload->do_upload('id_proof');
			$image_data1 = $this->upload->data();
			$id_proof = "agent_images/".$image_data1['file_name'];

			/* address_proof */
			$this->load->library('upload', $con);
			$this->upload->do_upload('address_proof');
			$image_data2 = $this->upload->data();
			$address_proof = "agent_images/".$image_data2['file_name'];

			/* office_front_photo */
			$this->load->library('upload', $con);
			$this->upload->do_upload('office_front_photo');
			$image_data3 = $this->upload->data();
			$office_front_photo = "agent_images/".$image_data3['file_name'];

			/* bank_proof */
			$this->load->library('upload', $con);
			$this->upload->do_upload('bank_proof');
			$image_data4 = $this->upload->data();
			$bank_proof = "agent_images/".$image_data4['file_name'];

			/* office_inside_photo */
			$this->load->library('upload', $con);
			$this->upload->do_upload('office_inside_photo');
			$image_data5 = $this->upload->data();
			$office_inside_photo = "agent_images/".$image_data5['file_name'];

		$this->load->helper('string');
		$this->db->query("INSERT INTO customer SET account_holder_name = '" . $this->db->escape_str($this->input->post('account_holder_name')) . "', bank_name = '" . $this->db->escape_str($this->input->post('bank_name')) . "', bank_account = '" . $this->db->escape_str($this->input->post('bank_account')) . "', ifsc_code = '" . $this->db->escape_str($this->input->post('ifsc')) . "', role_id = '3', status = '0', father_name = '" . $this->db->escape_str($this->input->post('father_name')) . "', raddress = '" . $this->db->escape_str(nl2br($this->input->post('residential_address'))) . "', address = '" . $this->db->escape_str(nl2br($this->input->post('office_address'))) . "', dp = '" . $photo . "', id_proof = '" . $id_proof . "', address_proof = '" . $address_proof . "', office_front_photo = '" . $office_front_photo . "', bank_proof = '" . $bank_proof . "', office_inside_photo = '" . $office_inside_photo . "', first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', created = NOW(), modified = NOW(), mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."'");
		$customer_id = $this->db->insert_id();
		return $customer_id;
	}

	function edit_customer($dp, $id){
		$query = $this->db->query("UPDATE customer SET first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', address = '" . $this->db->escape_str($this->input->post('address')) . "', city = '" . $this->db->escape_str($this->input->post('city')) . "', pincode = '" . $this->db->escape_str($this->input->post('pincode')) . "', gender = '" . $this->db->escape_str($this->input->post('gender')) . "', state = '" . $this->db->escape_str($this->input->post('state')) . "', country = '" . $this->db->escape_str($this->input->post('country')) . "', dob = '" . date("Y-m-d", strtotime($this->input->post('dob'))) . "', dp = '" . $dp . "',  modified = NOW(), ip = '". $_SERVER['REMOTE_ADDR'] ."' WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function isPassword($id, $password){
			$query = $this->db->query("SELECT id FROM customer WHERE id = '" . (int)$id . "' AND password = SHA1(CONCAT(token, SHA1(CONCAT(token, SHA1('" . $this->db->escape_str($password) . "'))))) AND status = '1'");
			if($query->num_rows()){
				return true;
			}
			else{
				return false;
			}
	}

	function user_verified($id){
		$query = $this->db->query("UPDATE customer SET status = '1' WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function update_password($id){
		$this->load->helper('string');
		$query = $this->db->query("UPDATE customer SET token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('new_password'))))) . "' WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function new_password($mobile, $otp){
		$this->load->helper('string');
		$query = $this->db->query("UPDATE customer SET token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($otp)))) . "' WHERE mobile = '" . $this->db->escape_str($mobile) . "'");
		return $query;
	}

	function send_contact(){
		$query = $this->db->query("INSERT INTO contact_us SET dep_date = '" . date("Y-m-d h:i:s", strtotime($this->input->post('dep_date'))) . "', mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', name = '" . $this->db->escape_str($this->input->post('name')) . "', message = '" . $this->db->escape_str($this->input->post('message')) . "', is_replied = '2', created = NOW(), modified = NOW()");
		return $query;
	}

	function get_cms($slug){
		$query = $this->db->query("SELECT * FROM cms WHERE slug = '" . $this->db->escape_str($slug) . "'");
		return $query;
	}

	function get_site_location(){
		$query = $this->db->query("SELECT id,name FROM sites WHERE status = '1'");
		return $query;
	}

	function get_location(){
		$query = $this->db->query("SELECT id,name FROM cities WHERE status = '1'");
		return $query;
	}

	function add_outstation($id){
		$departure_date = ($this->input->post('departure_date') != "") ? date("Y-m-d h:i:s", strtotime($this->input->post('departure_date'))):'';
		$return_date = ($this->input->post('return_date') != "") ? date("Y-m-d h:i:s", strtotime($this->input->post('return_date'))):'';
		$query = $this->db->query("INSERT INTO outstation SET customer_id = '" . (int)$id . "', _from = '" . $this->db->escape_str($this->input->post('_from')) . "', _to = '" . $this->db->escape_str($this->input->post('_to')) . "', departure_date = '" . $departure_date . "', return_date = '" . $return_date . "',  passengers = '" . $this->db->escape_str($this->input->post('passengers')) . "', type = '" . (int)$this->input->post('type') . "', pool_type = '" . $this->db->escape_str($this->input->post('pool_type')) . "', status = '1', created = NOW(), modified = NOW()");

		$q = $this->db->query("SELECT * FROM customer WHERE id = '" . (int)$id . "'")->row();
		$msg = urlencode('Hello, A new Booking  of Local Trip has arrived. ' . $q->first_name . " " . $q->last_name . ' and ' . $this->input->post('departure_date') . ' on zcabs.in.');
		$msg1 = urlencode('Hello, Your booking with zcabs.in confirmed in very short time. Thank you.');
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=8170823370&sms='.$msg.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=' . $q->mobile . '&sms='.$msg1.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);

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

	function get_outstation_price($to, $from, $date){
		$p = 2;
		if($this->input->post('passengers')){
			$p = $this->input->post('passengers');
		}
		$query = $this->db->query("SELECT oe.*, oed.remaining_seats, DATE_FORMAT(oed.date,'%h:%i %p') as departure_date, oed.reduce_id as oedid FROM out_est_date oed LEFT JOIN out_est oe ON(oe.id = oed.out_est_id AND DATE(oed.date) = '" . date('Y-m-d', strtotime($date)) . "') WHERE oe.`from` = '" . $this->db->escape_str($from) . "' AND oe.`to` = '" . $this->db->escape_str($to) . "' AND oe.status = '1' AND oed.remaining_seats >= '" . $p . "'");
		return $query;
	}

	function get_reserved_outstation_price($to, $from){
		$query = $this->db->query("SELECT * FROM out_reserved WHERE `from` = '" . $this->db->escape_str($from) . "' AND `to` = '" . $this->db->escape_str($to) . "' AND status = '1'");
		return $query;
	}

	function save_order($req){
		$query = $this->db->query("INSERT INTO outstation SET customer_id = '" . (int)$this->customer->getId() . "', _from = '" . $this->db->escape_str($req->_from) . "', _to = '" . $this->db->escape_str($req->_to) . "', departure_date = '" . date("Y-m-d h:i:s", strtotime($req->departure_date)) . "', return_date = '" . date("Y-m-d h:i:s", strtotime($req->return_date)) . "',  passengers = '" . $this->db->escape_str($req->passengers) . "', type = '" . (int)$req->type . "', pool_type = '" . $this->db->escape_str($req->pull_type) . "', status = '1', created = NOW(), modified = NOW()");

		$q = $this->db->query("SELECT * FROM customer WHERE id = '" . (int)$this->customer->getId() . "'")->row();
		$msg = urlencode('Hello, A new Booking  of Outstation has arrived. ' . $q->first_name . " " . $q->last_name . ' and ' . $req->departure_date . ' on zcabs.in.');
		$msg1 = urlencode('Hello, Your booking with zcabs.in confirmed in very short time. Thank you.');
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=8170823370&sms='.$msg.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=' . $q->mobile . '&sms='.$msg1.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);

		return $query;
	}

	function submit_local($id){
		$query = $this->db->query("INSERT INTO outstation SET customer_id = '" . (int)$id . "', _from = '" . $this->db->escape_str($this->input->post('_from')) . "', _to = '" . $this->db->escape_str($this->input->post('_to')) . "', type = '4', status = '1', pool_type = '" . $this->db->escape_str($this->input->post('pool_type')) . "', departure_date = NOW(), created = NOW(), modified = NOW()");

		$q = $this->db->query("SELECT * FROM customer WHERE id = '" . (int)$id . "'")->row();
		$data['customer_id'] = $id;
		$data['order_id'] = $this->db->insert_id();
		$msg1 = urlencode('Hello, Your booking with zcabs.in confirmed in very short time. Thank you.');
		$msg = urlencode('Hello, A new Booking  of Local Trip has arrived. ' . $q->first_name . " " . $q->last_name . ' on zcabs.in.');
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=8170823370&sms='.$msg.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);

		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=' . $q->mobile . '&sms='.$msg1.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);

		return $data;
	}

	function get_packages($id){
		$query = $this->db->query("SELECT * FROM sight WHERE location_id = '" . (int)$id . "' AND status != '3'");
		return $query;
	}

	function get_full_packages($id){
		$data = array();
		$images = array();
		$query = $this->db->query("SELECT * FROM sight WHERE location_id = '" . (int)$id . "' AND status != '3'");
		foreach($query->result() as $query){
			$w = $this->db->query("SELECT * FROM sight_image WHERE sight_id = '" . (int)$query->id . "'");
				foreach($w->result() as $w){
					$images[] = array("image"=>$w->image,"text"=>$w->sort_order);
				}
				$data[] = array("id"=>$query->id,
											"name"=>$query->name,
											"image"=>$query->image,
											"price"=>$query->price,
											"description"=>$query->description,
											"status"=>$query->status,
											"images"=>$images);
		}
		return $data;
	}

	function add_sight($id){
		$query = $this->db->query("INSERT INTO outstation SET customer_id = '" . (int)$id . "', sight_id = '" . $this->db->escape_str($this->input->post('sight_id')) . "', departure_date = '" . date("Y-m-d h:i:s", strtotime($this->input->post('departure_date'))) . "',  passengers = '" . $this->db->escape_str($this->input->post('passengers')) . "', type = '3', status = '1', created = NOW(), modified = NOW()");

		$msg = urlencode('Hello, A new Booking  of Sight Seen has arrived of ' . date("d M, Y", strtotime($this->input->post('departure_date'))) . ' on zcabs.in.');
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=8170823370&sms='.$msg.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);

		return $query;
	}

	function add_sight_razor($id){
		$row = $this->db->query("SELECT * FROM sight WHERE id = '" . (int)$this->input->post('sight_id') . "'")->row();
		$data['price'] = $row->price;
		$query = $this->db->query("INSERT INTO outstation SET order_price = '" . $data['price'] . "', customer_id = '" . (int)$id . "', sight_id = '" . $this->db->escape_str($this->input->post('sight_id')) . "', departure_date = '" . date("Y-m-d h:i:s", strtotime($this->input->post('departure_date'))) . "',  passengers = '" . $this->db->escape_str($this->input->post('passengers')) . "', type = '3', status = '0', created = NOW(), modified = NOW()");
		$data['order_id'] = $this->db->insert_id();
		return $data;
	}

	function confirm_sight_razor($id, $d){
		$query = $this->db->query("UPDATE outstation SET status = '1', transaction_detail = '" . $d . "' WHERE id = '" . (int)$id . "'");
		$row = $this->db->query("SELECT departure_date FROM outstation WHERE id = '" . (int)$id . "'")->row();
		$msg = urlencode('Hello, A new Booking  of Sight Seen has arrived of ' . date("d M, Y", strtotime($row->departure_date)) . ' on zcabs.in.');
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=8170823370&sms='.$msg.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);
		return $query;
	}


	function get_package($id){
		$data = array();
		$images = array();
		$q = $this->db->query("SELECT * FROM sight WHERE id = '" . (int)$id . "' AND status != '3'");
		if($q->num_rows()){
			$qq = $q->row();
		}
		$w = $this->db->query("SELECT * FROM sight_image WHERE sight_id = '" . (int)$id . "'");
			foreach($w->result() as $w){
				$images[] = array("image"=>$w->image,"text"=>$w->sort_order);
			}
			$data = array("id"=>$qq->id,
										"name"=>$qq->name,
										"image"=>$qq->image,
										"price"=>$qq->price,
										"description"=>$qq->description,
										"status"=>$qq->status,
										"images"=>$images);
			return $data;
		}

	function get_trips($id){
		$q = $this->db->query("SELECT role_id FROM customer WHERE id = '" . (int)$id . "'")->row();
		$role_id = $q->role_id;
		if($role_id == '2'){
		$complete = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,IF(type = 3,c.name,o._from) as _from,IF(type = 3,c.name,o._to) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.driver = '" . (int)$id . "' AND o.status IN (3,6,7)");
		$coming = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,IF(type = 3,c.name,o._from) as _from,IF(type = 3,c.name,o._to) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.driver = '" . (int)$id . "' AND o.status IN (1,2)");
		$running = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,IF(type = 3,c.name,o._from) as _from,IF(type = 3,c.name,o._to) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.driver = '" . (int)$id . "' AND o.status IN (4,5)");
		}
		else{
		$complete = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,IF(type = 3,c.name,o._from) as _from,IF(type = 3,c.name,o._to) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.customer_id = '" . (int)$id . "' AND o.status IN (3,6,7)");
		$coming = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,IF(type = 3,c.name,o._from) as _from,IF(type = 3,c.name,o._to) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.customer_id = '" . (int)$id . "' AND o.status IN (1,2)");
		$running = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,IF(type = 3,c.name,o._from) as _from,IF(type = 3,c.name,o._to) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.customer_id = '" . (int)$id . "' AND o.status IN (4,5)");
		}
		$completed = $complete->result_array();
		$upcoming = $coming->result_array();
		$present = $running->result_array();

		$data = array("completed"=>$completed,
					  "upcoming"=>$upcoming,
					  "present"=>$present,
						);
		return $data;
	}

	function get_shared_trip($id){
		$query = $this->db->query("SELECT * FROM out_est WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function get_reserved_trip($id){
		$query = $this->db->query("SELECT * FROM out_reserved WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function add_final($data = array()){

			$query = $this->db->query("INSERT INTO outstation SET pickup_point = '" . $this->db->escape_str($data['pickup_point']) . "', drop_point = '" . $this->db->escape_str($data['drop_point']) . "', vehicle_name = '" . $this->db->escape_str($data['vehicle_name']) . "', customer_id = '" . (int)$this->customer->getId() . "', _to = '" . $this->db->escape_str($data['to']) . "', _from = '" . $this->db->escape_str($data['from']) . "', departure_date = '" . date("Y-m-d H:i:s", strtotime($data['dep_date'])) . "', return_date = '" . date("Y-m-d H:i:s", strtotime($data['return_date'])) . "', passengers = '" . (int)$data['passengers'] . "', type = '" . (int)$data['type'] . "', order_price = '" . (float)$data['price'] . "', status = '1', pool_type = '" . $this->db->escape_str($data['pool_type']) . "', created = NOW()");

		$q = $this->db->query("SELECT * FROM customer WHERE id = '" . (int)$this->customer->getId() . "'")->row();
		$msg = urlencode('Hello, A new Booking  of Outstation has arrived. ' . $q->first_name . " " . $q->last_name . ' and ' . date("d M,Y H:i:s", strtotime($data['dep_date'])) . ' on zcabs.in.');
		$msg1 = urlencode('Hello, Your booking with zcabs.in confirmed in very short time. Thank you.');
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=8170823370&sms='.$msg.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=' . $q->mobile . '&sms='.$msg1.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);

		return $query;
	}

	function add_final_razor($data = array()){

			$query = $this->db->query("INSERT INTO outstation SET pickup_point = '" . $this->db->escape_str($data['pickup_point']) . "', drop_point = '" . $this->db->escape_str($data['drop_point']) . "', vehicle_name = '" . $this->db->escape_str($data['vehicle_name']) . "', customer_id = '" . (int)$this->customer->getId() . "', _to = '" . $this->db->escape_str($data['to']) . "', _from = '" . $this->db->escape_str($data['from']) . "', departure_date = '" . date("Y-m-d H:i:s", strtotime($data['dep_date'])) . "', return_date = '" . date("Y-m-d H:i:s", strtotime($data['return_date'])) . "', passengers = '" . (int)$data['passengers'] . "', type = '" . (int)$data['type'] . "', order_price = '" . (float)$data['price'] . "', status = '0', pool_type = '" . $this->db->escape_str($data['pool_type']) . "', created = NOW()");

		$conf['order_id'] = $this->db->insert_id();
		$conf['price'] = $data['price'];

		return $conf;
	}

	function add_final_confirm($merchant_order_id, $d){
		$explodeId = explode("r",$merchant_order_id);
		$order_id = $explodeId[0];

		$this->db->query("UPDATE outstation SET status = '1', transaction_detail = '" . $d . "' WHERE id = '" . (int)$order_id . "'");
		$o = $this->db->query("SELECT * FROM outstation WHERE id = '" . (int)$order_id . "'")->row();
		if($this->customer->isType() == 3){
			$amountToCut = $this->session->userdata('payment')['walletToCut'] - $this->customer->getCommision($o->order_price);
		} else{
			$amountToCut = $this->session->userdata('payment')['walletToCut'];
		}
		$this->db->query("UPDATE customer SET wallet = wallet - " . $amountToCut . " WHERE id = '" . (int)$this->customer->getId() . "'");
		$q = $this->db->query("SELECT * FROM customer WHERE id = '" . (int)$this->customer->getId() . "'")->row();
		if($o->pool_type == 'Shared'){
			$oedId = $explodeId[1];
			if($oedId != ""){
				$this->db->query("UPDATE out_est_date SET remaining_seats = remaining_seats - " . $o->passengers . " WHERE reduce_id = '" . (int)$oedId . "'");
			}
		}
		$this->session->unset_userdata('payment');
		$msg = urlencode('Hello, A new Booking  of Outstation has arrived. ' . $q->first_name . " " . $q->last_name . ' and ' . date("d M,Y H:i:s", strtotime($o->departure_date)) . ' on zcabs.in.');
		$msg1 = urlencode('Hello, Your booking with zcabs.in confirmed in very short time. Thank you.');
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=8170823370&sms='.$msg.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=' . $q->mobile . '&sms='.$msg1.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);

		return $query;
	}

	function add_final_wallet_confirm($order_id, $oedid){

		$this->db->query("UPDATE outstation SET status = '1' WHERE id = '" . (int)$order_id . "'");
		$o = $this->db->query("SELECT * FROM outstation WHERE id = '" . (int)$order_id . "'")->row();
		$q = $this->db->query("SELECT * FROM customer WHERE id = '" . (int)$this->customer->getId() . "'")->row();
		if($this->customer->isType() == 3){
			$amountToCut = $this->session->userdata('payment')['walletToCut'] - $this->customer->getCommision($o->order_price);
		} else{
			$amountToCut = $this->session->userdata('payment')['walletToCut'];
		}
		$this->db->query("UPDATE customer SET wallet = wallet - " . $amountToCut . " WHERE id = '" . (int)$this->customer->getId() . "'");
		if($o->pool_type == 'Shared'){
			if($oedid != ""){
				$this->db->query("UPDATE out_est_date SET remaining_seats = remaining_seats - " . $o->passengers . " WHERE reduce_id = '" . (int)$oedid . "'");
			}
		}
		$this->session->unset_userdata('payment');
		$msg = urlencode('Hello, A new Booking  of Outstation has arrived. ' . $q->first_name . " " . $q->last_name . ' and ' . date("d M,Y H:i:s", strtotime($o->departure_date)) . ' on zcabs.in.');
		$msg1 = urlencode('Hello, Your booking with zcabs.in confirmed in very short time. Thank you.');
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=8170823370&sms='.$msg.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=' . $q->mobile . '&sms='.$msg1.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);

		return $query;
	}

	function add_final_api($id){

			$query = $this->db->query("INSERT INTO outstation SET pickup_point = '" . $this->db->escape_str($this->input->post('pickup_point')) . "', drop_point = '" . $this->db->escape_str($this->input->post('drop_point')) . "', vehicle_name = '" . $this->db->escape_str($this->input->post('vehicle_name')) . "', customer_id = '" . (int)$id . "', _to = '" . $this->db->escape_str($this->input->post('_to')) . "', _from = '" . $this->db->escape_str($this->input->post('_from')) . "', departure_date = '" . date("Y-m-d H:i:s", strtotime($this->input->post('departure_date'))) . "', return_date = '" . date("Y-m-d H:i:s", strtotime($this->input->post('return_date'))) . "', passengers = '" . (int)$this->input->post('passengers') . "', type = '" . (int)$this->input->post('type') . "', order_price = '" . (float)$this->input->post('price') . "', status = '1', pool_type = '" . $this->db->escape_str($this->input->post('pool_type')) . "', created = NOW()");

		$q = $this->db->query("SELECT * FROM customer WHERE id = '" . (int)$id . "'")->row();
		$msg = urlencode('Hello, A new Booking  of Outstation has arrived. ' . $q->first_name . " " . $q->last_name . ' and ' . date("d M,Y H:i:s", strtotime($this->input->post('departure_date'))) . ' on zcabs.in.');
		$msg1 = urlencode('Hello, Your booking with zcabs.in confirmed in very short time. Thank you.');
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=8170823370&sms='.$msg.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);
		$sms = 'http://103.241.146.71/sendsms.jsp?user=zcabs1&password=ee33f5114dXX&mobiles=' . $q->mobile . '&sms='.$msg1.'&senderid=ZCABSS';
		$response = $this->file_get_contents_curl($sms);

		return $query;
	}

	function get_locality($city){
		$q = $this->db->query("SELECT * FROM localities WHERE city_id = (SELECT id FROM cities WHERE name = '" . $this->db->escape_str($city) . "' LIMIT 1)");
		return $q;
	}

	function get_web_trip(){
		$data = array();
		$query = '';
		if($this->input->post('search_radio') == 'booking_date' AND $this->input->post('booking_from') AND $this->input->post('booking_to')){
				$query = " AND created BETWEEN '" . date("Y-m-d", strtotime($this->input->post('booking_from'))) . "' AND '" . date("Y-m-d", strtotime($this->input->post('booking_to'))) . "'";
		}

		if($this->input->post('search_radio') == 'travel_date' AND $this->input->post('travel_from') AND $this->input->post('travel_to')){
				$query = " AND departure_date BETWEEN '" . date("Y-m-d", strtotime($this->input->post('travel_from'))) . "' AND '" . date("Y-m-d", strtotime($this->input->post('travel_to'))) . "'";
		}

		// if($this->input->post('search_radio') == 'travel_date'){
		//
		// }

		$data['completed'] = $this->db->query("SELECT * FROM outstation WHERE status > 0 AND customer_id = '" . (int)$this->customer->getId() . "' AND CAST(departure_date as DATE) < CAST(NOW() as DATE)".$query)->result_array();
		$data['incoming'] = $this->db->query("SELECT * FROM outstation WHERE status > 0 AND customer_id = '" . (int)$this->customer->getId() . "' AND CAST(departure_date as DATE) >= CAST(NOW() as DATE)".$query)->result_array();
		return $data;
	}

	function get_driver_web_trip(){
		$data = array();
		$query = '';
		if($this->input->post('search_radio') == 'booking_date' AND $this->input->post('booking_from') AND $this->input->post('booking_to')){
				$query = " AND created BETWEEN '" . date("Y-m-d", strtotime($this->input->post('booking_from'))) . "' AND '" . date("Y-m-d", strtotime($this->input->post('booking_to'))) . "'";
		}

		if($this->input->post('search_radio') == 'travel_date' AND $this->input->post('travel_from') AND $this->input->post('travel_to')){
				$query = " AND departure_date BETWEEN '" . date("Y-m-d", strtotime($this->input->post('travel_from'))) . "' AND '" . date("Y-m-d", strtotime($this->input->post('travel_to'))) . "'";
		}

		// if($this->input->post('search_radio') == 'travel_date'){
		//
		// }

		$data['completed'] = $this->db->query("SELECT * FROM outstation WHERE status > 0 AND driver = '" . (int)$this->customer->getId() . "' AND CAST(departure_date as DATE) < CAST(NOW() as DATE)".$query)->result_array();
		$data['incoming'] = $this->db->query("SELECT * FROM outstation WHERE status > 0 AND driver = '" . (int)$this->customer->getId() . "' AND  CAST(departure_date as DATE) >= CAST(NOW() as DATE)".$query)->result_array();
		return $data;
	}


	function change_status($id,$trip_id,$status){
		$query = $this->db->query("UPDATE outstation SET status = '" . (int)$status . "' WHERE id = '" . (int)$trip_id . "' AND (customer_id = '" . (int)$id . "' OR driver = '" . (int)$id . "')");
		return $query;
	}

	function update_out($data){
		$query = $this->db->query("UPDATE outstation SET agent_details = '" . $data . "' WHERE id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}

	function get_outstat($id){
		$query = $this->db->query("SELECT id, agent_details FROM outstation WHERE id = '" . $id . "'");
		return $query;
	}

	function get_full_outstation($id){
		$query = $this->db->query("SELECT o.*, s.name as sight_name FROM outstation o LEFT JOIN sight s ON(o.sight_id = s.id)  WHERE id = '" . (int)$id . "'");
		return $data;
	}

	function outstationtripadd(){
    	$query = $this->db->query("INSERT INTO outstationenq SET uid = '" . $this->db->escape_str($this->input->post('uid')) . "',category = '" . $this->db->escape_str($this->input->post('category')) . "',goingfrom = '" . $this->db->escape_str($this->input->post('goingfrom')) . "',goingto = '" . $this->db->escape_str($this->input->post('goingto')) . "',fare = '" . $this->db->escape_str($this->input->post('fare')) . "',vname = '" . $this->db->escape_str($this->input->post('vname')) . "',datee = '" . date("Y-m-d H:i:s", strtotime($this->input->post('datee'))) . "', aseats = '" . $this->db->escape_str($this->input->post('aseats')) . "',created = NOW()");
    	return $query;
	}

}
