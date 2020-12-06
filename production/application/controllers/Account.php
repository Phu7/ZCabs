<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('api/Api_model');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['result'] = $this->Api_model->get_customer($this->customer->getId());
		$this->load->view("front/account/profile",$data);
	}

	public function login(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run()==FALSE){
			 $data['success'] =  "0";
			 $data['message'] = validation_errors();
		}
		else{
		$query = $this->customer->login($this->input->post('username'), $this->input->post('password'));
		if($query){
			if($this->input->post('login_extra')){
				$extra = json_decode($this->input->post('login_extra'));
				$sa = $this->Api_model->save_order($extra);
				$data['success'] = "1";
				$data['message'] = "Your Trip successfully submitted.";
			}
			else{
			$data['success'] = "1";
			$data['message'] = "Successfully Looged in.";
		}
		}
		else{
			$data['success'] =  "0";
			$data['message'] = "Username Or Password doesnot Match.";
		}
		}
		echo json_encode($data);
	}

	public function logout(){
		$this->customer->logout();
		redirect("/");
	}

	public function register(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run()==FALSE){
			 $this->session->set_flashdata('success', "0");
			 $this->session->set_flashdata('msg', validation_errors());
		}
		else{
		$query = $this->Api_model->add_customer();
		if($query){
			$this->customer->login($this->input->post('mobile'), $this->input->post('password'));
			if($this->input->post('register_extra')){
				$extra = json_decode($this->input->post('register_extra'));
				$sa = $this->Api_model->save_order($extra);
				$data['success'] = "1";
				$data['message'] = "Your Trip successfully submitted.";
			}
			$this->session->set_flashdata('success', "0");
			$this->session->set_flashdata('msg', "Welcome .");
		}
		else{
			$this->session->set_flashdata('msg', "Some Error Occure.");
			$this->session->set_flashdata('success', "0");
		}
		}
	}

	public function update(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim');
		$this->form_validation->set_rules('city', 'City', 'trim');
		$this->form_validation->set_rules('state', 'State', 'trim');
		$this->form_validation->set_rules('country', 'Country', 'trim');
		$this->form_validation->set_rules('zip', 'Pincode', 'trim');
		$this->form_validation->set_rules('gender', 'Gender', 'trim');
		$this->form_validation->set_rules('dob', 'DOB', 'trim');
		if($this->form_validation->run()==FALSE){
			 $this->session->set_flashdata('success', "0");
			 $this->session->set_flashdata('msg', validation_errors());
		}
		else{
		$query = $this->Api_model->edit_customer($dp = '', $this->customer->getId());
		if($query){
			$this->session->set_flashdata('success', "0");
			$this->session->set_flashdata('msg', "Ypur Profile Successfully Updated.");
		}
		else{
			$this->session->set_flashdata('msg', "Some Error Occure.");
			$this->session->set_flashdata('success', "0");
		}
		}
	}

	public function change_password(){
		if($this->customer->isLogged()){
		$this->load->view("front/account/change_password");
		}
		else{
		redirect('/');
		}
	}

	public function editPassword(){
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
		$this->form_validation->set_rules('con_password', 'Confirm Password', 'trim|required|matches[new_password]');
		if($this->form_validation->run()==FALSE){
			 $this->session->set_flashdata('msg',validation_errors());
			$this->session->set_flashdata('is_success','0');
		}
		else{
			$id = $this->customer->getId();
			$s = $this->Api_model->isPassword($id, $this->input->post('old_password'));
			if($s){
				$query = $this->Api_model->update_password($id);
				if($query){
					$this->session->set_flashdata('msg','Password Updated successfully');
				 $this->session->set_flashdata('is_success','1');
				}
				else{
					$this->session->set_flashdata('msg','Some Error Occures');
				 $this->session->set_flashdata('is_success','0');
				}
				}
				else{
					$this->session->set_flashdata('msg','Old password does not match');
				 $this->session->set_flashdata('is_success','0');
				}
	}
	redirect("account");
	}

	public function submit_newsletter(){
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique[newsletter.email]');
		if($this->form_validation->run()==FALSE){
			$data['message'] = validation_errors();
			$data['success'] = '0';
		}
		else{
		$query = $this->db->query("INSERT INTO newsletter SET email = '" . $this->db->escape_str($this->input->post('email')) . "', created = NOW()");
		$data['message'] = "Thank you to subscribe newsletter.";
		$data['success'] = '1';
		}
		echo json_encode($data);
	}

}
