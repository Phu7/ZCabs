<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sight_model extends CI_Model{

	function add(){
		 $con['upload_path']   = './sights_image/';
         $con['allowed_types'] = 'gif|jpg|png|jpeg';
		  $con['maintain_ratio'] = TRUE;
         $con['max_filename'] = '50';
         $con['encrypt_name'] = TRUE;

		if($_FILES['input-image']['name']){
			$this->load->library('upload', $con);
		$this->upload->do_upload('input-image');
       $image_da = $this->upload->data();
			$imagef = "sights_image/".$image_da['file_name'];
		}
		else{
			$imagef = "";
		}
		$this->db->query("INSERT INTO sight SET price = '" . (float)$this->input->post('price') . "', name = '" . $this->db->escape_str($this->input->post('name')) . "', description = '" . $this->db->escape_str($this->input->post('description')) . "', location_id = '" . (int)$this->input->post('location') . "', slug = '" . $this->db->escape_str($this->input->post('slug')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metatitle = '" . $this->db->escape_str($this->input->post('metatitle')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "', image = '" . $this->db->escape_str($imagef) . "', status = '" . (int)$this->input->post('status') . "', created = NOW()");
		$sight_id = $this->db->insert_id();

		  if(!empty($_FILES['sight_image']['name'])){
			$image_count = count($_FILES['sight_image']['name']);
			for($o=0;$o<$image_count;$o++){
		$_FILES['sight_images']['name']= $_FILES['sight_image']['name'][$o];
        $_FILES['sight_images']['type']= $_FILES['sight_image']['type'][$o];
        $_FILES['sight_images']['tmp_name']= $_FILES['sight_image']['tmp_name'][$o];
        $_FILES['sight_images']['error']= $_FILES['sight_image']['error'][$o];
        $_FILES['sight_images']['size']= $_FILES['sight_image']['size'][$o];

        $this->load->library('upload', $con);
		$this->upload->do_upload('sight_images');
       $image_data = $this->upload->data();
			$image = "sights_image/".$image_data['file_name'];
			$sort_order = $this->input->post('sight_image_sort');
				$this->db->query("INSERT INTO sight_image SET sight_id = '" . (int)$sight_id . "', image = '" . $this->db->escape_str($image) . "', sort_order = '" . $sort_order[$o] . "'");
			}
		}




		return true;
	}

	 function edit(){
		$con['upload_path']   = './sights_image/';
         $con['allowed_types'] = 'gif|jpg|png|jpeg';
		  $con['maintain_ratio'] = TRUE;
         $con['max_filename'] = '50';
         $con['encrypt_name'] = TRUE;

		if($_FILES['input-image']['name']){
			$this->load->library('upload', $con);
		$this->upload->do_upload('input-image');
       $image_da = $this->upload->data();
			$imagef = "sights_image/".$image_da['file_name'];
		}
		else{
			$imagef = $this->input->post('o_img');
		}
		$this->db->query("UPDATE sight SET price = '" . (float)$this->input->post('price') . "', name = '" . $this->db->escape_str($this->input->post('name')) . "', description = '" . $this->db->escape_str($this->input->post('description')) . "', location_id = '" . (int)$this->input->post('location') . "', slug = '" . $this->db->escape_str($this->input->post('slug')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', metatitle = '" . $this->db->escape_str($this->input->post('metatitle')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "', image = '" . $this->db->escape_str($imagef) . "', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . $this->input->post('id') . "'");
		$sight_id = $this->input->post('id');


	$this->db->query("DELETE FROM sight_image WHERE sight_id = '" . $sight_id . "'");
		  if(!empty($_FILES['sight_image']['name'])){
			$image_count = count($_FILES['sight_image']['name']);
			for($o=0;$o<$image_count;$o++){
				if(!empty($_FILES['sight_image']['name'][$o])){
		$_FILES['sight_images']['name']= $_FILES['sight_image']['name'][$o];
        $_FILES['sight_images']['type']= $_FILES['sight_image']['type'][$o];
        $_FILES['sight_images']['tmp_name']= $_FILES['sight_image']['tmp_name'][$o];
        $_FILES['sight_images']['error']= $_FILES['sight_image']['error'][$o];
        $_FILES['sight_images']['size']= $_FILES['sight_image']['size'][$o];

        $this->load->library('upload', $con);
		$this->upload->do_upload('sight_images');
       $image_data = $this->upload->data();
			$image = "sights_image/".$image_data['file_name'];
			$sort_order = $this->input->post('sight_image_sort');
		}
		else{
			$old_image = $this->input->post('old_sight_image');
			$image = $old_image[$o];
			$sort_order = $this->input->post('sight_image_sort');
		}
				$this->db->query("INSERT INTO sight_image SET sight_id = '" . (int)$sight_id . "', image = '" . $this->db->escape_str($image) . "', sort_order = '" . $sort_order[$o] . "'");
			}
		}
		return true;
	}

	 function get_sights(){
		$query = $this->db->query("SELECT * FROM sight WHERE status != '3'");
		return $query;
	}

	function delete($id){
		$query = $this->db->query("UPDATE sight SET status = '3' WHERE id IN (" . $id . ")");
		return $query;
	}

	function get_sight_by_id($id){
		$query = $this->db->query("SELECT * FROM sight WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function get_cities(){
		$query = $this->db->query("SELECT * FROM cities");
		return $query;
	}


	function sight_image($d){
			$query = $this->db->query("SELECT * FROM sight_image WHERE sight_id = '" . $d . "'");
			return $query;
		}

}
