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

public function getId(){
	$CI =& get_instance();
	$customer_id = $CI->session->userdata('customer_id');
	if (!empty($customer_id))
	{
		return (int)$customer_id;
	}
	return null;
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
