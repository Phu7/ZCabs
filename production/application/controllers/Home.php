<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('api/Api_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['locations'] = $this->Api_model->get_location();
		$this->load->view("front/home",$data);
	}

	public function cms(){
		$slug = $this->uri->segment(1);
		$result = $this->Api_model->get_cms($slug);
		if($result->num_rows()){
		$data['result'] = $result->row();
		$this->load->view("front/cms",$data);
		}
		else{
		redirect("/");
		}
	}

	public function sight_areas(){
		$data['result'] = $this->Api_model->get_location();
		$this->load->view("front/areas",$data);
	}

	public function sight_area(){
		$slug = $this->uri->segment(2);
		$id = $this->customer->isArea($slug);
		if($id){
		$data['result'] = $this->Api_model->get_packages($id);
		$this->load->view("front/packages",$data);
		}
		else{
			redirect("/");
		}
	}

	public function package_detail(){
		$id = $this->input->post('id');
		if($id){
		$data['result'] = $this->Api_model->get_package($id);
		$this->load->view("front/package",$data);
		}
		else{
			echo "No page Found";
		}
	}

	public function package_detail_reserve(){
		$id = $this->input->post('id');
		if($id){
		$data['result'] = $this->Api_model->get_package($id);
		$this->load->view("front/package_reserve",$data);
		}
		else{
			echo "No page Found";
		}
	}

	public function contact_us(){
		$this->load->view("front/contact_us");
	}

	public function submit_contact_us(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Name', 'trim|valid_email');
		$this->form_validation->set_rules('message', 'Name', 'trim|required');
		$this->form_validation->set_rules('subject', 'Name', 'trim|required');


		if($this->form_validation->run()==FALSE){
			 $data['success'] = '0';
			$data['message'] = validation_errors();
		}
		else{
		$query = $this->Api_model->send_contact();
		if($query){
			$data['success'] = '1';
			$data['message'] = "Your Query submitted successfully. We will catch you as soon as possible.";
		}
		else{
			$data['success'] = '0';
			$data['message'] = "Some error Occures. Please Inform us.";
		}
		}
		echo json_encode($data);
	}

	public function submit_outstation(){
		$this->form_validation->set_rules('_to', 'Name', 'trim|required');
		$this->form_validation->set_rules('_from', 'Name', 'trim|required');
		$this->form_validation->set_rules('departure_date', 'Name', 'trim|required');
		$this->form_validation->set_rules('return_date', 'Name', 'trim|required');
		$this->form_validation->set_rules('passengers', 'Name', 'trim|required');


		if($this->form_validation->run()==FALSE){
			$data['success'] = '0';
		 $data['message'] =  validation_errors();
		}
		else{
			$id = $this->customer->getId();
			if($id){
		$query = $this->Api_model->add_outstation($id);
		if($query){
			$data['success'] = '1';
			$data['message'] = "Your Query submitted successfully. We will catch you as soon as possible.";
		}
		else{
			$data['success'] = '0';
			$data['message'] = "Some error Occures. Please Inform us.";
		}
		}
		else{
			$data['success'] = '2';
			$data['message'] = 'Login To Submit Request.';
			$data['code_string'] = array("_to"=>$this->input->post("_to"),
																	 "_from"=>$this->input->post("_from"),
																	 "departure_date"=>$this->input->post("departure_date"),
																	 "return_date"=>$this->input->post("return_date"),
																	 "passengers"=>$this->input->post("passengers"),
																	 "type"=>$this->input->post("type"),
																	 "pull_type"=>$this->input->post("pull_type"),
																	);
		}
		}

		echo json_encode($data);
	}

	public function submit_local(){
		$this->form_validation->set_rules('_to', 'To', 'trim|required');
		$this->form_validation->set_rules('_from', 'From', 'trim|required');


		if($this->form_validation->run()==FALSE){
			$data['success'] = '2';
		 $data['message'] = validation_errors();
		}
		else{
			$id = $this->customer->getId();
			if($id){
				$query = $this->Api_model->submit_local($id);
				if($query){
					$data['success'] = '1';
					$data['message'] = "Your Query submitted successfully. We will catch you as soon as possible.";
				}
				else{
					$data['success'] = '0';
					$data['message'] = "Some error Occures. Please Inform us.";
				}
		}
		else{
			$data['success'] = '2';
			$data['message'] = 'Login To Submit Request.';
			$data['code_string'] = array("_to"=>$this->input->post("_to"),
																	 "_from"=>$this->input->post("_from"),
																	 "departure_date"=>'',
																	 "return_date"=>'',
																	 "passengers"=>'',
																	 "type"=>'4',
																	 "pull_type"=>'',
																	);
		}
		}
		echo json_encode($data);
	}

	public function submit_sight(){
		$this->form_validation->set_rules('departure_date', 'Departue Date', 'trim|required');
		$this->form_validation->set_rules('sight_id', 'Sight', 'trim|required');
		$this->form_validation->set_rules('passengers', 'Passengers', 'trim|required');


		if($this->form_validation->run()==FALSE){
			$data['success'] = '0';
		 $data['message'] =  validation_errors();
		}
		else{

		$query = $this->Api_model->add_sight($this->customer->getId());
		if($query){
			$data['success'] = '1';
			$data['message'] = "Your Query submitted successfully. We will catch you as soon as possible.";
		}
		else{
			$data['success'] = '0';
			$data['message'] = "Some error Occures. Please Inform us.";
		}
		}

		echo json_encode($data);
	}
}
