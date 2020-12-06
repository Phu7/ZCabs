<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{

	function update($id, $status){
		$query = $this->db->query("UPDATE customer SET status = '" . (int)$status . "' WHERE id = '" . (int)$id . "'");
		return $query;
	}

	function delete($ids){
		$query = $this->db->query("UPDATE customer SET status = '3' WHERE id IN (" . $ids . ")");
	}


	function make_query(){
         	$a = "SELECT * FROM customer WHERE role_id = '1' AND status != '3'";
		   return $a;
		}

		function get_list(){
			$a = "SELECT * FROM customer WHERE role_id = '1' AND status != '3'";
		  if(isset($_POST["search"]["value"])){
				$a .= " AND (first_name LIKE '%".$_POST["search"]["value"]."%' OR email LIKE '%".$_POST["search"]["value"]."%' OR mobile LIKE '%".$_POST["search"]["value"]."%' OR city LIKE '%".$_POST["search"]["value"]."%')";
		   }
		  if(isset($_POST["order"])){
				$a .= " ORDER BY first_name ". $_POST['order']['0']['dir'] ."";
		   }
           else
           {
				$a .= " ORDER BY created DESC";
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
           $this->db->from('customer');
           return $this->db->count_all_results();
      }

}
