<?php
class Webtest_model extends CI_Model{

		function add(){
			$query = $this->db->query("INSERT INTO webtest SET subject_id = '" . (int)$this->input->post('subject_id') . "', paper_id = '" . (int)$this->input->post('paper_id') . "', section_id = '" . (int)$this->input->post('section_id') . "', question = '" . $this->db->escape_str($this->input->post('question')) . "', option1 = '" . $this->db->escape_str($this->input->post('option1')) . "', option2 = '" . $this->db->escape_str($this->input->post('option2')) . "', option3 = '" . $this->db->escape_str($this->input->post('option3')) . "', option4 = '" . $this->db->escape_str($this->input->post('option4')) . "', solution = '" . $this->db->escape_str($this->input->post('solution')) . "', right_option = '" . $this->input->post('right') . "'");
			return $query;
		}

		function edit(){
			$query = $this->db->query("UPDATE webtest SET subject_id = '" . (int)$this->input->post('subject_id') . "', paper_id = '" . (int)$this->input->post('paper_id') . "', section_id = '" . (int)$this->input->post('section_id') . "', question = '" . $this->db->escape_str($this->input->post('question')) . "', option1 = '" . $this->db->escape_str($this->input->post('option1')) . "', option2 = '" . $this->db->escape_str($this->input->post('option2')) . "', option3 = '" . $this->db->escape_str($this->input->post('option3')) . "', option4 = '" . $this->db->escape_str($this->input->post('option4')) . "', solution = '" . $this->db->escape_str($this->input->post('solution')) . "', right_option = '" . $this->input->post('right') . "' WHERE id = '" . (int)$id . "'");
			return $query;
		}

		function get_paper_by_id($id){
			$data = array();
			$query = $this->db->query("SELECT * FROM section WHERE paper_id = '" . (int)$id . "'");
			foreach($query->result() as $q){
				$questions = array();
				$sql = $this->db->query("SELECT * FROM webtest WHERE paper_id = '" . $id . "' AND section_id = '" . (int)$q->section_id . "'");
				foreach($sql->result() as $sql){
					$questions[] = array("id" => $sql->id,
										"question"=> $sql->question);
				}
				$data[] = array("id" => $q->section_id,
								"name" => $q->name,
								"questions" => $questions);
			}
			return $data;
		}

		function get_question_by_id($id){
			$query = $this->db->query("SELECT * FROM webtest WHERE id = '" . (int)$id . "'");
			return $query;
		}

		function get_paper_by_subject($id){
			$query = $this->db->query("SELECT * FROM paper WHERE subject_id = '" . (int)$id . "'");
			return $query;
		}

		function get_section_by_paper($id){
			$query = $this->db->query("SELECT * FROM section WHERE paper_id = '" . (int)$id . "'");
			return $query;
		}

		function delete($id){
			$query = $this->db->query("DELETE FROM webtest WHERE id = '" . (int)$id . "'");
			return $query;
		}

		function get_papers(){
			$query = $this->db->query("SELECT p.*, s.name as subject_name FROM paper p LEFT JOIN subject s ON(p.subject_id = s.subject_id)");
			return $query;
		}

}
