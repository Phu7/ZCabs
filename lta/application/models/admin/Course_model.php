<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Course_model extends CI_Model{
		
		function add(){
			$query = $this->db->query("INSERT INTO course SET name = '" . $this->db->escape_str($this->input->post('name')) . "'");
			return $query;
		}
	
		function edit(){
			$query = $this->db->query("UPDATE course SET name = '" . $this->db->escape_str($this->input->post('name')) . "' WHERE course_id = '" . $this->input->post('id') . "'");			
			return $query;
		}
		
		function delete($ids){
			foreach($ids as $id){
			$query = $this->db->query("DELETE FROM course WHERE course_id IN (". $id .")");
			}
			return true;
		}
		
		function get_course_by_id($id){
			$query = $this->db->query("SELECT * FROM course WHERE course_id = '" . $id . "'");
			return $query;
		}
		
		function get_courses(){
			$query = $this->db->query("SELECT * FROM course");
			return $query;
		}
		
}

