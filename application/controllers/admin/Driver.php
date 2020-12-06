<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('admin/Driver_model');
			$this->load->library('form_validation');
		}

		public function index(){
		if ($this->admin->getInfo()){
			$info = explode('--', $this->admin->getInfo());
			$data['info'] = $info[1];
			$data['info_type'] = $info[0];
		} else {
			$data['info'] = '';
			$data['info_type'] = '';
		}
		$data['result'] = $this->Driver_model->get_drivers();
		$this->load->view('admin/driver/driver_list',$data);
	}

	public function add(){
		if($this->input->get('id')){
			$query = $this->Driver_model->get_driver_by_id($this->input->get('id'));
			foreach($query->result() as $query){
				$data['id'] = $query->id;
				$data['first_name'] = $query->first_name;
				$data['last_name'] = $query->last_name;
				$data['email'] = $query->email;
				$data['mobile'] = $query->mobile;
				$data['address'] = $query->address;
				$data['city'] = $query->city;
				$data['state'] = $query->state;
				$data['zip'] = $query->pincode;
				$data['country'] = $query->country;
				$data['dob'] = $query->dob;
				$data['gender'] = $query->gender;
				$data['vehicle_type'] = $query->vehicle_type;
				$data['vehicle_name'] = $query->vehicle_name;
				$data['vehicle_number'] = $query->vehicle_number;
				$data['vehicle_model'] = $query->vehicle_model;
				$data['image'] = $query->dp;
				$data['bank_name'] = $query->bank_name;
				$data['bank_account'] = $query->bank_account;
				$data['ifsc'] = $query->ifsc_code;
				$data['address_proof'] = $query->address_proof;
				$data['vehicle_picture'] = $query->vehicle_picture;
				$data['insurance'] = $query->insurance;
				$data['license'] = $query->license;
				$data['bank_proof'] = $query->bank_proof;
				$data['vehicle_rc_book'] = $query->vehicle_rc_book;
				$data['o_img'] = $query->dp;
				$data['account_holder_name'] = $query->account_holder_name;
				$data['status'] = $query->status;
			}
		}
		else{
			$data['id'] = "";
			$data['first_name'] = "";
			$data['last_name'] = "";
			$data['email'] = "";
			$data['mobile'] = "";
			$data['address'] = "";
			$data['dob'] = "";
			$data['gender'] = "";
			$data['city'] = "";
			$data['state'] = "";
			$data['zip'] = "";
			$data['country'] = "";
			$data['vehicle_type'] = "";
			$data['vehicle_name'] = "";
			$data['vehicle_number'] = "";
			$data['vehicle_model'] = "";
			$data['image'] = "";
			$data['bank_name'] = "";
			$data['bank_account'] = "";
			$data['ifsc'] = "";
			$data['address_proof'] = "";
			$data['vehicle_picture'] = "";
			$data['insurance'] = "";
			$data['license'] = "";
			$data['bank_proof'] = "";
			$data['vehicle_rc_book'] = "";
			$data['o_img'] = "";
			$data['account_holder_name'] = "";
			
			$data['status'] = "";
		}
		$this->load->view('admin/driver/driver_form',$data);
	}

	public function add_driver(){
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}
		else{
			
			if($this->input->post('id')){
				$query = $this->Driver_model->edit();
			}
			else{
				$query = $this->Driver_model->add();
			}
			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/driver');	
	}
	


	public function update(){
		$query = $this->Driver_model->update($this->input->get('id'), $this->input->get('status'));
		if($query){
			$this->session->set_userdata('info', "1--Successfully done");
		}
		else{
			$this->session->set_userdata('info', "2--Error!!!");
		}
		redirect('admin/driver');
	}

	public function delete(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->Driver_model->delete($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/driver');
	}

	public function detail(){
		$id = $this->input->get('id');
		$data['result'] = $this->Driver_model->get_driver_by_id($id)->row();
		$this->load->view('admin/driver/detail', $data);
	}

}
