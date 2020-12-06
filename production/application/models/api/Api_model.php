<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model{

	function get_customer($id){
		$query = $this->db->query("SELECT c.id,c.first_name,c.last_name,c.email,c.mobile,c.address,c.city,c.state,c.country,c.pincode,c.gender,c.dob,c.dp,c.status,l.access_id FROM customer c LEFT JOIN login l ON (c.id = l.customer_id) WHERE c.id = '" . (int)$id . "' AND c.status = '1'");
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

	function add_customer(){
		$this->load->helper('string');
		$this->db->query("INSERT INTO customer SET status = '0', first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', created = NOW(), modified = NOW(), mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."'");
		$customer_id = $this->db->insert_id();
		$this->db->query("INSERT INTO login SET customer_id = '" . (int)$customer_id . "', device_token = '" . $this->db->escape_str($this->input->post('device_token')) . "', device_type = '" . $this->db->escape_str($this->input->post('device_type')) . "', device_os = '" . $this->db->escape_str($this->input->post('device_os')) . "', login_time = NOW(), access_id = '" . $this->db->escape_str($salt = random_string('alnum', 10)) . "'");
		return $customer_id;
	}

	function user_verified($id){
		$query = $this->db->query("UPDATE customer SET status = '1' WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function edit_customer($dp, $id){
		$query = $this->db->query("UPDATE customer SET first_name = '" . $this->db->escape_str($this->input->post('first_name')) . "', last_name = '" . $this->db->escape_str($this->input->post('last_name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', address = '" . $this->db->escape_str($this->input->post('address')) . "', city = '" . $this->db->escape_str($this->input->post('city')) . "', pincode = '" . $this->db->escape_str($this->input->post('pincode')) . "', gender = '" . $this->db->escape_str($this->input->post('gender')) . "', state = '" . $this->db->escape_str($this->input->post('state')) . "', country = '" . $this->db->escape_str($this->input->post('country')) . "', dob = '" . $this->input->post('dob') . "', dp = '" . $dp . "',  modified = NOW(), ip = '". $_SERVER['REMOTE_ADDR'] ."' WHERE id = '" . (int)$id . "'");
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

	function update_password($id){
		$this->load->helper('string');
		$query = $this->db->query("UPDATE customer SET token = '" . $this->db->escape_str($salt = random_string('alnum', 20)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('new_password'))))) . "' WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function send_contact(){
		$query = $this->db->query("INSERT INTO contact_us SET mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', name = '" . $this->db->escape_str($this->input->post('name')) . "', message = '" . $this->db->escape_str($this->input->post('message')) . "', subject = '" . $this->db->escape_str($this->input->post('subject')) . "', is_replied = '2', created = NOW(), modified = NOW()");
		return $query;
	}

	function get_cms($slug){
		$query = $this->db->query("SELECT * FROM cms WHERE slug = '" . $this->db->escape_str($slug) . "'");
		return $query;
	}

	function get_location(){
		$query = $this->db->query("SELECT id,name FROM cities WHERE status = '1'");
		return $query;
	}

	function add_outstation($id){
		$query = $this->db->query("INSERT INTO outstation SET customer_id = '" . (int)$id . "', _from = '" . $this->db->escape_str($this->input->post('_form')) . "', _to = '" . $this->db->escape_str($this->input->post('_to')) . "', departure_date = '" . date("Y-m-d h:i:s", strtotime($this->input->post('departure_date'))) . "', return_date = '" . date("Y-m-d h:i:s", strtotime($this->input->post('return_date'))) . "',  passengers = '" . $this->db->escape_str($this->input->post('passengers')) . "', type = '" . (int)$this->input->post('type') . "', pool_type = '" . $this->db->escape_str($this->input->post('pool_type')) . "', status = '1', created = NOW(), modified = NOW()");
		return $query;
	}

	function save_order($req){
		$query = $this->db->query("INSERT INTO outstation SET customer_id = '" . (int)$this->customer->getId() . "', _from = '" . $this->db->escape_str($req->_from) . "', _to = '" . $this->db->escape_str($req->_to) . "', departure_date = '" . date("Y-m-d h:i:s", strtotime($req->departure_date)) . "', return_date = '" . date("Y-m-d h:i:s", strtotime($req->return_date)) . "',  passengers = '" . $this->db->escape_str($req->passengers) . "', type = '" . (int)$req->type . "', pool_type = '" . $this->db->escape_str($req->pull_type) . "', status = '1', created = NOW(), modified = NOW()");
		return $query;
	}

	function submit_local($id){
		$query = $this->db->query("INSERT INTO outstation SET customer_id = '" . (int)$id . "', _from = '" . $this->db->escape_str($this->input->post('_from')) . "', _to = '" . $this->db->escape_str($this->input->post('_to')) . "', type = '4', status = '1', pool_type = '" . $this->db->escape_str($this->input->post('pool_type')) . "', created = NOW(), modified = NOW()");
		return $query;
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
		$complete = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,(CASE WHEN type = 3 THEN c.name ELSE o._from END) as _from,(CASE WHEN type = 3 THEN c.name ELSE o._to END) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.driver = '" . (int)$id . "' AND o.status IN (3,6,7)");
		$coming = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,(CASE WHEN type = 3 THEN c.name ELSE o._from END) as _from,(CASE WHEN type = 3 THEN c.name ELSE o._to END) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.driver = '" . (int)$id . "' AND o.status IN (1,2)");
		$running = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,(CASE WHEN type = 3 THEN c.name ELSE o._from END) as _from,(CASE WHEN type = 3 THEN c.name ELSE o._to END) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.driver = '" . (int)$id . "' AND o.status IN (4,5)");
		}
		else{
		$complete = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,(CASE WHEN type = 3 THEN c.name ELSE o._from END) as _from,(CASE WHEN type = 3 THEN c.name ELSE o._to END) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.customer_id = '" . (int)$id . "' AND o.status IN (3,6,7)");
		$coming = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,(CASE WHEN type = 3 THEN c.name ELSE o._from END) as _from,(CASE WHEN type = 3 THEN c.name ELSE o._to END) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.customer_id = '" . (int)$id . "' AND o.status IN (1,2)");
		$running = $this->db->query("SELECT o.id,o.customer_id,o.driver as driver_id,cus.first_name as customer_name,cu.vehicle_number,(CASE WHEN type = 3 THEN c.name ELSE o._from END) as _from,(CASE WHEN type = 3 THEN c.name ELSE o._to END) as _to,o.departure_date,o.return_date,o.passengers,o.pool_type,o.type,cu.first_name as driver_name,o.status,s.name as sight_name FROM outstation o LEFT JOIN sight s ON(s.id = o.sight_id) LEFT JOIN cities c ON(c.id = s.location_id) LEFT JOIN customer cu ON(cu.id = o.driver) LEFT JOIN customer cus ON(cus.id = o.customer_id) WHERE o.customer_id = '" . (int)$id . "' AND o.status IN (4,5)");
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

	function change_status($id,$trip_id,$status){
		$query = $this->db->query("UPDATE outstation SET status = '" . (int)$status . "' WHERE id = '" . (int)$trip_id . "' AND (customer_id = '" . (int)$id . "' OR driver = '" . (int)$id . "')");
		return $query;
	}
}
