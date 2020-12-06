<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model{

	function add($image){
		$query = $this->db->query("INSERT INTO category SET name = '" . $this->db->escape_str($this->input->post('name')) . "', slug = '" . $this->db->escape_str($this->input->post('seo')) . "', parent_id = '" . (int)$this->input->post('parent_id') . "', image = '" . $this->db->escape_str($image) . "', description = '" . $this->db->escape_str($this->input->post('description')) . "', metatitle = '" . $this->db->escape_str($this->input->post('metatitle')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', status = '" . (int)$this->input->post('status') . "', created = NOW()");
		return $query;
	}
	
	function edit($image){
		$query = $this->db->query("UPDATE category SET name = '" . $this->db->escape_str($this->input->post('name')) . "', slug = '" . $this->db->escape_str($this->input->post('seo')) . "', parent_id = '" . (int)$this->input->post('parent_id') . "', image = '" . $this->db->escape_str($image) . "', description = '" . $this->db->escape_str($this->input->post('description')) . "', metatitle = '" . $this->db->escape_str($this->input->post('metatitle')) . "', metadescription = '" . $this->db->escape_str($this->input->post('metadescription')) . "', metakeyword = '" . $this->db->escape_str($this->input->post('metakeyword')) . "', status = '" . (int)$this->input->post('status') . "' WHERE id = '" . (int)$this->input->post('id') . "'");
		return $query;
	}
	
	function get_category(){
		$query = $this->db->query("select node.name as node_name, node.id as node_id , up1.name as up1_name, up2.name as up2_name, up3.name as up3_name  from category as node left outer join category as up1 
				on up1.id = node.parent_id left outer join category as up2
				on up2.id = up1.parent_id left outer join category as up3
				on up3.id = up2.parent_id order
				by node_name");
		return $query;
	}
	
	function delete($ids){
		$count = count($ids);
		for($i=0;$i<$count;$i++){
		$this->db->query("DELETE FROM category WHERE id = '" . $ids[$i] . "'");
		}
		return true;
	}
	
	function get_category_by_id($id){
		$query = $this->db->query("SELECT * FROM category WHERE id = '" . (int)$id . "'");
		return $query;
	}
	function get_id($id){
		$query = $this->db->query("select node.name as node_name, node.id as node_id 
     , up1.name as up1_name
     , up2.name as up2_name
     , up3.name as up3_name  from category as node
left outer 
  join category as up1 
    on up1.id = node.parent_id  
left outer 
  join category as up2
    on up2.id = up1.parent_id  
left outer 
  join category as up3
    on up3.id = up2.parent_id
WHERE node.id = '".$id."'
order
    by node_name");
		return $query;
	}
	
}
