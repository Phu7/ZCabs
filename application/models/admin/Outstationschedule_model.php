<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outstationschedule_model extends CI_Model{

  function make_query(){
          $a = "SELECT * FROM outstationenq WHERE 1 = 1";
       return $a;
    }

    function get_list(){
      $a = "SELECT * FROM outstationenq WHERE 1 = 1";
      if(isset($_POST["search"]["value"])){
        $a .= " AND (category LIKE '%".$_POST["search"]["value"]."%' OR goingfrom LIKE '%".$_POST["search"]["value"]."%' OR goingto LIKE '%".$_POST["search"]["value"]."%')";
       }
      if(isset($_POST["order"])){
        $a .= " ORDER BY name ". $_POST['order']['0']['dir'] ."";
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
           $this->db->from('outstationenq');
           return $this->db->count_all_results();
      }

 
}
