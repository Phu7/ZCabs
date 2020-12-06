<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webtest extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('admin/test/Webtest_model');
			$this->load->model('admin/test/Paper_model');
			$this->load->model('admin/test/Subject_model');
			$this->load->library("form_validation");
		}

	public function index(){
		$data['result'] = $this->Webtest_model->get_papers();
		$this->load->view('admin/webtest/webtest_list',$data);
	}

	public function add(){



			$id = $this->input->get('id');

			$query = $this->Webtest_model->get_question_by_id($id);

			if($query->num_rows()){
				$q = $query->row();
				$data['id'] = $q->id;
				$data['combo_id'] = $q->combo_id;
				$data['paper_id'] = $q->paper_id;
				$data['section_id'] = $q->section_id;
				$data['question'] = $q->question;
				$data['solution'] = $q->solution;
				$data['right'] = $q->right_option;
				$data['option1'] = $q->option1;
				$data['option2'] = $q->option2;
				$data['option3'] = $q->option3;
				$data['option4'] = $q->option4;
			} else{
				$data['id'] = "";
				$data['combo_id'] = "";
				$data['paper_id'] = "";
				$data['section_id'] = "";
				$data['question'] = "";
				$data['solution'] = "";
				$data['right'] = "";
				$data['option1'] = "";
				$data['option2'] = "";
				$data['option3'] = "";
				$data['option4'] = "";
			}

			$data['combos'] = $this->Combo_model->get_subjects();

			$this->load->view('admin/webtest/webtest_form',$data);
		}



	public function edit(){

		$this->form_validation->set_rules('question', 'question', 'trim|required');

		if($this->form_validation->run()==FALSE){

			 $this->session->set_userdata('info', "2--".validation_errors());

		}

		else{

			if($this->input->post('id')){

				$query = $this->Webtest_model->edit();

			}

			else{



				$query = $this->Webtest_model->add();

			}

			if($query){

				$this->session->set_userdata('info', "1--Successfully done");

			}

			else{

				$this->session->set_userdata('info', "2--Error!!!");

			}

		}

		redirect('admin/test/webtest/add');

	}



	public function delete(){

		if($this->admin->isLogged()){

		$query = $this->Webtest_model->delete($this->input->get('id'));

		if($query){

			$this->session->set_userdata('info', "1--Successfully deleted");

		}

		else{

			$this->session->set_userdata('info', "2--Some category has product or subcategory");

		}

		}

			else{

			redirect('admin/test/webtest');

		}

	}


	public function getPapers(){
		$query = $this->Webtest_model->get_paper_by_subject($this->input->post('id'));
		$data = '<option value="">Choose Paper</option>';
		foreach($query->result() as $q){
			$data .= '<option value="' . $q->paper_id . '">' . $q->name . '</option>';
		}
		echo $data;
	}

	public function getSections(){
		$query = $this->Webtest_model->get_section_by_paper($this->input->post('id'));
		$data = '<option value="">Choose Section</option>';
		foreach($query->result() as $q){
			$data .= '<option value="' . $q->section_id . '">' . $q->name . '</option>';
		}
		echo $data;
	}


	public function detail(){
		$id = $this->input->get('id');
		$data['result'] = $this->Webtest_model->get_paper_by_id($id);
		$this->load->view("admin/webtest/detail", $data);
	}
}
