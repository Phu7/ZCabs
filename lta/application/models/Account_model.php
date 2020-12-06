<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Account_model extends CI_Model{

		public function register(){
			$this->load->helper('string');
			$query = $this->db->query("INSERT INTO user SET status = '0', contact1 = '" . $this->db->escape_str($this->input->post('mobile')) . "', user_name = '" . $this->db->escape_str($this->input->post('name')) . "', user_email = '" . $this->db->escape_str($this->input->post('email')) . "', token = '" . $this->db->escape_str($salt = random_string('nozero', 6)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', user_type = '2', created = NOW(), ip = '". $_SERVER['REMOTE_ADDR'] ."'");
			return $this->db->insert_id();
		}

		public function verify($id){
			$query = $this->db->query("UPDATE user SET status = '1' WHERE user_id = '" . (int)$id . "'");
			return $query;
		}

		public function update(){
			$query = "";
			return $query;
		}

		public function get_profile(){
			$query = $this->db->query("SELECT * FROM user WHERE user_id = '" . (int)$this->customer->getId() . "'");
			return $query;
		}

		public function change_password(){
			$this->load->helper('string');
			$query = $this->db->query("UPDATE user SET token = '" . $this->db->escape_str($salt = random_string('nozero', 6)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."' WHERE user_id = '" . (int)$this->customer->getId() . "'");
			return $query;
		}

		public function set_password($id){
			$this->load->helper('string');
			$query = $this->db->query("UPDATE user SET token = '" . $this->db->escape_str($salt = random_string('nozero', 6)) . "', password = '" . $this->db->escape_str(sha1($salt . sha1($salt . sha1($this->input->post('password'))))) . "', ip = '". $_SERVER['REMOTE_ADDR'] ."' WHERE user_id = '" . (int)$id . "'");
			return $query;
		}

		public function get_id_by_mobile(){
			$query = $this->db->query("SELECT id FROM user WHERE contact1 = '" . $this->db->escape_str($this->input->post('mobile')) . "' WHERE status = '1'");
			return $query;
		}

}
