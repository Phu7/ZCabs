<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

	public function __construct() {
        parent::__construct();
     $this->load->model('admin/Cms_model');
	 $this->load->library('form_validation');
	}



	public function index(){
		$data['result'] = $this->Cms_model->get_cms();
			if ($this->admin->getInfo()){
				$info = explode('--', $this->admin->getInfo());
				$data['info'] = $info[1];
				$data['info_type'] = $info[0];
			}
			else {
				$data['info'] = '';
				$data['info_type'] = '';
			}
		$this->load->view('admin/cms/cms_list',$data);
	}



	public function add(){
		if($this->input->get('id')){
			$query = $this->Cms_model->get_cms_by_id($this->input->get('id'))->row();
				$data['id'] = $query->page_id;
				$data['name'] = $query->name;
				$data['seo'] = $query->seo;
				$data['data'] = $query->textdata;
				$data['metatitle'] = $query->metatitle;
				$data['metadescription'] = $query->metadescription;
				$data['metakeyword'] = $query->metakeyword;
				$data['breadcrum'] = $query->breadcrum;
				}
		else{
			$data['id'] = "";
			$data['name'] = "";
			$data['data'] = "";
			$data['seo'] = "";
			$data['metatitle'] = "";
			$data['metadescription'] = "";
			$data['breadcrum'] = "";
			$data['metakeyword'] = "";
		}
		$this->load->view('admin/cms/cms_form',$data);
	}

	public function add_cms(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}
		else{
			if($this->input->post('id')){
				$query = $this->Cms_model->edit();
			}
			else{
				$query = $this->Cms_model->add();
			}
			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/cms');
	}


	public function delete(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->Cms_model->delete($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/cms');
	}
}
