<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Combo extends CI_Controller{

	 public function __construct() {
      parent::__construct();
			if($this->admin->isLogged()){
    		$this->load->model('admin/test/Combo_model');
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

			$data['result'] = $this->Combo_model->get_combos();
			$this->load->view('admin/test/combo_list', $data);
	}

	function add_form(){
			if($this->input->get('id')){
			$query = $this->Combo_model->get_combo_by_id($this->input->get('id'));
			foreach($query->result() as $query){
				$data['id'] = $query->id;
				$data['name'] = $query->name;
				$data['price'] = $query->price;
				$data['tests'] = $query->tests;
				$data['status'] = $query->status;
			}
			}
			else{
				$data['id'] = "";
				$data['name'] = "";
				$data['price'] = "";
				$data['tests'] = "";
				$data['status'] = "";
			}
		$this->load->view('admin/test/combo_form', $data);
	}

	function add(){
		$this->form_validation->set_rules('name', 'Subject Name', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}else{
			if($this->input->post('id')){
				$query = $this->Combo_model->edit();
			}
			else{
				$query = $this->Combo_model->add();
			}

		if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/test/combo');
	}

	function delete(){
		if($this->admin->isLogged()){
			$id = implode(",", $this->input->post('checklist'));
			$query = $this->Combo_model->delete($id);

			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
			redirect('admin/test/combo');
	}
		else{
			redirect('admin');
		}
	}

	}
