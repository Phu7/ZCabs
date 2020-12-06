<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topics_model extends CI_Model{

	function add(){
		$query = $this->db->query("INSERT INTO topic SET book_id = '" . $this->db->escape_str($this->input->post('book_id')) . "', titleurl = '" . $this->db->escape_str($this->input->post('titleurl')) . "', topicname = '" . $this->db->escape_str($this->input->post('topicname')) . "', status = '" . (int)$this->input->post('status') . "', created = NOW(), metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "'");
		return $query;
	}

	function edit(){
		$query = $this->db->query("UPDATE topic SET book_id = '" . $this->db->escape_str($this->input->post('book_id')) . "', titleurl = '" . $this->db->escape_str($this->input->post('titleurl')) . "', topicname = '" . $this->db->escape_str($this->input->post('topicname')) . "', status = '" . (int)$this->input->post('status') . "', created = NOW(), metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "' WHERE topic_id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}

	function get_topics(){
		$query = $this->db->query("SELECT t.topic_id, t.topicname, t.status, b.book_name FROM topic t LEFT JOIN book b ON(t.book_id = b.book_id)");
		return $query;
	}

	function delete($id){
		$query = $this->db->query("DELETE FROM topic WHERE topic_id IN (" . $id . ")");
		return $query;
	}

	function get_topic($id){
		$query = $this->db->query("SELECT * FROM topic WHERE topic_id = '" . (int)$id . "'");
		return $query;
	}

	function get_topic_by_book($id){
		$query = $this->db->query("SELECT * FROM topic WHERE book_id = '" . (int)$id . "'");
		return $query;
	}

}
