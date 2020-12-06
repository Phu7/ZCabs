<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Customer {
	protected $CI;

	public function __construct() {
		$CI =& get_instance();
	}

	public function login($email, $password, $override = false) {
		 $CI =& get_instance();

		if ($override) {
			$customer_query = $CI->db->query("SELECT * FROM customer WHERE (email = '" . $CI->db->escape_str($email) . "' OR mobile = '" . $CI->db->escape_str($email) . "') AND status = '1'");
		} else {
			$customer_query = $CI->db->query("SELECT * FROM customer WHERE (email = '" . $CI->db->escape_str($email) . "' OR mobile = '" . $CI->db->escape_str($email) . "') AND password = SHA1(CONCAT(token, SHA1(CONCAT(token, SHA1('" . $CI->db->escape_str($password) . "'))))) AND status = '1'");
		}

		if ($customer_query->num_rows()) {
			foreach($customer_query->result() as $row)
			$CI->session->set_userdata('customer_id', $row->id);
			$CI->session->set_userdata('customer_name', $row->first_name." ".$row->last_name);
			$CI->session->set_userdata('type', $row->role_id);

			/*$CI->db->query("UPDATE user SET ip = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE user_id = '" . (int)$this->customer_id . "'");*/

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
			$CI =& get_instance();
		$CI->session->unset_userdata('customer_id');
	}

	public function isLogged(){
		$CI =& get_instance();
		return (bool) $CI->session->userdata('customer_id');
	}

	public function isType(){
		$CI =& get_instance();
		return $CI->session->userdata('type');
	}

	public function getCommision($price){
		$CI =& get_instance();
		$customer_query = $CI->db->query("SELECT rate FROM commision");
		if($customer_query->num_rows()){
			$rate = $customer_query->row()->rate/100;
		} else{
			$rate = 0;
		}

		return $price * $rate;
	}

	public function getWallet(){
		$CI =& get_instance();
		$customer_query = $CI->db->query("SELECT wallet FROM customer WHERE id = '" . (int)$this->getId() . "'");
		if($customer_query->num_rows()){
			return $customer_query->row()->wallet;
		} else{
			return false;
		}

	}


	public function getId(){
		$CI =& get_instance();
		$customer_id = $CI->session->userdata('customer_id');
		if (!empty($customer_id))
		{
			return (int)$customer_id;
		}
		return null;
	}

	public function isUser($username) {
		 $CI =& get_instance();
		$customer_query = $CI->db->query("SELECT * FROM customer WHERE mobile = '" . $CI->db->escape_str($username) . "'");
		if ($customer_query->num_rows()) {
		return true;
		}
		else{
			return false;
		}
	}

	public function getStatus($username) {
		 $CI =& get_instance();
		$customer_query = $CI->db->query("SELECT * FROM customer WHERE mobile = '" . $CI->db->escape_str($username) . "' AND (status = '1' OR status = '2')");
		if ($customer_query->num_rows()) {
			return true;
		}
		else{
			return false;
		}
	}

	public function isArea($slug) {
		 $CI =& get_instance();
		$customer_query = $CI->db->query("SELECT * FROM cities WHERE name = '" . $slug . "' AND status != '3'");
		if ($customer_query->num_rows()) {
		$q = $customer_query->row();
		return $q->id;
		}
		else{
			return false;
		}
	}

	public function isPackage($slug) {
		 $CI =& get_instance();
		$customer_query = $CI->db->query("SELECT * FROM sight WHERE slug = '" . $slug . "' AND status != '3'");
		if ($customer_query->num_rows()) {
			$q = $customer_query->row();
			return $q->id;
		}
		else{
			return false;
		}
	}
}
