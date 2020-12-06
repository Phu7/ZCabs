<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_model extends CI_Model{

	function add($image){
		$query = $this->db->query("INSERT INTO page SET book_id = '" . $this->db->escape_str($this->input->post('book_id')) . "', topic_id = '" . $this->db->escape_str($this->input->post('topic_id')) . "', page_titleurl = '" . $this->db->escape_str($this->input->post('titleurl')) . "', page_title = '" . $this->db->escape_str($this->input->post('pagename')) . "', page_data = '" . $this->db->escape_str($this->input->post('pagedata')) . "', page_number = '" . $this->db->escape_str($this->input->post('pageno')) . "', status = '" . (int)$this->input->post('status') . "', created = NOW(), metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "'");
		return $query;
	}

	function edit($image){
		$query = $this->db->query("UPDATE page SET book_id = '" . $this->db->escape_str($this->input->post('book_id')) . "', topic_id = '" . $this->db->escape_str($this->input->post('topic_id')) . "', page_titleurl = '" . $this->db->escape_str($this->input->post('titleurl')) . "', page_title = '" . $this->db->escape_str($this->input->post('pagename')) . "', page_data = '" . $this->db->escape_str($this->input->post('pagedata')) . "', page_number = '" . $this->db->escape_str($this->input->post('pageno')) . "', status = '" . (int)$this->input->post('status') . "', created = NOW(), metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "' WHERE page_id = '" . (int)$this->input->post('page_id') . "'");
		return $query;
	}

	function get_pages(){
		$query = $this->db->query("SELECT p.page_title, p.page_id, p.status, b.book_name, t.topicname FROM page p LEFT JOIN book b ON(b.book_id = p.book_id) LEFT JOIN topic t ON(t.topic_id = p.topic_id)");
		return $query;
	}

	function delete($id){
		$query = $this->db->query("DELETE FROM page WHERE page_id IN (" . $id . ")");
		return $query;
	}

	function get_page($id){
		$query = $this->db->query("SELECT * FROM page WHERE page_id = '" . (int)$id . "'");
		return $query;
	}

}
