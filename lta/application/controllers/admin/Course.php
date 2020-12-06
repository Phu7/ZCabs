<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller{

	 public function __construct() {
        parent::__construct();
    	$this->load->model('admin/Course_model');
		$this->load->library('form_validation');
	}

	function index(){
		if($this->admin->isLogged()){
			$data['course'] = $this->Course_model->get_courses();
			$this->load->view('admin/course/course_list', $data);
		}
		else{
			redirect('admin/home');
		}
	}

	function add_form(){
		if($this->admin->isLogged()){
			if($this->input->get('id')){
			$query = $this->Course_model->get_course_by_id($this->input->get('id'));
			foreach($query->result() as $query){
				$data['id'] = $query->course_id;
				$data['name'] = $query->name;

			}
			}
			else{
				$data['id'] = "";
				$data['name'] = "";
			}
			$this->load->view('admin/course/course_form', $data);
	}
		else{
			redirect('admin');
		}
		}

	function add(){
		if($this->admin->isLogged()){
		$this->form_validation->set_rules('name', 'Course Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}else{
			if($this->input->post('id')){
				$query = $this->Course_model->edit();
			}
			else{
				$query = $this->Course_model->add();
			}

		if($query){
				$this->session->set_flashdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_flashdata('info', "2--Error!!!");
			}
		}
		redirect('admin/course');
		}
		else{
			redirect('admin');
		}
	}

	function delete(){
		if($this->admin->isLogged()){
		$ids = $this->input->post('check_list');
		$query = $this->Course_model->delete($ids);

			if($query){
				$this->session->set_flashdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_flashdata('info', "2--Error!!!");
			}
				redirect('admin/course');
		}
		else{
			redirect('admin');
		}
	}

}
