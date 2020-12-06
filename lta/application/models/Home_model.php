<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Home_model extends CI_Model{

		function get_page($slug){
			$query = $this->db->query("SELECT * FROM cms WHERE seo = '" . $slug . "'");
			return $query;
		}

		public function get_block($url){
			$query = $this->db->query("SELECT * FROM block WHERE url = '" . $url . "'");
			return $query;
		}

		function get_testimonials(){
			$query = $this->db->query("SELECT * FROM tbl_testimonial WHERE status = '1'");
			return $query;
		}

		function get_courses(){
			$query = $this->db->query("SELECT * FROM course");
			return $query;
		}

		function get_course_detail($slug){
			$query = $this->db->query("SELECT cd.*, c.name as course_name FROM course_detail cd LEFT JOIN course c ON(cd.course_id = c.course_id) WHERE seo = '" . $slug . "'");
			return $query;
		}

		function get_course_syllabus($slug){
			$query = $this->db->query("SELECT cs.*, c.name as course_name FROM course_sylbs cs LEFT JOIN course c ON(cs.course_id = c.course_id) WHERE seo = '" . $slug . "'");
			return $query;
		}

		function get_rescat(){
			$query = $this->db->query("SELECT * FROM tbl_rescat WHERE status = '1' ORDER BY id DESC");
			return $query;
		}

		function get_result(){
			$query = $this->db->query("SELECT * FROM tbl_result WHERE p_id = '" . $id . "'");
			return $query;
		}

		function get_result_cat($cat){
			$data = array();
			$qw = "SELECT * FROM tbl_rescat WHERE status = '1'";
			if($cat != ''){
				$qw .= " AND title = '" . $cat . "'";
			}
			$qw .= " ORDER BY id DESC LIMIT 1";
			$query = $this->db->query($qw);
				foreach($query->result() as $query){
					$result = array();
					$sql = $this->db->query("SELECT * FROM tbl_result WHERE p_id = '" . $query->id . "'");
						foreach($sql->result() as $sql){
							$result[] = array("id"=>$sql->id,
											  "p_id"=>$sql->p_id,
											  "name"=>$sql->title,
											  "slug"=>$sql->titleurl,
											  "university"=>$sql->university,
											  "roll_number"=>$sql->rollno,
											  "rank"=>$sql->rank,
											  "image"=>$sql->image,
											  "metakeyword"=>$sql->metakeyword,
											  "metadescription"=>$sql->metadescription,
											  "front"=>$sql->front,
											  "status"=>$sql->status
											  );
						}
						$data[] = array("id"=>$query->id,
										"name"=>$query->title,
										"title1"=>$query->title1,
										"metakeyword"=>$query->metakeyword,
										"metadescription"=>$query->metadescription,
										"status"=>$query->status,
										"result"=>$result
										);
				}
			return $data;
		}

		function get_batches(){
			// $data = array();
			// $query = $this->db->query("SELECT * FROM course");
			// foreach($query->result() as $query){
			// 	$batches = array();
			// 		$sql = $this->db->query("SELECT b.*,bt.name as type_name,e.city FROM batches b LEFT JOIN batch_type bt ON(bt.id = b.type_id) LEFT JOIN established_in e ON(e.id = b.established_id) WHERE b.course_id = '" . $query->course_id . "'");
			// 			foreach($sql->result() as $sql){
			// 				$batches[] = array("type_name"=>$sql->type_name,
			// 								   "established_id"=>$sql->established_id,
			// 								   "type_id"=>$sql->type_id,
			// 								   "timing"=>$sql->timing,
			// 								   "batch"=>$sql->batch,
			// 								   "code"=>$sql->code,
			// 								   "duration"=>$sql->duration,
			// 								   "fees"=>$sql->fees,
			// 								   "comment"=>$sql->comment,
			// 								   "status"=>$sql->status,
			// 								   "is_open"=>$sql->is_open,
			// 								   "city"=>$sql->city
			// 								   );
			// 			}
			// 			$data[] = array("course"=>$query->name,
			// 							"batches"=>$batches);
			// }
			// return $data;
		}

		function send_contactus(){
			$query = $this->db->query("INSERT INTO contact SET email = '" . $this->db->escape_str($this->input->post('email')) . "', name = '" . $this->db->escape_str($this->input->post('name')) . "', subject = '" . $this->db->escape_str($this->input->post('subject')) . "', phone = '" . $this->db->escape_str($this->input->post('phone')) . "', description = '" . $this->db->escape_str($this->input->post('message')) . "', is_read = '1'");
			return $query;
		}

}
