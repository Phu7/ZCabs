<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Section_model extends CI_Model{
		
		function add(){
			$query = $this->db->query("INSERT INTO section SET name = '" . $this->input->post('name') . "', paper_id = '" . (int)$this->input->post('paper_id') . "', subject_id = '" . (int)$this->input->post('subject_id') . "', right_mark = '" . $this->input->post('right_mark') . "', wrong_mark = '" . $this->input->post('wrong_mark') . "', duration = '0'");
			return $query;
		}
	
		function edit(){
			$query = $this->db->query("UPDATE section SET name = '" . $this->input->post('name') . "', paper_id = '" . (int)$this->input->post('paper_id') . "', subject_id = '" . (int)$this->input->post('subject_id') . "', right_mark = '" . $this->input->post('right_mark') . "', wrong_mark = '" . $this->input->post('wrong_mark') . "', duration = '0' WHERE section_id = '" . $this->input->post('id') . "'");
			return $query;
		}
		
		function delete($ids){
			$ids = implode(",", $this->input->post('section_id'));
			$query = $this->db->query("DELETE FROM section WHERE section_id IN (". $ids .")");
		}
		
		function get_section_by_id($id){
			$query = $this->db->query("SELECT * FROM section WHERE section_id = '" . $id . "'");
			return $query;
		}
		
		function get_sections(){
			$query = $this->db->query("SELECT s.*,p.name as paper_name,su.name as subject_name FROM section s LEFT JOIN paper p ON(p.paper_id = s.paper_id) LEFT JOIN subject su ON(su.subject_id = p.subject_id)");
			return $query;
		}
		
		function get_paper_by_subject($id){
			$query = $this->db->query("SELECT * FROM paper WHERE subject_id = '" . $id . "'");
			return $query;
		}
		
	/*	
		function make_query(){
         	$a = "SELECT * FROM filter_group WHERE 1 = 1";
		   return $a;
		}
	  
		function get_list(){
			$a = "SELECT * FROM filter_group WHERE 1 = 1";
		  if(isset($_POST["search"]["value"])){
				$a .= " AND name LIKE '%".$_POST["search"]["value"]."%'";
		   }
		  if(isset($_POST["order"])){             
				$a .= " ORDER BY name ". $_POST['order']['0']['dir'] ."";
		   }  
           else  
           {  
				$a .= " ORDER BY filter_group_id DESC";		   
           }		   
           if($_POST["length"] != -1){
				$a .= " LIMIT ".$_POST['start']." ,".$_POST['length']."";
           }        
           $query = $this->db->query($a);  
           return $query->result();  
      }
	  
      function get_filtered_data(){
           $a = $this->make_query(); 
           $query = $this->db->query($a);  
           return $query->num_rows();  
      }
     
      function get_all_data(){
           $this->db->select("*");  
           $this->db->from('filter_group');  
           return $this->db->count_all_results();  
      }
*/
}

