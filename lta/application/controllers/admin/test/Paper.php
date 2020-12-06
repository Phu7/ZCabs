<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paper extends CI_Controller{

	 public function __construct() {
      parent::__construct();
			if($this->admin->isLogged()){
				$this->load->model('admin/test/Paper_model');
		  	$this->load->model('admin/test/Subject_model');
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

			$data['paper'] = $this->Paper_model->get_papers();
			$this->load->view('admin/test/paper_list', $data);

	}

	function add_form(){
			if($this->input->get('id')){
			$query = $this->Paper_model->get_paper_by_id($this->input->get('id'));
			foreach($query->result() as $query){
				$data['id'] = $query->paper_id;
				$data['name'] = $query->name;
				$data['duration'] = $query->duration;
				$data['subject_id'] = $query->subject_id;
				$data['status'] = $query->status;
				$data['marks'] = $query->marks;
				$data['start_date'] = ($query->start_date) ? date("m/d/Y h:i A", strtotime($query->start_date)):"";
				$data['end_date'] = ($query->end_date) ? date("m/d/Y h:i A", strtotime($query->end_date)):"";
			}
			}
			else{
				$data['id'] = "";
				$data['name'] = "";
				$data['duration'] = "";
				$data['subject_id'] = "";
				$data['marks'] = "";
				$data['start_date'] = "";
				$data['status'] = "";
				$data['end_date'] = "";
			}
		$data['subject'] = $this->Paper_model->get_subjects();
		$this->load->view('admin/test/paper_form', $data);
	}

	function add(){
		$this->form_validation->set_rules('name', 'Paper Name', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}else{
			if($this->input->post('id')){
				$query = $this->Paper_model->edit();
			}
			else{
				$query = $this->Paper_model->add();
			}

		if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/test/paper');
	}

	function delete_paper(){
		$ids = implode(",", $this->input->post("checklist"));
		$query = $this->Paper_model->delete($ids);

			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
			redirect('admin/test/paper');
	}



	function get_paper(){
		if($this->admin->isLogged()){
			$id = $this->input->get('id');
			$data['result'] = $this->Paper_model->getPaper($id);
			$this->load->view("admin/test/get_paper",$data);
		}
		else{
			redirect('admin/test/get_paper');
		}
	}

	function remove_question(){
			$id = $this->input->get('exam_id');
			$paper_id = $this->input->get('id');
			$query = $this->Paper_model->removeQuestion($id);
			redirect('admin/test/paper/get_paper?id='.$paper_id);
	}

	function set_priority(){
			$id = $this->input->post("paper_id");
			$query = $this->Paper_model->setPriority();
			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
			redirect('admin/test/paper/get_paper?id='.$id);
	}

	function activate(){
		$status = $this->input->get('st');
		$id = $this->input->get('id');
		$this->Paper_model->activate($id, $status);
		redirect("admin/test/paper/get_paper?id=".$id);
	}

	function print_offline(){
		$id = $this->input->get('id');
		$data['result'] = $this->Paper_model->getQuestions($id);
		//echo "<pre>";print_r($data);exit();
		$this->load->view("admin/test/print_paper", $data);
	}

	}
