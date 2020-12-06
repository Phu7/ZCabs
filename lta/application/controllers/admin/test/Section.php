<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Section extends CI_Controller{

	 public function __construct() {
        parent::__construct();
			if($this->admin->isLogged()){
				$this->load->model('admin/test/Section_model');
	    	$this->load->model('admin/test/Paper_model');
			  $this->load->library('form_validation');
			}
			else{
				redirect('admin');
			}
	}

	function index(){
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			} else {
				$data['info'] = '';
				$data['info_type'] = '';
			}

			$data['section'] = $this->Section_model->get_sections();
			$this->load->view('admin/test/section_list', $data);
	}

	function add_form(){
			if($this->input->get('id')){
			$query = $this->Section_model->get_section_by_id($this->input->get('id'));
			foreach($query->result() as $query){
				$data['id'] = $query->section_id;
				$data['name'] = $query->name;
				$data['duration'] = $query->duration;
				$data['subject_id'] = $query->subject_id;
				$data['paper_id'] = $query->paper_id;
				$data['right_mark'] = $query->right_mark;
				$data['wrong_mark'] = $query->wrong_mark;
			}
			}
			else{
				$data['id'] = "";
				$data['name'] = "";
				$data['duration'] = "";
				$data['subject_id'] = "";
				$data['paper_id'] = "";
				$data['right_mark'] = "";
				$data['wrong_mark'] = "";
			}
		$data['subject'] = $this->Paper_model->get_subjects();
		$this->load->view('admin/test/section_form', $data);
	}

	function add(){
		$this->form_validation->set_rules('name', 'Paper Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}else{
			if($this->input->post('id')){
				$query = $this->Section_model->edit();
			}
			else{
				$query = $this->Section_model->add();
			}

		if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/test/section');
		}

	function delete_section(){
		$ids = implode(",", $this->input->post("checklist"));
		$query = $this->Section_model->delete($id);

			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
			redirect('admin/test/section');

	}


	function getPaperBySubject(){
		$id = $this->input->post('id');
		$query = $this->Section_model->get_paper_by_subject($id);
		$msg = '<option value="">--Select Paper--</option>';
		if($query->num_rows()){
			foreach($query->result() as $query){
				$msg .= '<option value="'.$query->paper_id.'">'.$query->name.'</option>';
			}
		}
		echo $msg;
	}

}
