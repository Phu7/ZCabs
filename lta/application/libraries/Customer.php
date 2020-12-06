<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Customer {
	protected $CI;
	private $user_id;
	private $username;

	public function __construct() {

	}

	public function login($email, $password, $override = false) {
		 $CI =& get_instance();

		if ($override) {
			$customer_query = $CI->db->query("SELECT * FROM user WHERE user_email = '" . $CI->db->escape_str($email) . "' AND status = '1'");
		} else {
			$customer_query = $CI->db->query("SELECT * FROM user WHERE user_email = '" . $CI->db->escape_str($email) . "' AND password = SHA1(CONCAT(token, SHA1(CONCAT(token, SHA1('" . $CI->db->escape_str($password) . "'))))) AND status = '1'");
		}

		if ($customer_query->num_rows()) {
			foreach($customer_query->result() as $row)
			$CI->session->set_userdata('customer_id', $row->user_id);
			$this->customer_id = $row->user_id;
			$this->firstname = $row->user_name;
			$this->email = $row->user_email;

			$CI->db->query("UPDATE user SET ip = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE user_id = '" . (int)$this->customer_id . "'");

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
			$CI =& get_instance();
		$CI->session->unset_userdata('customer_id');
		$this->customer_id = '';
		$this->customer_name = '';
		$this->customer_email = '';
	}

		public function checkPassword($id, $password) {
		 $CI =& get_instance();
		$customer_query = $CI->db->query("SELECT * FROM user WHERE user_id = '" . (int)$id . "' AND password = SHA1(CONCAT(token, SHA1(CONCAT(token, SHA1('" . $CI->db->escape_str($password) . "')))))");
		if ($customer_query->num_rows()) {
		return true;
		}
		else{
			return false;
		}
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

	public function getToken($id){
		$CI =& get_instance();
		$customer_query = $CI->db->query("SELECT * FROM user WHERE user_id = '". (int)$id ."'");
		foreach($customer_query->result() as $row){
			$this->token = $row->token;
		}
		if ($this->token)
		{
			return $this->token;
		}
		else{
		return null;
		}
	}

	public function check_login($id){
		$CI =& get_instance();
		$customer_query = $CI->db->query("SELECT * FROM login WHERE access_id = '". $id ."'");
		if($customer_query->num_rows()){
			return true;
		}
		else{
			return false;
		}
	}


	public function getHomeCategory(){
		 $CI =& get_instance();
		 $data = array();
		$query = $CI->db->query("SELECT * FROM course");
		foreach($query->result() as $query){
			$sql = $CI->db->query("SELECT name, seo FROM course_detail WHERE course_id = '" . $query->course_id . "' AND location_id = '" . $this->getLocation() . "'");
				if($sql->num_rows()){
				foreach($sql->result() as $sql){
					$course_detail_slug = $sql->seo;
					$course_detail_name = $sql->name;
				}
				}else{
					$course_detail_slug = "";
					$course_detail_name = "";
				}
			$sql1 = $CI->db->query("SELECT name, seo FROM course_sylbs WHERE course_id = '" . $query->course_id . "'");
				if($sql1->num_rows()){
				foreach($sql1->result() as $sql1){
					$course_syllabus_slug = $sql1->seo;
					$course_syllabus_name = $sql1->name;
				}
				}
				else{
					$course_syllabus_slug = "";
					$course_syllabus_name = "";
				}


			$data[] = array("course_name"=>$query->name,
							"course_detail_name"=>$course_detail_name,
							"course_syllabus_name"=>$course_syllabus_name,
							"course_detail_slug"=>$course_detail_slug,
							"course_syllabus_slug"=>$course_syllabus_slug,
							);
		}

		return $data;
	}//end getHomeCategory

	public function getMetas($url){
		$CI =& get_instance();
		$q = $CI->db->query("SELECT * FROM metas WHERE url = '" . $url . "'");
		if($q->num_rows()){
			return $q->row();
		}
		else{
			return false;
		}
	}
		//publication start

		public function getPageSlug($page_name){
			$CI =& get_instance();
			$rs = preg_replace(array( '/\(+/', '/\)+/','/\/+/','/\*+/','/\?+/','/\|+/', ), '', $page_name);
			$page_slug = preg_replace('/\s+/', '-', trim($rs));
			$customer_query = $CI->db->query("SELECT * FROM page WHERE page_titleurl = '" . $CI->db->escape_str($page_slug) . "'");
			if(!$customer_query->num_rows()){
			$customer_slug = $page_slug;
			}
			else{
			$customer_slug = $page_slug.'-'.rand();
			}
			return $customer_slug;
		}


		public function getBookIdBySlug($slug){
			$CI =& get_instance();
			$customer_query = $CI->db->query("SELECT * FROM page WHERE page_titleurl = '" . $CI->db->escape_str($slug) . "'");
			foreach($customer_query->result() as $row){
			$this->id = $row->book_id;}
			if (!empty($this->id))
			{
			return $this->id;
			}
			else{
			return null;
			}
		}

		public function getBookIdByBookSlug($slug){
			$CI =& get_instance();
			$customer_query = $CI->db->query("SELECT book_id FROM book WHERE titleurl = '" . $CI->db->escape_str($slug) . "'");
			foreach($customer_query->result() as $row){
			$this->id = $row->book_id;}
			if (!empty($this->id))
			{
			return $this->id;
			}
			else{
			return null;
			}
		}

		public function getTopicIdBySlug($slug){
			$CI =& get_instance();
			$customer_query = $CI->db->query("SELECT * FROM page WHERE page_titleurl = '" . $CI->db->escape_str($slug) . "'");
			foreach($customer_query->result() as $row){
			$this->id = $row->topic_id;
			}
			if (!empty($this->id))
			{
			return $this->id;
			}
			else{
			return null;
			}
		}

		public function getPageNo($page){
			$CI =& get_instance();
			$customer_query = $CI->db->query("SELECT * FROM page WHERE page_titleurl = '" . $page . "'");
			foreach($customer_query->result() as $row){
			$this->nu = $row->page_number;
			}
			if (!empty($this->nu))
			{
			return $this->nu;
			}
			else{
			return null;
			}
		}

		public function getNextPage($id, $pn){
			$CI =& get_instance();
			$customer_query = $CI->db->query("SELECT * FROM page WHERE book_id = '" . (int)$id . "' AND page_number > '" . (float)$pn . "' ORDER BY page_number ASC LIMIT 1");
			foreach($customer_query->result() as $row){
			$this->page = $row->page_titleurl;
			}
			if (!empty($this->page))
			{
			return $this->page;
			}
			else{
			return null;
			}
		}

		public function getPrePage($id, $pn){
			$CI =& get_instance();
			$customer_query = $CI->db->query("SELECT * FROM page WHERE book_id = '" . (int)$id . "' AND page_number < '" . $pn . "' ORDER BY page_number DESC LIMIT 1");
			foreach($customer_query->result() as $row){
			$this->page = $row->page_titleurl;
			}
			if (!empty($this->page))
			{
			return $this->page;
			}
			else{
			return null;
			}
		}

		public function getTopicName($topic_id){
			$CI =& get_instance();
			$customer_query = $CI->db->query("SELECT * FROM topic WHERE topic_id = '" . (int)$topic_id . "'");
			foreach($customer_query->result() as $row){
			$this->topic = $row->topicname;
			}
			if (!empty($this->topic))
			{
			return $this->topic;
			}
			else{
			return null;
			}
		}


		public function getTopicIdByBook($id){
			$CI =& get_instance();
			$customer_query = $CI->db->query("SELECT topic_id FROM topic WHERE book_id = '" . (int)$id . "' ORDER BY topic_id ASC LIMIT 1");
			foreach($customer_query->result() as $row){
			$this->id = $row->topic_id;
			}
			if (!empty($this->id))
			{
			return $this->id;
			}
			else{
			return null;
			}
		}

		public function getTopicIdByTopicslug($topic_slug){
			$CI =& get_instance();
			$customer_query = $CI->db->query("SELECT topic_id FROM topic WHERE titleurl = '" . $CI->db->escape_str($topic_slug) . "'");
			foreach($customer_query->result() as $row){
			$this->id = $row->topic_id;}
			if (!empty($this->id))
			{
			return $this->id;
			}
			else{
			return null;
			}
		}

		public function getPageByTopic($id){
			$CI =& get_instance();
			$customer_query = $CI->db->query("SELECT * FROM page WHERE topic_id = '" . (int)$id . "' ORDER BY page_number ASC  LIMIT 1");
			foreach($customer_query->result() as $row){
			$this->slug = $row->page_titleurl;}
			if (!empty($this->slug))
			{
			return $this->slug;
			}
			else{
			return null;
			}
		}

	//end publication start



	public function getLocation(){
		$CI =& get_instance();
		$location = ($CI->session->userdata("location")) ? $CI->session->userdata("location"):1;
		return $location;
	}

	public function getLocations(){
		$CI =& get_instance();
		$query = $CI->db->query("SELECT name FROM locations WHERE status = '1'");
		return $query;
	}

	public function getContactUs(){
		$CI =& get_instance();
		$query = $CI->db->query("SELECT * FROM contacts WHERE location = '" . $this->getLocation() . "'")->row();
		return $query->slug;
	}



}
