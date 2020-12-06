<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* {0=>'not_complete',1=>'online',2=>'offline'} */
	class Paper_model extends CI_Model{

		function add(){
			$start_date = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
			$end_date = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
			$query = $this->db->query("INSERT INTO paper SET marks = '" . $this->input->post('marks') . "', name = '" . $this->input->post('name') . "', duration = '" . (int)$this->input->post('duration') . "', subject_id = '" . (int)$this->input->post('subject_id') . "', start_date = '" . $start_date . "', end_date = '" . $end_date . "', status = '0'");
			return $query;
		}

		function edit(){
			$start_date = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
			$end_date = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
			$query = $this->db->query("UPDATE paper SET marks = '" . $this->input->post('marks') . "', name = '" . $this->input->post('name') . "', duration = '" . (int)$this->input->post('duration') . "', subject_id = '" . (int)$this->input->post('subject_id') . "', start_date = '" . $start_date . "', end_date = '" . $end_date . "', status = '" . (int)$this->input->post('status') . "' WHERE paper_id = '" . $this->input->post('id') . "'");
			return $query;
		}

		function delete($id){
			$this->db->query("DELETE FROM paper WHERE paper_id IN (" . $id . ")");
			$this->db->query("DELETE FROM webtest WHERE paper_id IN (" . $id . ")");
			$this->db->query("DELETE FROM section WHERE paper_id IN (" . $id . ")");
			$this->db->query("DELETE FROM test_results WHERE complete_id IN (SELECT id FROM test_completed WHERE paper_id IN (" . $id . "))");
			$this->db->query("DELETE FROM test_completed WHERE paper_id IN (" . $id . ")");
			return true;
		}

		function get_paper_by_id($id){
			$query = $this->db->query("SELECT * FROM paper WHERE paper_id = '" . $id . "'");
			return $query;
		}

		function get_papers(){
			$query = $this->db->query("SELECT p.*,s.name as subject_name FROM paper p LEFT JOIN subject s ON(p.subject_id = s.subject_id)");
			return $query;
		}

		function get_subjects(){
			$query = $this->db->query("SELECT * FROM subject");
			return $query;
		}

		function getPaper($id){
			$data = array();
			$section = array();
			$query = $this->db->query("SELECT * FROM paper WHERE paper_id = '" . $id . "'")->row();
			$q = $this->db->query("SELECT * FROM section WHERE paper_id = '" . $id  . "'");
			foreach($q->result() as $q){
				$question = array();
				$q1 = $this->db->query("SELECT e.exam_id, e.question_id, e.priority, q.ques FROM exam e LEFT JOIN question q ON (e.question_id = q.id) WHERE e.paper_id = '" . $id . "' AND e.section_id = '" . $q->section_id . "' ORDER BY e.priority ASC");
					foreach($q1->result() as $q1){
						$question[] = array("exam_id"=>$q1->exam_id,
											"question_id"=>$q1->question_id,
											"priority"=>$q1->priority,
											"question"=>$q1->ques);
					}
					$section[] = array("id"=>$q->section_id,
										"name"=>$q->name,
										"questions"=>$question);
			}
					$data = array("id"=>$query->paper_id,
								  "name"=>$query->name,
								  "status"=>$query->status,
								  "sections"=>$section
								  );
			return $data;
		}

		function activate($id, $status){
			$query = $this->db->query("UPDATE paper SET status = '" . $status . "' WHERE paper_id = '" . $id . "'");
			return $query;
		}

		function removeQuestion($id){
			$query = $this->db->query("DELETE FROM exam WHERE exam_id = '" . $id . "'");
			return $query;
		}

		function setPriority(){
			$count = count($this->input->post('exam_id'));
			for($i=0;$i<$count;$i++){
				$this->db->query("UPDATE exam SET priority = '" . $this->input->post('priority')[$i] . "' WHERE exam_id = '" . $this->input->post('exam_id')[$i] . "'");
			}
			return true;
		}

		function getQuestions($paper_id){
			$paper = array();
			$sql = $this->db->query("SELECT p.*,s.name as subject_name,e.end_time,e.entry_id FROM paper p LEFT JOIN subject s ON(p.subject_id = s.subject_id) LEFT JOIN entry e ON(e.customer = '" . $this->customer->getId() . "' AND e.paper_id = p.paper_id) WHERE p.paper_id = '" . $paper_id . "'");
				foreach($sql->result() as $sql){
					$section = array();
						$q = $this->db->query("SELECT * FROM section WHERE paper_id = '" . $paper_id . "'");
							foreach($q->result() as $q){
								$question = array();
									$query = $this->db->query("SELECT * FROM exam e LEFT JOIN question q ON(e.question_id = q.id) WHERE e.section_id = '" . $q->section_id . "'");
										foreach($query->result() as $query){

												$question[] = array("subject_id"=>$query->subject_id,
																	"paper_id"=>$query->paper_id,
																	"section_id"=>$query->section_id,
																	"question_id"=>$query->question_id,
																	"question"=>$query->ques,
																	"option1"=>$query->option1,
																	"option2"=>$query->option2,
																	"option3"=>$query->option3,
																	"option4"=>$query->option4
																	);
										}

										$section[] = array("section_id"=>$q->section_id,
															"name"=>$q->name,
															"duration"=>$q->duration,
															"right_mark"=>$q->right_mark,
															"wrong_mark"=>$q->wrong_mark,
															"question"=>$question
															);
							}
							$paper = array("subject_id"=>$sql->subject_id,
											"paper_id"=>$sql->paper_id,
											"subject_name"=>$sql->subject_name,
											"paper_name"=>$sql->name,
											"entry_id"=>$sql->entry_id,
											"end_time"=>$sql->end_time,
											"paper_duration"=>$sql->duration,
											"start_date"=>$sql->start_date,
											"end_date"=>$sql->end_date,
											"section"=>$section);
						}

			return $paper;
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
