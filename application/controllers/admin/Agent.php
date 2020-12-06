<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('admin/Agent_model');
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
		$data['result'] = $this->Agent_model->get_agents();
		$this->load->view('admin/agent/agent_list',$data);
	}
	
	public function add(){
		if($this->input->get('id')){
			$query = $this->Agent_model->get_agent_by_id($this->input->get('id'));
			foreach($query->result() as $query){
				$data['id'] = $query->id;
				$data['first_name'] = $query->first_name;
				$data['last_name'] = $query->last_name;
				$data['father_name'] = $query->father_name;
				$data['email'] = $query->email;
				$data['mobile'] = $query->mobile;
				$data['residential_address'] = $query->address;
				$data['office_address'] = $query->address;
				$data['photo'] = $query->dp;
				$data['bank_name'] = $query->bank_name;
				$data['bank_account'] = $query->bank_account;
				$data['ifsc'] = $query->ifsc_code;
				$data['address_proof'] = $query->address_proof;
				$data['id_proof'] = $query->id_proof;
				$data['bank_proof'] = $query->bank_proof;
				$data['office_front_photo'] = $query->office_front_photo;
				$data['office_inside_photo'] = $query->office_inside_photo;
				$data['account_holder_name'] = $query->account_holder_name;
				$data['status'] = $query->status;
			}
		}
		else{
			$data['id'] = "";
			$data['first_name'] = "";
			$data['last_name'] = "";
			$data['father_name'] = "";
			$data['email'] = "";
			$data['mobile'] = "";
			$data['residential_address'] = "";
			$data['office_address'] = "";
			$data['photo'] = "";
			$data['bank_name'] = "";
			$data['bank_account'] = "";
			$data['ifsc'] = "";
			$data['address_proof'] = "";
			$data['id_proof'] = "";
			$data['office_front_photo'] = "";
			$data['office_inside_photo'] = "";
			$data['bank_proof'] = "";
			$data['account_holder_name'] = "";
			$data['status'] = "";
		}
		$this->load->view('admin/agent/agent_form',$data);
	}

	public function add_agent(){
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata('info', "2--".validation_errors());
		}
		else{
			
			if($this->input->post('id')){
				$query = $this->Agent_model->edit();
			}
			else{
				$query = $this->Agent_model->add();
			}
			if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		}
		redirect('admin/agent');	
	}
	
	
	public function update(){
		$query = $this->Agent_model->update($this->input->get('id'), $this->input->get('status'));
		if($query){
			$this->session->set_userdata('info', "1--Successfully done");
		}
		else{
			$this->session->set_userdata('info', "2--Error!!!");
		}
		redirect('admin/agent');
	}

	public function delete(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->Agent_model->delete($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/agent');
	}

	public function detail(){
		$id = $this->input->get('id');
		$data['result'] = $this->Agent_model->get_agent_by_id($id)->row();
		$this->load->view('admin/agent/detail', $data);
	}
}
