<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_syllabus extends CI_Controller{

	 public function __construct() {
        parent::__construct();
    	$this->load->model('admin/Course_syllabus_model');
		$this->load->library('form_validation');
	}

	function index(){
		if($this->admin->isLogged()){
			$data['syllabus'] = $this->Course_syllabus_model->get_course_syllabus();
			$this->load->view('admin/course_syllabus/course_list', $data);
		}
		else{
			redirect('admin/home');
		}
	}

	function add_form(){
		if($this->admin->isLogged()){
			$this->load->model('admin/Course_model');
			if($this->input->get('id')){
			$query = $this->Course_syllabus_model->get_course_syllabus_by_id($this->input->get('id'));
			foreach($query->result() as $query){
				$data['id'] = $query->course_sylbs_id;
				$data['course_id'] = $query->course_id;
				$data['image'] = $query->image;
				$data['name'] = $query->name;
				$data['title'] = $query->metatitle;
				$data['metakeyword'] = $query->metakeyword;
				$data['metadescription'] = $query->metadescription;
				$data['description'] = $query->textdata;
				$data['slug'] = $query->seo;
			}
			}
			else{
				$data['id'] = "";
				$data['course_id'] = "";
				$data['image'] = "";
				$data['name'] = "";
				$data['title'] = "";
				$data['metakeyword'] = "";
				$data['metadescription'] = "";
				$data['description'] = "";
				$data['slug'] = "";
			}
			$data['course'] = $this->Course_model->get_courses();
			$this->load->view('admin/course_syllabus/course_form', $data);
	}
		else{
			redirect('admin/home');
		}
		}

	function add(){
		if($this->admin->isLogged()){
		$this->form_validation->set_rules('course_id', 'Course Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
		$this->session->set_userdata('info', "2--".validation_errors());
		}else{
			if($this->input->post('id')){
				$query = $this->Course_syllabus_model->edit();
			}
			else{
				$query = $this->Course_syllabus_model->add();
			}

		if($query){
				$this->session->set_flashdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_flashdata('info', "2--Error!!!");
			}
		}
		redirect('admin/course_syllabus');
		}
		else{
			redirect('admin/home');
		}
	}

	function delete(){
		if($this->admin->isLogged()){
		$ids = $this->input->post('check_list');
		$query = $this->Course_syllabus_model->delete($ids);

			if($query){
				$this->session->set_flashdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_flashdata('info', "2--Error!!!");
			}
				redirect('admin/course_syllabus');
		}
		else{
			redirect('admin/home');
		}
	}


}
