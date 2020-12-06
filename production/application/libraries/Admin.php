<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin {
	protected $CI;
	private $user_id;
	private $username;

	public function __construct() {
	
	}

	public function login($username, $password) {
		 $CI =& get_instance();
		$user_query = $CI->db->query("SELECT * FROM admin WHERE username = '" . $CI->db->escape_str($username) . "' AND password = md5('" . $CI->db->escape_str($password) . "')");

		if ($user_query->num_rows() == 1) {
			foreach($user_query->result() as $row)
			$CI->session->set_userdata('admin_id', $row->admin_id);
			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		$CI =& get_instance();
		$CI->session->unset_userdata('admin_id');

		$this->user_id = '';
		$this->username = '';
	}

	
		public function isLogged()
	{
	 $CI =& get_instance();
		return (bool) $CI->session->userdata('admin_id');
	}

	/**
	 * logged_in
	 *
	 * @return integer
	 * @author jrmadsen67
	 **/
	public function getId(){ 
		$CI =& get_instance();
		$user_id = $CI->session->userdata('admin_id');
		if (!empty($user_id)){
			return $user_id;
		}
		return null;
	}
	
	public function checkPassword($id, $password){
		 $CI =& get_instance();
		$query = $CI->db->query("SELECT * FROM admin WHERE admin_id = '" . (int)$id . "' AND admin_password = md5('" . $CI->db->escape_str($password) . "')");
		if ($query->num_rows()) {
		return true;
		}
		else{
			return false;
		}
	}
	
	public function getInfo(){
		$CI =& get_instance();
		$info = $CI->session->userdata('info');
		if (!empty($info)){
			return $info;
		}
		else{
		return null;
		}
	}
	
	public function removeInfo(){
		$CI =& get_instance();
		$CI->session->unset_userdata('info');
	}
}