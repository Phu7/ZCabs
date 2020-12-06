<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Block extends CI_Controller{

	 public function __construct() {
        parent::__construct();
    	$this->load->model('admin/Block_model');
		$this->load->library('form_validation');
	}

	function index(){
		if($this->admin->isLogged()){
			$data['block'] = $this->Block_model->get_blocks();
			$this->load->view('admin/block/block_list', $data);
		}
		else{
			redirect('admin/home');
		}
	}

	function add_form(){
		if($this->admin->isLogged()){
			if($this->input->get('id')){
			$query = $this->Block_model->get_block_by_id($this->input->get('id'))->row();
				$data['id'] = $query->id;
				$data['name'] = $query->name;
				$data['title'] = $query->title;
				$data['textdata'] = $query->textdata;
			}
			else{
				$data['id'] = "";
				$data['name'] = "";
				$data['title'] = "";
				$data['textdata'] = "";
			}
			$this->load->view('admin/block/block_form', $data);
	}
		else{
			redirect('admin/home');
		}
		}

	function add(){
		if($this->admin->isLogged()){
		$this->form_validation->set_rules('name', 'Block Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
		$this->session->set_userdata('info', "2--".validation_errors());
		}else{
			if($this->input->post('id')){
				$query = $this->Block_model->edit();
			}
			else{
				$query = $this->Block_model->add();
			}

		if($query){
				$this->session->set_flashdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_flashdata('info', "2--Error!!!");
			}
		}
		redirect('admin/block');
		}
		else{
			redirect('admin/home');
		}
	}

	function delete(){
		if($this->admin->isLogged()){
		$ids = $this->input->post('check_list');
		$query = $this->Block_model->delete($ids);

			if($query){
				$this->session->set_flashdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_flashdata('info', "2--Error!!!");
			}
				redirect('admin/block');
		}
		else{
			redirect('admin/home');
		}
	}


}
