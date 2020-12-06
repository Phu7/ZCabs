<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Course_syllabus_model extends CI_Model{
		
		function add(){
		$con['upload_path']   = './images/'; 
        $con['allowed_types'] = 'gif|jpg|png|jpeg'; 
		$con['maintain_ratio'] = TRUE;
        $con['max_filename'] = '50';
        $con['encrypt_name'] = TRUE;
        
		if($_FILES['input-image']['name']){
			$this->load->library('upload', $con);
		$this->upload->do_upload('input-image');
       $image_da = $this->upload->data();
			$imagef = "images/".$image_da['file_name'];
		}
		else{
			$imagef = "";
		}
			$query = $this->db->query("INSERT INTO course_sylbs SET name = '" . $this->db->escape_str($this->input->post('name')) . "', image = '" . $imagef . "', course_id = '" . $this->input->post('course_id') . "', textdata = '" . $this->db->escape_str($this->input->post('_data')) . "', metatitle = '" . $this->db->escape_str($this->input->post('title')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', seo = '" . $this->input->post('slug') . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "', created = NOW()");
			return $query;
		}
	
		function edit(){
			$con['upload_path']   = './images/'; 
         $con['allowed_types'] = 'gif|jpg|png|jpeg'; 
		  $con['maintain_ratio'] = TRUE;
         $con['max_filename'] = '50';
         $con['encrypt_name'] = TRUE;
        
		if(!empty($_FILES['input-image']['name'])){
			$this->load->library('upload', $con);
		$this->upload->do_upload('input-image');
       $image_da = $this->upload->data();
			$imagef = "images/".$image_da['file_name'];
		}
		else{
			$imagef = $this->input->post('old_input-image');
		}
			$query = $this->db->query("UPDATE course_sylbs SET name = '" . $this->db->escape_str($this->input->post('name')) . "',image = '" . $imagef . "',course_id = '" . $this->input->post('course_id') . "', textdata = '" . $this->db->escape_str($this->input->post('_data')) . "', metatitle = '" . $this->db->escape_str($this->input->post('title')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', seo = '" . $this->input->post('slug') . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "' WHERE course_sylbs_id = '" . $this->input->post('id') . "'");			
			return $query;
		}
		
		function delete($ids){
			foreach($ids as $id){
			$query = $this->db->query("DELETE FROM course_sylbs WHERE course_sylbs_id = '" . $id . "'");
			}
			return true;
		}
		
		function get_course_syllabus_by_id($id){
			$query = $this->db->query("SELECT * FROM course_sylbs WHERE course_sylbs_id = '" . $id . "'");
			return $query;
		}
		
		function get_course_syllabus(){
			$query = $this->db->query("SELECT * FROM course_sylbs cd LEFT JOIN course c ON(cd.course_id = c.course_id)");
			return $query;
		}
		
}

