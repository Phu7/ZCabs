d<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books_model extends CI_Model{

	function add($image){
		$query = $this->db->query("INSERT INTO book SET amazon = '" . $this->db->escape_str($this->input->post('amazon')) . "', book_name = '" . $this->db->escape_str($this->input->post('name')) . "', titleurl = '" . $this->db->escape_str($this->input->post('titleurl')) . "', book_writer = '" . $this->db->escape_str($this->input->post('writer')) . "', status = '" . (int)$this->input->post('status') . "', created = NOW(), image = '" . $this->db->escape_str($image) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "'");
		return $query;
	}

	function edit($image){
		$query = $this->db->query("UPDATE book SET amazon = '" . $this->db->escape_str($this->input->post('amazon')) . "', book_name = '" . $this->db->escape_str($this->input->post('name')) . "', titleurl = '" . $this->db->escape_str($this->input->post('titleurl')) . "', book_writer = '" . $this->db->escape_str($this->input->post('writer')) . "', status = '" . (int)$this->input->post('status') . "', created = NOW(), image = '" . $this->db->escape_str($image) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "' WHERE book_id = '" . (int)$id . "'");
		return $query;
	}

	function get_books(){
		$query = $this->db->query("SELECT * FROM book");
		return $query;
	}

	function delete($id){
		$query = $this->db->query("DELETE FROM book WHERE book_id IN (' . $id . ')");
		return $query;
	}

	function get_book($id){
		$query = $this->db->query("SELECT * FROM book WHERE book_id = '" . (int)$id . "'");
		return $query;
	}
}
