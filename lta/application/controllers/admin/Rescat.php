<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rescat extends CI_Controller{

	 public function __construct() {
        parent::__construct();
    	$this->load->model('admin/Rescat_model');
		$this->load->library('form_validation');
	}

	function index(){
		if($this->admin->isLogged()){
			$data['result'] = $this->Rescat_model->get_rescats();
			$this->load->view('admin/rescat/rescat_list', $data);
		}
		else{
			redirect('admin/home');
		}
	}

	function add_form(){
		if($this->admin->isLogged()){
			if($this->input->get('id')){
			$query = $this->Rescat_model->get_rescat($this->input->get('id'))->row();
			$data['id'] = $query->id;
			$data['title'] = $query->title;
			$data['title1'] = $query->title1;
			$data['titleurl'] = $query->titleurl;
			$data['status'] = $query->status;
			$data['metakeyword'] = $query->metakeyword;
			$data['metadescription'] = $query->metadescription;
			}
			else{
				$data['id'] = "";
				$data['title'] = "";
				$data['title1'] = "";
				$data['titleurl'] = "";
				$data['status'] = "";
				$data['metakeyword'] = "";
				$data['metadescription'] = "";
			}
			$this->load->view('admin/rescat/rescat_form', $data);
		}
		else{
			redirect('admin/home');
		}
		}

	function add(){
		if($this->admin->isLogged()){
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		if($this->form_validation->run()==FALSE){
		$this->session->set_userdata('info', "2--".validation_errors());
		}else{
			if($this->input->post('id')){
				$query = $this->Rescat_model->edit();
			}
			else{
				$query = $this->Rescat_model->add();
			}

		if($query){
				$this->session->set_flashdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_flashdata('info', "2--Error!!!");
			}
		}
		redirect('admin/rescat');
		}
		else{
			redirect('admin/home');
		}
	}

	function delete(){
		if($this->admin->isLogged()){
		$ids = $this->input->post('check_list');
		$query = $this->Rescat_model->delete($ids);

			if($query){
				$this->session->set_flashdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_flashdata('info', "2--Error!!!");
			}
				redirect('admin/rescat');
		}
		else{
			redirect('admin/home');
		}
	}


}
